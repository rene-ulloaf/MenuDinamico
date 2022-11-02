<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Modelos\Usuario;
use App\Modelos\Persona;
use App\Http\Controllers\UsuarioIngresoController;

class ResetEmailController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified', 'CheckSelPerfil', 'CheckUsuario']);
    }
    
    protected function rules() {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
    
    public function resetEmail($idUsuario) {
        return view('auth/email_cambio', ['idUsuario' => $idUsuario]);
    }
    
    protected function update($idUsuario, Request $request) {
        $usuario_ingreso = new UsuarioIngresoController();
        
        $request->validate($this->rules(), $this->validationErrorMessages());
        $usuario = Usuario::Where('idUsuario', $idUsuario)->Select("idUsuario", "email", "password", "remember_token")->first();
        
        if($usuario == null) {
            throw ValidationException::withMessages(
                ["error-propio" => "No existe usuario"]
            );
        }

        //die($usuario->password.",". $request->password);
        if (!Hash::check($request->password, $usuario->password)) {
            throw ValidationException::withMessages(
                ["error-propio" => "Password no es válido."]
            );
        }
        
        if($request->email == $usuario->email) {
            throw ValidationException::withMessages(
                ["error-propio" => "Email es el mismo del actual"]
            );
        }
        
        DB::beginTransaction();
        
        try {
            Usuario::Where('idUsuario', $idUsuario)->update(['email' => $request->email, "email_verified_at" => null]);//, "remember_token" => app('auth.password.broker')->createToken($usuario)
            Persona::Where('idUsuario', $idUsuario)->update(['email' => $request->email]);
            DB::insert('Insert Into email_resets (idUsuario, idUsuarioIngreso, email) values (?, ?, ?)', [$idUsuario, session('id_usuario_ingreso'), $usuario->email]);
            DB::commit();
            
            $usuario->email = $request->email;
            $usuario->sendChangeEmailVerificationNotification();
            
            //$usuario_ingreso->salir(session('id_usuario_ingreso'));

            //Session::flash('mensaje', 'Email modificado, Le llegará un email para validar el cambio');
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
        }
        
        //return redirect('login')->with(Auth::logout());
        return view('auth.verify');
    }
    
    protected function validationErrorMessages()
    {
        return [];
    }
}
