<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadUsuarioIngreso extends Migration {
    public function up() {
        Schema::create('Usuario_Ingreso', function (Blueprint $table) {
            $table->bigIncrements("idUsuarioIngreso")->unsigned();
            $table->bigInteger('idUsuario')->unsigned();
            $table->dateTime('fechaIngreso')->useCurrent();
            $table->dateTime('fechaUltAccion')->nullable();
            $table->dateTime('fechaSalida')->nullable();
            $table->boolean('activo')->default(true);
            $table->string('so', 45)->nullable();
            $table->string('explorador', 45)->nullable();
            $table->string('version', 45)->nullable();
            $table->boolean('cookies')->nullable();
            $table->string('ip', 100)->nullable();
            $table->string('pais', 45)->nullable();
            
            $table->foreign('idusuario')->references('idusuario')->on('Usuario');
        });
    }

    public function down() {
        Schema::dropIfExists('Usuario_Ingreso');
    }
}