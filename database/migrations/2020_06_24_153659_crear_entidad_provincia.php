<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadProvincia extends Migration {
    public function up() {
        Schema::create('Provincia', function (Blueprint $table) {
            $table->integer("idProvincia")->unsigned();
            $table->string('nombre', 45);
            $table->Integer('orden')->nullable();
            $table->boolean('vigente')->default(true);
            $table->integer('idRegion')->unsigned();
            
            $table->primary("idProvincia");
            $table->foreign('idRegion')->references('idRegion')->on('Region');
        });
    }

    public function down() {
        Schema::dropIfExists('Provincia');
    }
}