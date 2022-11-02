<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Modelos\Menu;

class MenuController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified', 'CheckSelPerfil', 'CheckUsuario']);
        $this->middleware('checkUsuarioPermisoHTTP')->except("obtener", "store", "update", "destroy", "lista");
    }
    
    public function index() {
        try {
            return view('menu.index');
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('menu.index')->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }
    
    public function obtener($idMenu) {
        try {
            $menu = Menu::Where('idMenu', $idMenu)->select("idMenu", "glosa", "descripcion", "vigente")->get();
            
            return response()->json(['data' => $menu], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['data' => [], "message" => "Error al obtener menu"], 500);
        }
    }
    
    public function store(Request $request) {
        try {
            $request->validate([
                'glosa' => 'required|max:45',
                'descripcion' => 'nullable|max:450'
            ]);

            $menu = Menu::create($request->all());
            
            return response()->json(['data' => $menu->idMenu, "message" => "Menu creado"], 201);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['data' => [], "message" => "Error al crear menu"], 500);
        }
    }

    public function update(Request $request, $idMenu) {
        try {
            $request->validate([
                'glosa' => 'required|max:45',
                'descripcion' => 'nullable|max:450'
            ]);

            $menu = Menu::Where('idMenu', $idMenu)->update($request->except('_method', '_token'));

            if($menu) {
                return response()->json(["message" => "Menu modificado"], 200);
            } else {
                return response()->json(["message" => "Menu no modificado"], 400);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['data' => [], "message" => "Error al modificar menu"], 500);
        }
    }
    
    public function destroy($idMenu) {
        try {
            $menu = Menu::Where('idMenu', $idMenu)->update(["vigente" => "0"]);

            if($menu) {
                return response()->json(["message" => "Menu eliminado"], 200);
            } else {
                return response()->json(["message" => "Menu no eliminado"], 400);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['data' => [], "message" => "Error al eliminar menu"], 500);
        }
    }
    
    public function lista() {
        try {
            $menu = Menu::Where('vigente', true)->select("idMenu", "glosa", "descripcion", "vigente")->orderBy('idMenu')->get();
            
            return response()->json(['data' => $menu], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['data' => [], "message" => "Error al obtener menu"], 500);
        }
    }
}