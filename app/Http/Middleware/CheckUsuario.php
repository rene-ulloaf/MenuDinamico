<?php

namespace App\Http\Middleware;

use Session;
use Auth;
use Closure;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioIngresoController;
use App\Modelos\Usuario;
use App\Modelos\Persona;

class CheckUsuario {
    public function handle($request, Closure $next) {
        if(Auth::user()->cambioPassword) {
            return redirect("password/reset/" . Auth::user()->remember_token . "?email=" . Auth::user()->email);
        }

        if (auth()->check()) {
            $usuario_ingreso = new UsuarioIngresoController();
            $persona = Persona::Where('idUsuario', Auth::user()->idUsuario)->Select("idPersona", "fecha_modifica")->first();
            
            $usuario_ingreso->update(session('id_usuario_ingreso'));

            if ((Route::currentRouteName() != "persona.edit") && (Route::currentRouteName() != "persona.update")) {
                if($persona->fecha_modifica == null) {
                    if($this->checkPrimeraVez()) {
                        Session::flash('primera_vez', 'Es obligatorio completar los datos del usuario la primera vez que se loguea');
                        return redirect('persona/'.$persona->idPersona.'/edit');
                    } else {
                        Session::flash('primera_vez', 'Es obligatorio completar los datos del usuario.');
                        return redirect('persona/'.$persona->idPersona.'/edit');
                    }
                }
            }
            
            return $next($request);
        }
    }
    
    //1ª vez que ingresa
    private function checkPrimeraVez() {
        $usuario = Usuario::Where('idUsuario', Auth::user()->idUsuario)->Select("cantIngreso")->first();
        
        if($usuario->cantIngreso == 1) {
            return true;//redirect("persona/edit")->with("primera_vez". "Es obligatorio completar los datos del usuario la primera vez que se loguea");
        } else {
            return false;
        }
    }
}