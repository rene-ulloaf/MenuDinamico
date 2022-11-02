<?php

use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder {
    public function run() {
        DB::table('Region')->delete();
        
        DB::table('Region')->insert([
            ['idRegion' => 0, 'nombre' => '', 'orden' => 0, 'idPais' => 0],
            ['idRegion' => 1, 'nombre' => 'Arica y Parinacota XV', 'orden' => 2, 'idPais' => 42],
            ['idRegion' => 2, 'nombre' => 'Tarapacá I', 'orden' => 3, 'idPais' => 42],
            ['idRegion' => 3, 'nombre' => 'Antofagasta II', 'orden' => 4, 'idPais' => 42],
            ['idRegion' => 4, 'nombre' => 'Atacama III', 'orden' => 5, 'idPais' => 42],
            ['idRegion' => 5, 'nombre' => 'Coquimbo IV', 'orden' => 6, 'idPais' => 42],
            ['idRegion' => 6, 'nombre' => 'Valparaiso V', 'orden' => 7, 'idPais' => 42],
            ['idRegion' => 7, 'nombre' => 'Metropolitana de Santiago RM', 'orden' => 1, 'idPais' => 42],
            ['idRegion' => 8, 'nombre' => 'Libertador General Bernardo O\'Higgins VI', 'orden' => 8, 'idPais' => 42],
            ['idRegion' => 9, 'nombre' => 'Maule VII', 'orden' => 9, 'idPais' => 42],
            ['idRegion' => 10, 'nombre' => 'Biobío VIII', 'orden' => 10, 'idPais' => 42],
            ['idRegion' => 11, 'nombre' => 'La Araucanía IX', 'orden' => 11, 'idPais' => 42],
            ['idRegion' => 12, 'nombre' => 'Los Ríos XIV', 'orden' => 12, 'idPais' => 42],
            ['idRegion' => 13, 'nombre' => 'Los Lagos X', 'orden' => 13, 'idPais' => 42],
            ['idRegion' => 14, 'nombre' => 'Aisén del General Carlos Ibáñez del Campo XI', 'orden' => 14, 'idPais' => 42],
            ['idRegion' => 15, 'nombre' => 'Magallanes y de la Antártica Chilena XII', 'orden' => 15, 'idPais' => 42]
        ]);
    }
}