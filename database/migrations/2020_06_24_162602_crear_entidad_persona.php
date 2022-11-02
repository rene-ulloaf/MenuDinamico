<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadPersona extends Migration {
    public function up() {
        Schema::create('Persona', function (Blueprint $table) {
            $table->bigIncrements("idPersona")->unsigned();
            $table->bigInteger('idUsuario')->unsigned();
            $table->string('rut', 11)->nullable();
            $table->string('nombres', 100);
            $table->string('apellido1', 45);
            $table->string('apellido2', 45)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('email', 45)->unique();
            $table->string('direccion', 100)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->smallInteger('idSexo')->unsigned();
            $table->smallInteger('idPais')->unsigned();
            $table->integer('idRegion')->unsigned();
            $table->integer('idProvincia')->unsigned();
            $table->integer('idComuna')->unsigned();
            $table->boolean('seleccionable')->default(true);
            $table->dateTime('fecha_ingreso')->useCurrent();
            $table->dateTime('fecha_modifica')->nullable();
            $table->boolean('vigente')->default(true);
            
            $table->foreign('idUsuario')->references('idUsuario')->on('Usuario');
            $table->foreign('idSexo')->references('idSexo')->on('Sexo');
            $table->foreign('idPais')->references('idPais')->on('Pais');
            $table->foreign('idRegion')->references('idRegion')->on('Region');
            $table->foreign('idProvincia')->references('idProvincia')->on('Provincia');
            $table->foreign('idComuna')->references('idComuna')->on('Comuna');
        });
    }

    public function down() {
        Schema::dropIfExists('Persona');
    }
}
