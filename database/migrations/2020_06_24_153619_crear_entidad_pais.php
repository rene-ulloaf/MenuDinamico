<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadPais extends Migration {
    public function up() {
        Schema::create('Pais', function (Blueprint $table) {
            $table->smallInteger("idPais")->unsigned();
            $table->string('nombre', 45);
            $table->string('gentilicio_masculino', 20)->nullable();
            $table->string('gentilicio_femenino', 20)->nullable();
            $table->string('bandera', 500)->nullable();
            $table->smallInteger('orden')->unsigned()->nullable();
            $table->boolean('vigente')->default(true);
            
            $table->primary("idPais");
        });
    }

    public function down() {
        Schema::dropIfExists('Pais');
    }
}