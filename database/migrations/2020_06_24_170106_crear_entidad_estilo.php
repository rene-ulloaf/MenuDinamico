<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadEstilo extends Migration {
    public function up() {
        Schema::create('Estilo', function (Blueprint $table) {
            $table->smallIncrements("idEstilo")->unsigned();
            $table->string('glosa', 100);
            $table->text('descripcion')->nullable();
            $table->smallInteger('orden')->nullable();
            $table->boolean('vigente')->default(true);
        });
    }

    public function down() {
        Schema::dropIfExists('Estilo');
    }
}