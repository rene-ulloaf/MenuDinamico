<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Support\Facades\Route;

class CheckSelPerfil {
    public function handle($request, Closure $next) {
        if (Route::currentRouteName() == "perfiles") {
            if ($request->session()->has('id_perfil')) {
                $pagina_inicio = ($request->session()->has('pagina_inicio') ? session('pagina_inicio') : "home");
                
                return redirect($pagina_inicio);
            }
        } else {
            if (!$request->session()->has('id_perfil')) {
                return redirect("perfiles/" . Auth::user()->idUsuario);
            }
        }
        
        return $next($request);
    }
}
