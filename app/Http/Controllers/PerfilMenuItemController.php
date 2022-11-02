<?php

namespace App\Http\Controllers;

use Log;
use DB;
use Illuminate\Http\Request;
use App\Modelos\Perfil;
use App\Modelos\PerfilMenuItem;

class PerfilMenuItemController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified', 'CheckSelPerfil', 'CheckUsuario']);
        $this->middleware('checkUsuarioPermisoHTTP')->except("asignar", "asignarPadre", "update", "destroy", "eliminarHijo", "lista", "permisoMI");
    }
    
    public function perfilMenuItem() {
        try {
            $perfiles = Perfil::Where('vigente', true)->select("idPerfil", "nombre")->orderBy('nombre')->get();
            
            return view('permiso.perfil_menu_item', compact('perfiles'));
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('permiso.perfil_menu_item')->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }
    
    public function asignar(Request $request) {
        try {
            $request->validate([
                'idPerfil' => 'required|not_in:0',
                'idMenu_Item' => 'required|not_in:0'
            ]);

            PerfilMenuItem::create($request->all());
            $this->asignarPadre($request["idPerfil"], $request["idMenu_Item"]);
            
            return response()->json(["message" => "Asignado"], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al asignar ".$e->getMessage()], 500);
        }
    }
    
    private function asignarPadre($idPerfil, $idMenuItem) {
        try {
            $menu_item = DB::select('SELECT mi2.idMenu_Item, mi2.desplegable FROM Menu_Item mi Join Menu_Item mi2 On mi2.idMenu_Item = mi.padre Where mi.idMenu_Item = ?  And mi2.vigente = 1', [$idMenuItem]);

            foreach ($menu_item as $mi) {
                $c = DB::select('SELECT count(idMenu_Item) as cant  FROM Perfil_Menu_Item Where idPerfil = ? And idMenu_Item = ?', [$idPerfil, $mi->idMenu_Item]);

                if($c[0]->cant == 0) {
                    if($mi->desplegable) {
                        PerfilMenuItem::create(["idPerfil" => $idPerfil, "idMenu_Item" => $mi->idMenu_Item, "lectura" => 0]);
                    } else {
                        PerfilMenuItem::create(["idPerfil" => $idPerfil, "idMenu_Item" => $mi->idMenu_Item, "lectura" => 1]);
                    }
                }

                $this->asignarPadre($idPerfil, $mi->idMenu_Item);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al modificar"], 500);
        }
    }

    public function update(Request $request, $idPerfil, $idMenuItem) {
        try {
            $pmi = PerfilMenuItem::Where('idPerfil', $idPerfil)->where('idMenu_Item', $idMenuItem)->update($request->except('_method', '_token'));
            
            if($pmi) {
                return response()->json(["message" => "Modificado"], 200);
            } else {
                return response()->json(["message" => "No modificado"], 400);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al modificar"], 500);
        }
    }
    
    public function destroy($idPerfil, $idMenuItem) {
        try {
            $pmi = PerfilMenuItem::Where('idPerfil', $idPerfil)->where('idMenu_Item', $idMenuItem)->delete();
            $this->eliminarHijo($idPerfil, $idMenuItem);
            
            if($pmi) {
                return response()->json(["message" => "Eliminado"], 200);
            } else {
                return response()->json(["message" => "No eliminado"], 400);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al eliminar"], 500);
        }
    }
    
    private function eliminarHijo($idPerfil, $idMenuItem) {
        try {
            $menu_item = DB::select('SELECT idMenu_Item FROM Menu_Item Where padre = ?', [$idMenuItem]);

            foreach ($menu_item as $mi) {
                $c = DB::select('SELECT count(idMenu_Item) as cant  FROM Perfil_Menu_Item Where idPerfil = ? And idMenu_Item = ?', [$idPerfil, $mi->idMenu_Item]);

                if($c[0]->cant > 0) {
                    PerfilMenuItem::Where("idPerfil", $idPerfil)->where('idMenu_Item', $mi->idMenu_Item)->delete();
                }

                $this->eliminarHijo($idPerfil, $mi->idMenu_Item);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["message" => "Error al modificar"], 500);
        }
    }
    
    public function lista($idPerfil) {
        try {
            //DB::select('call pa_obtener_menu_item_perfil (?, ?)', [0, $idPerfil]);
            DB::connection()->getPdo()->exec('call pa_obtener_menu_item_perfil (0, ' . $idPerfil . ')');
            $pmi = DB::select('Select idMenu_Item, idPerfil, menu, mi, descripcion, desplegable, lectura, escritura, modifica, elimina From tempMenuItemPerfil');
            //DB::select('Drop temporary table if exists tempMenuItemPerfil');
            
            return response()->json(['data' => $pmi], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['message' => "Error al obtener menu item " . $e->getMessage()], 500);
        }
    }
    
    public function permisoMI($idUsuario, $idMenuItem) {
        try {
            $permiso = DB::select('SELECT count(pu.idUsuario) as cant FROM Perfil_Usuario pu Join Perfil p On p.idPerfil = pu.idPerfil Join Perfil_Menu_Item pmi On pmi.idPerfil = p.idPerfil Where pmi.idMenu_Item = ? And pu.idUsuario = ?', [$idMenuItem, $idUsuario]);

            if($permiso[0]->cant == 0) {
                return false;
            } else {
                return true;
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return false;
        }
    }
}