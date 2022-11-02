<?php

namespace App\Http\Controllers\Auth;

use DB;
use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Modelos\Usuario;
use App\Modelos\Persona;
use App\Modelos\PerfilUsuario;

class RegisterController extends Controller {
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;//(config['app.paginainiurl'] == "" ? RouteServiceProvider::HOME : config['app.paginainiurl']);

    public function __construct() {
        $this->middleware('guest');
        $this->redirectTo = 'login';//(session('pagina_inicio') == "" ? config('app.paginainiurl') : session('pagina_inicio'));
    }

    protected function register(array $data) {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:45'],
            'apellido' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'max:45', 'unique:Usuario'],
            'password' => ['required', 'string', 'min:' . config('app.minpass', 8), 'confirmed'],
        ]);
    }
    
    protected function create(array $data) {
        DB::beginTransaction();
        
        try {
            $idUsuario = DB::table('Usuario')->max('idUsuario') + 1;

            $usuario = Usuario::create([
                'idUsuario' => $idUsuario,
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);

            Persona::create([
                'idUsuario' => $idUsuario,
                'nombres' => $data['nombre'],
                'apellido1' => $data['apellido'],
                'email' => $data['email'],
                'idSexo' =>  1,
                'idPais' => 0,
                'idRegion' => 0,
                'idProvincia' => 0,
                'idComuna' => 0
            ]);

            PerfilUsuario::create([
                'idUsuario' => $idUsuario,
                'idPerfil' => config('app.id_perfil_usuario')
            ]);

            DB::commit();
            return $usuario;
        } catch(\Illuminate\Database\QueryException $e) {
            DB::rollback();
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            
            return [];
        }
    }
}