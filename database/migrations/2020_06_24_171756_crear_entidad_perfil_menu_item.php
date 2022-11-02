<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadPerfilMenuItem extends Migration {
    public function up() {
        Schema::create('Perfil_Menu_Item', function (Blueprint $table) {
            $table->integer('idPerfil')->unsigned();
            $table->integer('idMenu_Item')->unsigned();
            $table->boolean('lectura');
            $table->boolean('escritura');
            $table->boolean('modifica');
            $table->boolean('elimina');
            
            $table->foreign('idPerfil')->references('idPerfil')->on('Perfil');
            $table->foreign('idMenu_Item')->references('idMenu_Item')->on('Menu_Item');
            $table->primary(['idPerfil', 'idMenu_Item']);
        });
    }

    public function down() {
        Schema::dropIfExists('Perfil_Menu_Item');
    }
}