<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadComuna extends Migration {
    public function up() {
        Schema::create('Comuna', function (Blueprint $table) {
            $table->integer("idComuna")->unsigned();
            $table->string('nombre', 45);
            $table->Integer('orden')->nullable();
            $table->boolean('vigente')->default(true);
            $table->integer('idProvincia')->unsigned();
            $table->integer('idRegion')->unsigned();
            
            $table->primary("idComuna");
            $table->foreign('idProvincia')->references('idProvincia')->on('Provincia');
            $table->foreign('idRegion')->references('idRegion')->on('Region');
        });
    }

    public function down() {
        Schema::dropIfExists('Comuna');
    }
}