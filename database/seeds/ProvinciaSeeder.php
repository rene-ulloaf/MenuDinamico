<?php

use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder {
    public function run() {
        DB::table('Provincia')->delete();
        
        DB::table('Provincia')->insert([
            ['idProvincia' => 0, 'nombre' => 'Seleccionar', 'idRegion' => 0],
            ['idProvincia' => 1, 'nombre' => 'Arica', 'idRegion' => 1],
            ['idProvincia' => 2, 'nombre' => 'Parinacota ', 'idRegion' => 1],
            ['idProvincia' => 3, 'nombre' => 'Iquique ', 'idRegion' => 2],
            ['idProvincia' => 4, 'nombre' => 'El Tamarugal ', 'idRegion' => 2],
            ['idProvincia' => 5, 'nombre' => 'Antofagasta ', 'idRegion' => 3],
            ['idProvincia' => 6, 'nombre' => 'El Loa ', 'idRegion' => 3],
            ['idProvincia' => 7, 'nombre' => 'Tocopilla ', 'idRegion' => 3],
            ['idProvincia' => 8, 'nombre' => 'Chañaral ', 'idRegion' => 4],
            ['idProvincia' => 9, 'nombre' => 'Copiapó ', 'idRegion' => 4],
            ['idProvincia' => 10, 'nombre' => 'Huasco ', 'idRegion' => 4],
            ['idProvincia' => 11, 'nombre' => 'Choapa ', 'idRegion' => 5],
            ['idProvincia' => 12, 'nombre' => 'Elqui ', 'idRegion' => 5],
            ['idProvincia' => 13, 'nombre' => 'Limarí ', 'idRegion' => 5],
            ['idProvincia' => 14, 'nombre' => 'Isla de Pascua ', 'idRegion' => 6],
            ['idProvincia' => 15, 'nombre' => 'Los Andes ', 'idRegion' => 6],
            ['idProvincia' => 16, 'nombre' => 'Petorca ', 'idRegion' => 6],
            ['idProvincia' => 17, 'nombre' => 'Quillota ', 'idRegion' => 6],
            ['idProvincia' => 18, 'nombre' => 'San Antonio ', 'idRegion' => 6],
            ['idProvincia' => 19, 'nombre' => 'San Felipe de Aconcagua ', 'idRegion' => 6],
            ['idProvincia' => 20, 'nombre' => 'Valparaiso ', 'idRegion' => 6],
            ['idProvincia' => 21, 'nombre' => 'Chacabuco ', 'idRegion' => 7],
            ['idProvincia' => 22, 'nombre' => 'Cordillera ', 'idRegion' => 7],
            ['idProvincia' => 23, 'nombre' => 'Maipo ', 'idRegion' => 7],
            ['idProvincia' => 24, 'nombre' => 'Melipilla ', 'idRegion' => 7],
            ['idProvincia' => 25, 'nombre' => 'Santiago ', 'idRegion' => 7],
            ['idProvincia' => 26, 'nombre' => 'Talagante ', 'idRegion' => 7],
            ['idProvincia' => 27, 'nombre' => 'Cachapoal ', 'idRegion' => 8],
            ['idProvincia' => 28, 'nombre' => 'Cardenal Caro ', 'idRegion' => 8],
            ['idProvincia' => 29, 'nombre' => 'Colchagua ', 'idRegion' => 8],
            ['idProvincia' => 30, 'nombre' => 'Cauquenes ', 'idRegion' => 9],
            ['idProvincia' => 31, 'nombre' => 'Curicó ', 'idRegion' => 9],
            ['idProvincia' => 32, 'nombre' => 'Linares ', 'idRegion' => 9],
            ['idProvincia' => 33, 'nombre' => 'Talca ', 'idRegion' => 9],
            ['idProvincia' => 34, 'nombre' => 'Arauco ', 'idRegion' => 10],
            ['idProvincia' => 35, 'nombre' => 'Bio Bío ', 'idRegion' => 10],
            ['idProvincia' => 36, 'nombre' => 'Concepción ', 'idRegion' => 10],
            ['idProvincia' => 37, 'nombre' => 'Ñuble ', 'idRegion' => 10],
            ['idProvincia' => 38, 'nombre' => 'Cautín ', 'idRegion' => 11],
            ['idProvincia' => 39, 'nombre' => 'Malleco ', 'idRegion' => 11],
            ['idProvincia' => 40, 'nombre' => 'Valdivia ', 'idRegion' => 12],
            ['idProvincia' => 41, 'nombre' => 'Ranco ', 'idRegion' => 12],
            ['idProvincia' => 42, 'nombre' => 'Chiloé ', 'idRegion' => 13],
            ['idProvincia' => 43, 'nombre' => 'Llanquihue ', 'idRegion' => 13],
            ['idProvincia' => 44, 'nombre' => 'Osorno ', 'idRegion' => 13],
            ['idProvincia' => 45, 'nombre' => 'Palena ', 'idRegion' => 13],
            ['idProvincia' => 46, 'nombre' => 'Aisén ', 'idRegion' => 14],
            ['idProvincia' => 47, 'nombre' => 'Capitán Prat ', 'idRegion' => 14],
            ['idProvincia' => 48, 'nombre' => 'Coihaique ', 'idRegion' => 14],
            ['idProvincia' => 49, 'nombre' => 'General Carrera ', 'idRegion' => 14],
            ['idProvincia' => 50, 'nombre' => 'Antártica Chilena ', 'idRegion' => 15],
            ['idProvincia' => 51, 'nombre' => 'Magallanes ', 'idRegion' => 15],
            ['idProvincia' => 52, 'nombre' => 'Tierra del Fuego ', 'idRegion' => 15],
            ['idProvincia' => 53, 'nombre' => 'Última Esperanza ', 'idRegion' => 15],
            ['idProvincia' => 54, 'nombre' => 'Marga Marga ', 'idRegion' => 6]
        ]);
    }
}