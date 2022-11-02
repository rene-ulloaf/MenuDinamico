<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadMenu extends Migration {
    public function up() {
        Schema::create('Menu', function (Blueprint $table) {
            $table->smallIncrements("idMenu")->unsigned();
            $table->string('glosa', 45);
            $table->string('descripcion', 450)->nullable();
            $table->boolean('vigente')->default(true);
        });
    }

    public function down() {
        Schema::dropIfExists('Menu');
    }
}