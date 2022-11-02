<?php

use Illuminate\Database\Seeder;

class EstiloSeeder extends Seeder {
    public function run() {
        DB::table('Estilo')->delete();
        
        DB::table('Estilo')->insert([
            ['glosa' => 'Default']
        ]);
    }
}