<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadPerfil extends Migration {
    public function up() {
        Schema::create('Perfil', function (Blueprint $table) {
            $table->increments("idPerfil")->unsigned();
            $table->smallInteger('idEstilo')->unsigned();
            $table->string('nombre', 45);
            $table->string('pagina_inicio', 150)->nullable();
            $table->string('descripcion', 500)->nullable();
            $table->boolean('vigente')->default(true);
            
            $table->foreign('idEstilo')->references('idEstilo')->on('Estilo');
        });
    }

    public function down() {
        Schema::dropIfExists('Perfil');
    }
}