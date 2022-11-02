<?php

use Illuminate\Database\Seeder;

class PerfilMenuItemSeeder extends Seeder {
    public function run() {
        DB::table('Perfil_Menu_Item')->delete();
        
        DB::table('Perfil_Menu_Item')->insert([
            ['idPerfil' => 1, 'idMenu_Item' => 1, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 1, 'idMenu_Item' => 5, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 1, 'idMenu_Item' => 6, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 1, 'idMenu_Item' => 7, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 1, 'idMenu_Item' => 8, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 1, 'idMenu_Item' => 9, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 1, 'idMenu_Item' => 10, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 1, 'idMenu_Item' => 11, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 1, 'idMenu_Item' => 12, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 2, 'idMenu_Item' => 2, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 3, 'idMenu_Item' => 3, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1],
            ['idPerfil' => 4, 'idMenu_Item' => 4, 'lectura' => 1, 'escritura' => 1, 'modifica' => 1, 'elimina' => 1]
        ]);
    }
}