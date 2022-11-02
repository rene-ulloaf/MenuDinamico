<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Mail;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Utilidades\Validaciones\Rut;
use App\Http\Utilidades\Validaciones\RutRule;
use App\Modelos\Persona;
use App\Modelos\Usuario;
use App\Modelos\Sexo;
use App\Modelos\Pais;
use App\Mail\UsuarioCreadoMail;

class PersonaController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified', 'CheckSelPerfil', 'CheckUsuario']);
        $this->middleware('checkUsuarioPermisoHTTP')->except("edit", "existe", "lista");
    }
    
    public function index() {
        try {
            $personas = Persona::Where('vigente', true)->where("seleccionable", true)->select("idPersona", "rut", "nombres", "apellido1", "apellido2", "email", "celular", "fecha_ingreso", "vigente")->orderBy("fecha_ingreso")->get();

            return view('persona.index', compact('personas'));
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('persona.index', compact([]))->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }
    
    public function create() {
        try {
            $sexo = Sexo::Where('vigente', true)->select("idSexo", "glosa")->orderBy('glosa')->get();
            $paises = Pais::Where('vigente', true)->select("idPais", "nombre")->orderBy('orden')->get();

            return view('persona.create', compact('sexo', 'paises'));
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('persona.create')->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }
    
    public function store(Request $request) {
        $sexo = Sexo::Where('vigente', true)->select("idSexo", "glosa")->orderBy('glosa')->get();
        $paises = Pais::Where('vigente', true)->select("idPais", "nombre")->orderBy('orden')->get();

        DB::beginTransaction();

        try {
            $request['rut'] = str_replace(".", "", $request['rut']);
            $request['fecha_nacimiento'] = date('Y-m-d', strtotime($request['cmb-dia']."-".$request['cmb-mes']."-".$request['cmb-ano']));
            
            $request->validate([
                'rut' => ['required', 'max:11', 'unique:Persona', new RutRule(new Rut)],
                'nombres' => 'required|max:100',
                'apellido1' => 'required|max:45',
                'apellido2' => 'nullable|max:45',
                'fecha_nacimiento' => 'nullable|date|after:1890-01-01',
                'email' => 'required|email|unique:Persona',
                'direccion' => 'nullable|max:100',
                'telefono' => 'nullable|numeric|digits:8',
                'celular' => 'required|numeric|digits:11',
                'idSexo' => 'required|integer|not_in:1',
                'idPais' => 'required|integer|not_in:0',
                'idRegion' => 'required|integer|not_in:0',
                'idProvincia' => 'required|integer|not_in:0',
                'idComuna' => 'required|integer|not_in:0'
            ]);
            
            $idUsuario = DB::table('Usuario')->max('idUsuario') + 1;
            $nombre = explode(" ", $request['nombres']);
            $user_pass = explode("-", $request['rut']);
            
            $usuario = Usuario::create([
                'idUsuario' => $idUsuario,
                'nombre' => $nombre[0],
                'apellido' => $request['apellido1'],
                'email' => $request['email'],
                'password' => Hash::make($user_pass[0]),
                'email_verified_at' => now(),
                'cambioPassword' => true
            ]);

            Persona::create([
                'idUsuario' => $idUsuario,
                'rut' => $request['rut'],
                'nombres' => $request['nombres'],
                'apellido1' => $request['apellido1'],
                'apellido2' => $request['apellido2'],
                'fecha_nacimiento' => $request['fecha_nacimiento'],
                'direccion' => $request['direccion'],
                'telefono' => $request['telefono'],
                'celular' => $request['celular'],
                'idSexo' => $request['idSexo'],
                'idPais' => $request['idPais'],
                'idRegion' => $request['idRegion'],
                'idProvincia' => $request['idProvincia'],
                'idComuna' => $request['idComuna']
            ]);
            
            DB::commit();
            Usuario::Where('idUsuario', $usuario->idUsuario)->update(["remember_token" => app('auth.password.broker')->createToken($usuario)]);
            Mail::to($usuario->email)->send(new UsuarioCreadoMail($usuario));
            $personas = Persona::Where('vigente', true)->where("seleccionable", true)->select("idPersona", "rut", "nombres", "apellido1", "apellido2", "email", "celular", "fecha_ingreso", "vigente")->orderBy("fecha_ingreso")->get();

            return view('persona.index', compact('personas'))->with("success", 'Persona creada.');
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('persona.create', compact('sexo', 'paises'))->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }

    public function edit($idPersona) {
        $persona = [];
        $sexo = [];
        $paises = [];
        
        try {
            $persona = Persona::select("idPersona", "rut", "nombres", "apellido1", "apellido2", "email", "direccion", "telefono", "celular", "idSexo", "idPais", "idRegion", "idProvincia", "idComuna", "idUsuario")->find($idPersona);
            $sexo = Sexo::Where('vigente', true)->select("idSexo", "glosa")->orderBy('glosa')->get();
            $paises = Pais::Where('vigente', true)->select("idPais", "nombre")->orderBy('orden')->get();

            return view('persona.edit', compact('persona', 'sexo', 'paises'));
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('persona.index', compact('persona', 'sexo', 'paises'))->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }

    public function update(Request $request, $idPersona) {
        $persona = Persona::select("idPersona", "rut", "nombres", "apellido1", "apellido2", "email", "direccion", "telefono", "celular", "idSexo", "idPais", "idRegion", "idProvincia", "idComuna", "idUsuario")->find($idPersona);
        $sexo = Sexo::Where('vigente', true)->select("idSexo", "glosa")->orderBy('glosa')->get();
        $paises = Pais::Where('vigente', true)->select("idPais", "nombre")->orderBy('orden')->get();
        
        DB::beginTransaction();
        
        try {
            $request['rut'] = str_replace(".", "", $request['rut']);
            $request['fecha_nacimiento'] = date('Y-m-d', strtotime($request['cmb-dia']."-".$request['cmb-mes']."-".$request['cmb-ano']));

            $request->validate([
                'rut' => ['nullable', 'max:11', Rule::unique('Persona')->ignore($idPersona, 'idPersona'), new RutRule(new Rut)],
                'nombres' => 'required|max:100',
                'apellido1' => 'required|max:45',
                'apellido2' => 'nullable|max:45',
                'fecha_nacimiento' => 'nullable|date|after:1900-01-01',
                'direccion' => 'nullable|max:100',
                'telefono' => 'nullable|numeric|digits:8',
                'celular' => 'required|numeric|digits:11',
                'idSexo' => 'required|integer|not_in:1',
                'idPais' => 'required|integer|not_in:0',
                'idRegion' => 'required|integer|not_in:0',
                'idProvincia' => 'required|integer|not_in:0',
                'idComuna' => 'required|integer|not_in:0'
            ]);
            
            $nombre = explode(" ", $request['nombres']);
            
            Usuario::Where('idUsuario', $persona->idUsuario)->update([
                'nombre' => $nombre[0],
                'apellido' => $request['apellido1']
            ]);

            $modifica = Persona::Where('idPersona', $idPersona)->update([
                'rut' => $request['rut'],
                'nombres' => $request['nombres'],
                'apellido1' => $request['apellido1'],
                'apellido2' => $request['apellido2'],
                'fecha_nacimiento' => $request['fecha_nacimiento'],
                'direccion' => $request['direccion'],
                'telefono' => $request['telefono'],
                'celular' => $request['celular'],
                'idSexo' => $request['idSexo'],
                'idPais' => $request['idPais'],
                'idRegion' => $request['idRegion'],
                'idProvincia' => $request['idProvincia'],
                'idComuna' => $request['idComuna'],
                'fecha_modifica' => now()
            ]);

            DB::commit();
            
            if($modifica) {
                Auth::user()->nombre = $nombre[0];
                Auth::user()->apellido = $request["apellido1"];
                
                return view('persona.edit', compact('persona', 'sexo', 'paises'))->with("success", 'Persona modificada.');
            } else {
                return view('persona.edit', compact('persona', 'sexo', 'paises'))->with(['warning' => 'Persona no modificada.']);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('persona.edit', compact('persona', 'sexo', 'paises'))->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }

    public function destroy($idPersona) {
        try {
            $elimina = Persona::Where('idPersona', $idPersona)->update(["vigente" => "0", 'fecha_modifica' => now()]);
            $personas = Persona::Where('vigente', true)->where("seleccionable", true)->select("idPersona", "rut", "nombres", "apellido1", "apellido2", "email", "celular", "fecha_ingreso", "vigente")->orderBy("fecha_ingreso")->get();

            if($elimina) {
                return view('persona.index', compact('personas'))->with('success', 'Persona eliminada');
            } else {
                return view('persona.index', compact('personas'))->with(['warning' => 'Persona no eliminada.']);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('persona.index', compact('personas'))->withErrors(["error" => 'Error al eliminar persona']);
        }
    }
    
    public function existe($rut) {
        try{
            $persona  = Persona::Where('rut', '=', str_replace('.', '', $rut))->select('idPersona')->get();

            return response()->json(['data' => $persona], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['message' => "Error desconocido"], 500);
        }
    }

    public function lista($idPerfil) {
        try {
            $personas = Persona::Join('Perfil_Usuario',  'Perfil_Usuario.idUsuario', '=', 'Persona.idUsuario')
                                ->Where('Persona.vigente', true)->where("Persona.seleccionable", true)->where("Perfil_Usuario.idPerfil", $idPerfil)
                                ->select("Persona.idPersona", "Persona.nombres", "Persona.apellido1", "Persona.apellido2")->orderBy("Persona.nombres")->get();
            
            return response()->json(["personas" => $personas], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al obtener persona"], 500);
        }
    }
}