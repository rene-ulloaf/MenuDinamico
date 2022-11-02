<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearEntidadUsuario extends Migration {
    public function up() {
        Schema::create('Usuario', function (Blueprint $table) {
            $table->bigInteger("idUsuario")->unsigned();
            $table->string('nombre', 45);
            $table->string('apellido', 45);
            $table->string('email', 45)->unique();
            $table->string('password');
            $table->boolean('bloqueado')->default(false);
            $table->dateTime('email_verified_at')->nullable();
            $table->date('fecha_caduca')->nullable();
            $table->dateTime('fecha_creacion')->useCurrent();
            $table->dateTime('fecha_modifica')->nullable();
            $table->rememberToken();
            $table->integer('cantIngreso')->default(0);
            $table->boolean('cambioPassword')->default(false);
            $table->boolean('vigente')->default(true);
            
            $table->primary('idUsuario');
        });
    }

    public function down() {
        Schema::dropIfExists('Usuario');
    }
}