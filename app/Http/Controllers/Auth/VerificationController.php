<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\Http\Utilidades\UsuarioDatosDispositivo;
use App\Http\Controllers\UsuarioIngresoController;

class VerificationController extends Controller {
    use VerifiesEmails;

    protected $redirectTo = RouteServiceProvider::HOME;//(config['app.paginainiurl'] == "" ? RouteServiceProvider::HOME : config['app.paginainiurl']);

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
        
        $this->redirectTo = 'login';//(session('pagina_inicio') == "" ? config('app.paginainiurl') : session('pagina_inicio'));
    }
    
    protected function verified(Request $request) {
        $datos_dispositivos = new UsuarioDatosDispositivo();
        $usuario_ingreso = new UsuarioIngresoController();
        
        $explorador = explode("-", $datos_dispositivos->getExplorador());
        
        $datos = [
            "idUsuario" => $request->user()->idUsuario,
            "so" => $datos_dispositivos->getSO(),
            "explorador" => $explorador[0],
            "version" => $explorador[1],
            "ip" => request()->ip()
        ];
        
        $id = $usuario_ingreso->store($datos);
        session()->put('id_usuario_ingreso', $id);
    }
}