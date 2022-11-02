<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateTriggerUsuarioCantidadIngreso extends Migration {
    public function up() {
        DB::unprepared('
            DROP TRIGGER IF EXISTS tr_Usuario_Cantidad_Ingreso;
            CREATE TRIGGER tr_Usuario_Cantidad_Ingreso AFTER INSERT ON `Usuario_Ingreso` FOR EACH ROW BEGIN
                DECLARE v_cantidad INT;
            
                Set @v_cantidad := (Select cantIngreso From Usuario Where idUsuario =  NEW.idUsuario);
                Update Usuario SET `cantIngreso` = (@v_cantidad + 1) Where idUsuario =  NEW.idUsuario;
            END;
        ');
    }

    public function down() {
        //
    }
}