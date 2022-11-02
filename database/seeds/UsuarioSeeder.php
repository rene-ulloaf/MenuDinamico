<?php

use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder {
    public function run() {
        DB::table('Usuario')->delete();
        
        DB::table('Usuario')->insert([
            [
                'idUsuario' => 1,
                'nombre' => 'Super',
                'apellido' => 'Admin',
                'email' => 'administracion@tecnobot.cl',
                'password' =>  bcrypt('secret'),
                'email_verified_at' => now(),
                'cambioPassword' => true
            ],
            [
                'idUsuario' => 2,
                'nombre' => 'Rene',
                'apellido' => 'Ulloa',
                'email' => 'rulloaf@tecnobot.cl',
                'password' =>  bcrypt('1234'),
                'email_verified_at' => now(),
                'cambioPassword' => true
            ]
        ]);
    }
}