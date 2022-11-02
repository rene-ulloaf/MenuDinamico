<?php

use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder{
    public function run() {
        DB::table('Persona')->delete();
        
        DB::table('Persona')->insert([
            [
                'idUsuario' => 1,
                'rut' => '1128923-1',
                'nombres' => 'Super',
                'apellido1' => 'Admin',
                'fecha_nacimiento' => '2017-05-27',
                'email' => 'administracion@tecnobot.cl',
                'idSexo' =>  1,
                'idPais' => 0,
                'idRegion' => 0,
                'idProvincia' => 0,
                'idComuna' => 0,
                'seleccionable' => false,
                'fecha_modifica' => now()
            ],
            [
                'idUsuario' => 2,
                'rut' => '15939283-K',
                'nombres' => 'René',
                'apellido1' => 'Ulloa',
                'fecha_nacimiento' => '1984-09-16',
                'email' => 'rulloaf@tecnobot.cl',
                'idSexo' =>  2,
                'idPais' => 42,
                'idRegion' => 7,
                'idProvincia' => 25,
                'idComuna' => 114,
                'seleccionable' => true,
                'fecha_modifica' => now()
            ]
        ]);
    }
}