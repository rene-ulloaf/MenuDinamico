<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Illuminate\Http\Request;
use App\Modelos\Menu;
use App\Modelos\MenuItem;

class MenuItemController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified', 'CheckSelPerfil', 'CheckUsuario']);
        //$this->middleware('checkUsuarioPermisoHTTP')->except("obtener", "store", "update", "destroy", "lista", "listaMenu", "listaMenuItemPadre");
    }
    
    public function index($idMenu) {
        try {
            $menu = Menu::select('idMenu', 'glosa', 'descripcion', 'vigente')->find($idMenu);
            
            return view("menu_item.index", compact('menu'));
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return view('menu_item.index')->withErrors(["error" => "Ocurrio un error desconocido"]);
        }
    }
    
    public function obtener($idMenuItem) {
        try {
            $menu_item = MenuItem::select('idMenu_Item', 'padre', 'glosa', 'link', 'imagen', 'target', 'desplegable', 'habilitado', 'descripcion', 'orden', 'vigente', 'idMenu')->find($idMenuItem);
            
            return response()->json(['menu_item' => $menu_item], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["error" => "Error al obtener menu"], 500);
        }
    }
    
    public function store(Request $request) {
        try {
            $request->validate([
                'padre' => 'required',
                'glosa' => 'required|max:45',
                'link' => 'nullable|max:150',
                'imagen' => 'nullable|max:450',
                'target' => 'required|max:45',
                'desplegable' => 'required|not_in:2',
                'habilitado' => 'required|not_in:2',
                'descripcion' => 'nullable|max:500',
                'orden' => 'required|numeric',
                'idMenu' => 'required'
            ]);
            $menu_item = MenuItem::create($request->all());
            
            return response()->json(['data' => $menu_item->idMenu_Item], 201);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['error' => "Ocurrio un error desconocido"], 500);
        }
    }

    public function update(Request $request, $idMenuItem) {
        try {
            $request->validate([
                'padre' => 'required',
                'glosa' => 'required|max:45',
                'link' => 'nullable|max:150',
                'imagen' => 'nullable|max:450',
                'desplegable' => 'required',
                'habilitado' => 'required',
                'descripcion' => 'nullable|max:500',
                'orden' => 'required|numeric'
            ]);


            MenuItem::Where('idMenu_Item', $idMenuItem)->update($request->except('_method', '_token'));
            
            //if($menu_item) {
                return response()->json(["message" => "Menu Item modificado"], 200);
            //} else {
            //    return response()->json(["message" => "Menu Item no modificado"], 400);
            //}
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
           return response()->json(["message" => "Error al modificar menu item " . $e->getMessage()], 500);
        }
    }
    
    public function destroy($idMenuItem) {
        try {
            $menu_item = MenuItem::Where('idMenu_Item', $idMenuItem)->update(["vigente" => "0"]);
            
            if($menu_item) {
                return response()->json(["message" => "Menu Item eliminado"], 200);
            } else {
                return response()->json(["message" => "Menu Item no eliminado"], 400);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(["error" => "Ocurrio un error desconocido"], 500);
        }
    }
    
    public function lista($idMenu) {
        try {
            //DB::select('call pa_obtener_menu_item (?, ?)', [$idMenu, 0]);
            DB::connection()->getPdo()->exec('call pa_obtener_menu_item (' . $idMenu . ', 0)');
            $menu_item = DB::select('Select t.idMenu_Item, t.menu_padre, t.padre, t.glosa, t.link, t.imagen, t.target, t.desplegable, t.habilitado, t.descripcion, t.orden, '
                    . '(Select count(tmi.idMenu_Item) From tempMenuITem tmi where tmi.padre = t.idMenu_Item And tmi.vigente = 1 Group By tmi.padre) as cant_hijo '
                    . 'From tempMenuITem t '
                    . 'Where t.vigente = 1 '
                    . 'Group By t.idMenu_Item');
            //DB::connection()->getPdo()->exec('Drop temporary table if exists tempMenuITem');
            
            return response()->json(['data' => $menu_item], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['message' => "Error al obtener menu item"], 500);
        }
    }
    
    /*public function listaMenu($idMenu, $idUsuario, $idPerfil) {
        try {
            DB::select('call pa_obtener_menu_item_menu (?, ?)', [$idMenu, 0]);
            $menu_item = DB::select('Select t.idMenu_Item, t.menu_padre, t.padre, t.glosa, t.link, t.imagen, t.target, t.desplegable, t.habilitado, t.descripcion, t.orden, '
                    . '(Select count(tmi.idMenu_Item) From tempMenuITem tmi where tmi.padre = t.idMenu_Item And t.idperfil = tmi.idperfil And t.idusuario = tmi.idusuario And tmi.vigente = 1 Group By tmi.padre) as cant_hijo '
                    . 'From tempMenuITem t '
                    . 'Where t.idUsuario = ? And t.idPerfil = ? And t.vigente = 1 '
                    . 'Group By t.idMenu_Item '
                    . 'Order By t.menu_padre, t.orden', [$idUsuario, $idPerfil]);
            DB::select('Drop temporary table if exists tempMenuITem');
            
            return response()->json(['data' => $menu_item], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['message' => "Error al obtener menu item"], 500);
        }
    }*/

    public function listaMenu($idMenu, $idUsuario, $idPerfil) {
        try {
            $menu_item = DB::select('Select t.idMenu_Item, t.menu_padre, t.padre, t.glosa, t.link, t.imagen, t.target, t.desplegable, t.habilitado, t.descripcion, t.orden, '
                    . '(Select count(tmi.idMenu_Item) From Menu_Usuario tmi where tmi.padre = t.idMenu_Item And t.idperfil = tmi.idperfil And t.idusuario = tmi.idusuario And tmi.vigente = 1 Group By tmi.padre) as cant_hijo '
                    . 'From Menu_Usuario t '
                    . 'Where t.idUsuario = ? And t.idPerfil = ? And t.idMenu = ? And t.vigente = 1 '
                    . 'Group By t.idMenu_Item '
                    . 'Order By t.menu_padre, t.orden', [$idUsuario, $idPerfil, $idMenu]);
            
            return response()->json(['data' => $menu_item], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['message' => "Error al obtener menu item"], 500);
        }
    }
    
    public function listaMenuItemPadre($idMenu) {
        try {
            $menu_item = MenuItem::Where('idMenu', $idMenu)->where('vigente', '1')->select("idMenu_Item", "glosa")->orderBy("padre")->orderBy('orden')->get();
            
            return response()->json(['menu_items' => $menu_item], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['message' => "Error al obtener menu item"], 500);
        }
    }
}