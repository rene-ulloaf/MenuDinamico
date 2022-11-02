<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Modelos\Usuario;
use App\Http\Utilidades\UsuarioDatosDispositivo;
use App\Http\Controllers\UsuarioIngresoController;

class LoginController extends Controller {
    use AuthenticatesUsers;
    
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
    
    protected function attemptLogin(Request $request) {
        $usuario = Usuario::Where('email', $request->email)->Select("vigente", "fecha_caduca", "bloqueado", "password")->first();
        
        if($usuario == null) {
            throw ValidationException::withMessages(
                ["error-propio" => "No existe usuario."]
            );
        }
        
        //die($usuario->password.",". $request->password);
        if (!Hash::check($request->password, $usuario->password)) {
            throw ValidationException::withMessages(
                ["error-propio" => "Password no es válido."]
            );
        }

        //die("blk[" . $usuario->bloqueado."]");
        if($usuario->bloqueado) {
            throw ValidationException::withMessages(
                ["error-propio" => "Usuario bloqueado, contáctese con el administrador."]
            );
        }
        
        if($usuario->fecha_caduca == ""){
            $caduca = false;
        }else{
            $fecha_actual = strtotime(date("d-m-Y H:i:00",time()));
            $fecha_entrada = strtotime($usuario->fecha_caduca);
           
            $caduca = ($fecha_actual > $fecha_entrada ? true : false);
        }
        //die("cad[" . $caduca ."]");
        if($caduca) {
            throw ValidationException::withMessages(
                ["error-propio" => "Usuario caducado, contáctese con el administrador."]
            );
        }
        //die("vig[" . $usuario->vigente."]");
        if(!$usuario->vigente) {
            throw ValidationException::withMessages(
                ["error-propio" => "Usuario eliminado, contáctese con el administrador."]
            );
        }
        
        return $this->guard()->attempt(
            ['email' => $request->email, 'password' => $request->password], $request->filled('remember')
        );
    }

    protected function authenticated(Request $request, $user) {
        $datos_dispositivos = new UsuarioDatosDispositivo();
        $usuario_ingreso = new UsuarioIngresoController();
        
        $explorador = explode("-", $datos_dispositivos->getExplorador());
        
        $datos = [
            "idUsuario" => $user->idUsuario,
            "so" => $datos_dispositivos->getSO(),
            "explorador" => $explorador[0],
            "version" => $explorador[1],
            "ip" => request()->ip()
        ];
        
        $id = $usuario_ingreso->store($datos);
        session()->put('id_usuario_ingreso', $id);
    }
    
    public function redirectTo() {
        if($this->guard()->user()->cambioPassword) {
            //die(url("password/reset/" . $this->guard()->user()->remember_token . "?email=" . $this->guard()->user()->email));
            return "password/reset/" . $this->guard()->user()->remember_token . "?email=" . $this->guard()->user()->email;
        }
        
        return "perfiles/" . $this->guard()->user()->idUsuario;
    }
    
    public function logout(Request $request) {
        $usuario_ingreso = new UsuarioIngresoController();
        
        $usuario_ingreso->salir(session('id_usuario_ingreso'));
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson() ? new Response('', 204) : redirect('/');
    }
}