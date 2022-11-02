<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Modelos\Perfil;

class PerfilController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified', 'CheckSelPerfil', 'CheckUsuario']);
        $this->middleware('checkUsuarioPermisoHTTP')->except("obtener", "store", "update", "destroy", "lista");
    }
    
    public function index() {
        try {
            return view('perfil.index');
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('perfil.index')->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }
    
    public function obtener($idPerfil) {
        try {
            $perfil = Perfil::Where('idPerfil', $idPerfil)->select("idPerfil", "nombre", "pagina_inicio", "descripcion", "vigente")->get();
            
            return response()->json(['perfil' => $perfil], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al obtener perfil"], 500);
        }
    }
    
    public function store(Request $request) {
        try {
            $request->validate([
                'nombre' => 'required|max:45',
                'idEstilo' => 'required',
                'pagina_inicio' => 'nullable|max:150',
                'descripcion' => 'nullable|max:450'
            ]);

            $perfil = Perfil::create($request->all());
            
            return response()->json(['idPerfil' => $perfil->idPerfil, "message" => "Perfil Creado"], 201);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al Crear Perfil"], 500);
        }
    }

    public function update(Request $request, $idPerfil) {
        try {
            $request->validate([
                'nombre' => 'required|max:45',
                'idEstilo' => 'required',
                'pagina_inicio' => 'nullable|max:150',
                'descripcion' => 'nullable|max:450'
            ]);

            $perfil = Perfil::Where('idPerfil', $idPerfil)->update($request->except('_method', '_token'));

            if($perfil) {
                return response()->json(["message" => "Perfil modificado"], 200);
            } else {
                return response()->json(["message" => "Perfil no modificado"], 400);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al modificar perfil"], 500);
        }
    }
    
    public function destroy($idPerfil) {
        try {
            $perfil = Perfil::Where('idPerfil', $idPerfil)->update(["vigente" => "0"]);
            
            if($perfil) {
                return response()->json(["message" => "Perfil eliminado"], 200);
            } else {
                return response()->json(["message" => "Perfil no eliminado"], 400);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al eliminar perfil"], 500);
        }
    }
    
    public function lista() {
        try {
            $perfil = Perfil::Where('vigente', true)->where('idPerfil', '<>', 1)->select("idPerfil", "idEstilo", "nombre", "pagina_inicio", "descripcion", "vigente")->orderBy('idPerfil')->get();
            
            return response()->json(['data' => $perfil], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['data' => [], "message" => "Error al obtener perfil"], 500);
        }
    }
}