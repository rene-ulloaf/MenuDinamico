<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder {
    public function run() {
        DB::table('Menu')->delete();
        
        DB::table('Menu')->insert([
            ['glosa' => 'Administracion Sistema', 'descripcion' => 'Menu de la administracion del sistema'],
            ['glosa' => 'Administracion', 'descripcion' => 'Menu de la administracion de la plataforma'],
            ['glosa' => 'Principal', 'descripcion' => 'Menu propio de la plataforma']
        ]);
    }
}