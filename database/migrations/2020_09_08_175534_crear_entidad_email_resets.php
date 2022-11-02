<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadEmailResets extends Migration {
    public function up() {
        Schema::create('email_resets', function (Blueprint $table) {
            $table->bigInteger('idUsuario')->unsigned();
            $table->bigInteger("idUsuarioIngreso")->unsigned();
            $table->string('email', 45);
            $table->dateTime('fecha_modifica')->useCurrent();
            
            $table->foreign('idusuario')->references('idusuario')->on('Usuario');
            $table->foreign('idUsuarioIngreso')->references('idUsuarioIngreso')->on('Usuario_Ingreso');
            $table->primary(['idUsuario', 'idUsuarioIngreso']);
        });
    }

    public function down() {
        Schema::dropIfExists('email_resets');
    }
}