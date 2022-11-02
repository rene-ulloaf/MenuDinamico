<?php

namespace App\Http\Controllers;

use Log;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Modelos\Perfil;
use App\Modelos\PerfilUsuario;

class PerfilUsuarioController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified']);
        $this->middleware('CheckSelPerfil')->except("seleccion");
    }
    
    public function index($idUsuario) {
        try {
            $perfiles = PerfilUsuario::join('Perfil', 'Perfil_Usuario.idPerfil', '=', 'Perfil.idPerfil')
                        ->select('Perfil_Usuario.idUsuario', 'Perfil_Usuario.idPerfil', 'Perfil.nombre', 'Perfil.descripcion')
                        ->where("Perfil_Usuario.idUsuario", $idUsuario)->get();
            //die($perfiles);
            /*if(count($perfiles) == 1) {
                $this->seleccion($perfiles[0]->idUsuario, $perfiles[0]->idPerfil, "dashboard", 1);
            } else {*/
                return view('auth.perfiles', compact('perfiles'));
            //}
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('auth.perfiles')->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }
  
    public function seleccion($idUsuario, $idPerfil) {
        try {
            $perfil = PerfilUsuario::join('Perfil', 'Perfil_Usuario.idPerfil', '=', 'Perfil.idPerfil')
                            ->join('Usuario', 'Perfil_Usuario.idUsuario', '=', 'Usuario.idUsuario')
                            ->join('Persona', 'Usuario.idUsuario', '=', 'Persona.idUsuario')
                            ->select('Perfil_Usuario.idUsuario', 'Perfil_Usuario.idPerfil', 'Perfil_Usuario.pagina_inicio', 'Perfil.pagina_inicio as pagina_inicio_perfil', 'Persona.idPersona', 'Persona.idSexo')
                            ->where("Perfil_Usuario.idUsuario", $idUsuario)->where("Perfil_Usuario.idPerfil", $idPerfil)->first();//->toSql();
            //die($perfil);
            $var = DB::select("Select count(table_name) As cant From information_schema.tables Where table_schema = '" . config('app.db_database') . "' And table_name = 'Menu_Usuario'");
            //dd("Select count(table_name) As cant From information_schema.tables Where table_schema = '" . config('app.db_database') . "' And table_name = 'Menu_Usuario'");
            if($var[0]->cant > 0) {
                DB::table('Menu_Usuario')->where('idUsuario', $idUsuario)->delete();
            }
            DB::connection()->getPdo()->exec('call pa_obtener_menu_item_menu (0, ' . $idUsuario . ')');

            $pagina_inicio = ($perfil->pagina_inicio_perfil == "" ? config('app.paginainiurl') : $perfil->pagina_inicio_perfil);
            session()->put('id_usuario', $perfil->idUsuario);
            session()->put('id_perfil', $perfil->idPerfil);
            session()->put('pagina_inicio', $pagina_inicio);
            session()->put('id_persona', $perfil->idPersona);
            session()->put('persona_sexo', $perfil->idSexo);
            
            return redirect($pagina_inicio);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            //TODO redirect home mostrando error
            return redirect($pagina_inicio);
        }
    }
    
    public function perfilUsuario() {
        try {
            $perfiles = Perfil::Where('vigente', true)->select("idPerfil", "nombre")->orderBy('nombre')->get();
            
            return view('permiso.perfil_usuario', compact('perfiles'));
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('permiso.perfil_usuario')->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }
    
    public function asignar(Request $request) {
        try {
            $request->validate([
                'idPerfil' => 'required|not_in:0',
                'idUsuario' => 'required|not_in:0'
            ]);

            PerfilUsuario::create($request->all());
            
            return Response::json(["message" => "Asignado"], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return Response::json(["message" => "Error al asignar"], 500);
        }
    }
    
    public function destroy($idPerfil, $idUsuario) {
        try {
            $pu = PerfilUsuario::where('idPerfil', '=', $idPerfil)->where('idUsuario', '=', $idUsuario)->delete();
            //DB::delete('Delete From Perfil_Usuario Where idUsuario = ? And idPerfil = ?', [$idUsuario, $idPerfil]);

            if($pu) {
                return Response::json(["message" => "Eliminado"], 200);
            } else {
                return response()->json(["message" => "Menu no eliminado"], 400);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return Response::json(["message" => "Error al eliminar"], 500);
        }
    }
    
    public function lista($idPerfil) {
        try {
            DB::select('call pa_obtener_usuario_perfil (?)', [$idPerfil]);
            $pmi = DB::select('Select idPerfil, idUsuario, nombre, apellido, email From tempUsuarioPerfil');
            DB::select('Drop temporary table if exists tempUsuarioPerfil');
            
            return Response::json(['data' => $pmi], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return Response::json(['message' => "Error al obtener menu item " . $e->getMessage()], 500);
        }
    }
}