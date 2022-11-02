<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadRegion extends Migration {
    public function up() {
        Schema::create('Region', function (Blueprint $table) {
            $table->integer("idRegion")->unsigned();
            $table->string('nombre', 45);
            $table->Integer('orden')->nullable();
            $table->boolean('vigente')->default(true);
            $table->smallInteger('idPais')->unsigned();

            $table->primary("idRegion");
            $table->foreign('idPais')->references('idPais')->on('Pais');
        });
    }

    public function down() {
        Schema::dropIfExists('Region');
    }
}