<?php

use Illuminate\Database\Seeder;

class PerfilUsuarioSeeder extends Seeder {
    public function run() {
        DB::table('Perfil_Usuario')->delete();
        
        DB::table('Perfil_Usuario')->insert([
            ['idUsuario' => 1, 'idPerfil' => 1],
            ['idUsuario' => 2, 'idPerfil' => 2],
            ['idUsuario' => 2, 'idPerfil' => 3]
        ]);
    }
}