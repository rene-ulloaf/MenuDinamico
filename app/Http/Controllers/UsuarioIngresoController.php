<?php

namespace App\Http\Controllers;

use Log;
use App\Modelos\UsuarioIngreso;

class UsuarioIngresoController extends Controller {
    public function store($datos){
        try {
            $usuario_ingreso = UsuarioIngreso::create($datos);

            return $usuario_ingreso->idUsuarioIngreso;
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return 0;
        }
    }
    
    public function update($id){
        try {
            UsuarioIngreso::Where('idUsuarioIngreso', $id)->update(["activo" => true, 'fechaUltAccion' => now()]);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return 0;
        }
    }
    
    public function salir($id) {
        try {
            UsuarioIngreso::Where('idUsuarioIngreso', $id)->update(['fechaSalida' => now(), 'activo' => false]);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
        }
    }
    
    public function CantidadActivos() {
        try {
            $ui = UsuarioIngreso::Where('activo', true)->count();
            return response()->json(['cantidad' => $ui], 200);
        } catch(\Illuminate\Database\QueryException $e) {
            Log::error($e->getMessage() . " - " . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
            return response()->json(['message' => "Error al obtener menu item"], 500);
        }
    }
}