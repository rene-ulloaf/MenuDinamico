<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadMenuItem extends Migration {
    public function up() {
        Schema::create('Menu_Item', function (Blueprint $table) {
            $table->increments("idMenu_Item")->unsigned();
            $table->integer('padre')->unsigned();
            $table->string('glosa', 45);
            $table->string('link', 150)->nullable();
            $table->string('imagen', 450)->nullable();
            $table->string('target', 45)->nullable();
            $table->boolean('desplegable');
            $table->boolean('habilitado')->default(true);
            $table->string('descripcion', 500)->nullable();
            $table->integer('orden')->unsigned()->nullable();
            $table->boolean('vigente')->default(true);
            $table->smallInteger('idMenu')->unsigned();
            
            $table->foreign('idMenu')->references('idMenu')->on('Menu');
        });
    }

    public function down() {
        Schema::dropIfExists('Menu_Item');
    }
}