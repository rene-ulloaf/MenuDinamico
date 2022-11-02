<?php

namespace App\Console\Commands;

use Log;
use DB;
use Illuminate\Console\Command;

class DesactivarUsuarioIngreso extends Command {
    protected $signature = 'usuario_ingreso:desactivar';
    protected $description = 'Desactiva los ingresos de los usuarios que no han efectuado accion por 30 min.';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        Log::info("--Inicio Desactivar usuarioIngreso--");
        $cant_ful = DB::update("Update Usuario_Ingreso set activo = 0 Where activo = 1 And fechaUltAccion < DATE_SUB(now(), INTERVAL 30 MINUTE)");
        $cant_fin = DB::update("Update Usuario_Ingreso set activo = 0 Where activo = 1 And fechaUltAccion is null And fechaIngreso < DATE_SUB(now(), INTERVAL 30 MINUTE)");
        Log::info("Cantidad desactivada: [" . ($cant_ful + $cant_fin) . "]");
        Log::info("--Fin Desactivar usuarioIngreso--");
    }
}