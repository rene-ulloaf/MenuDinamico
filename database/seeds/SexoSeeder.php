<?php

use Illuminate\Database\Seeder;

class SexoSeeder extends Seeder {
    public function run() {
        DB::table('Sexo')->delete();
        
        DB::table('Sexo')->insert([
            ['glosa' => '', 'vigente' => 0],
            ['glosa' => 'Masculino', 'vigente' => 1],
            ['glosa' => 'Femenino', 'vigente' => 1]
        ]);
    }
}