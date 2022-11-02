<?php

namespace App\Http\Controllers;

use Log;
use DB;
use App\Modelos\Usuario;
use App\Modelos\Venta;
use App\Modelos\Producto;

class DashboardController extends Controller {
    public function __construct() {
        $this->middleware(['auth', 'verified', 'CheckSelPerfil', 'CheckUsuario']);
        $this->middleware('checkUsuarioPermisoHTTP')->except("CantidadRegistrados", "VentaDia", "VentaMes", "ProductoMasVendido");
    }
    
    public function dashboardSA() {
        return view('dashboard_sa');
    }
    
    public function dashboardAdmin() {
        return view('dashboard_admin');
    }

    public function dashboard() {
        return view('dashboard');
    }
    
    public function dashboardOcacional() {
        return view('dashboard_ocacional');
    }
    
    public function CantidadRegistrados($idPerfil) {
        try {
            $u = Usuario::Join("Perfil_Usuario", "Perfil_Usuario.idUsuario", "=", "Usuario.idUsuario")->Where("Perfil_Usuario.idPerfil", $idPerfil)->Where("Usuario.vigente", true)->count();
            return response()->json(['cantidad' => $u], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['message' => "Error al obtener cantidad registrados"], 500);
        }
    }
}