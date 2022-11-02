<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadPerfilUsuario extends Migration {
    public function up() {
        Schema::create('Perfil_Usuario', function (Blueprint $table) {
            $table->bigInteger('idUsuario')->unsigned();
            $table->integer('idPerfil')->unsigned();
            $table->string('pagina_inicio', 100)->default('');
            
            $table->foreign('idUsuario')->references('idUsuario')->on('Usuario');
            $table->foreign('idPerfil')->references('idPerfil')->on('Perfil');
            $table->primary(['idUsuario', 'idPerfil']);
        });
    }

    public function down() {
        Schema::dropIfExists('Perfil_Usuario');
    }
}