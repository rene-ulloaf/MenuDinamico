<?php

use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder {
    public function run() {
        DB::table('Perfil')->delete();
        
        DB::table('Perfil')->insert([
            ['idEstilo' => 1, 'nombre' => 'Super Admin', 'pagina_inicio' => 'dashboard_sa', 'descripcion' => '', 'vigente' => 0],
            ['idEstilo' => 1, 'nombre' => 'Administracion', 'pagina_inicio' => 'dashboard_admin', 'descripcion' => 'Perfil administrador', 'vigente' => 1],
            ['idEstilo' => 1, 'nombre' => 'Usuario', 'pagina_inicio' => 'dashboard', 'descripcion' => 'Perfil para usuarios del sistema', 'vigente' => 1],
            ['idEstilo' => 1, 'nombre' => 'Usuario Ocacional', 'pagina_inicio' => 'dashboard_ocacional', 'descripcion' => 'Perfil para usuarios que ocacionalmente utilizan el sistema', 'vigente' => 1]
        ]);
    }
}