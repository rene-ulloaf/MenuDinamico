<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Route;
use App\Modelos\MenuItem;
use App\Http\Controllers\PerfilMenuItemController;

class checkUsuarioPermisoHTTP {
    public function handle($request, Closure $next) {
        if(!$this->checkPermisoMI()) {
            return response()->view('errors.1403');//redirect('errors/1403');
        }
        
        //TODO Revisar permisos CRUD

        return $next($request);
    }

    private function checkPermisoMI(){
        $pmi = new PerfilMenuItemController();
        
        //die(Route::currentRouteName());
        $pos = strpos(Route::currentRouteName(), ".");

        if ($pos !== false) {
            $array = explode(".", Route::currentRouteName());
            
            if($array[1] == "index") {
                $mi = MenuItem::Where('link', $array[0])->Select("idMenu_Item", "glosa")->first();
            } else {
                //die(str_replace(".", "/", Route::currentRouteName()));
                $mi = MenuItem::Where('link', str_replace(".", "/", Route::currentRouteName()))->Select("idMenu_Item", "glosa")->first();
            }
        } else {
            $mi = MenuItem::Where('link', Route::currentRouteName())->Select("idMenu_Item", "glosa")->first();
        }
        
        if($mi) {
            return $pmi->permisoMI(Auth::user()->idUsuario, $mi->idMenu_Item);
        }
    }
}
