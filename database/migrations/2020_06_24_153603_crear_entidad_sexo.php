<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadSexo extends Migration {
    public function up() {
        Schema::create('Sexo', function (Blueprint $table) {
            $table->smallIncrements("idSexo")->unsigned();
            $table->string('glosa', 100);
            $table->boolean('vigente')->default(true);
        });
    }

    public function down() {
        Schema::dropIfExists('Sexo');
    }
}