<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        $this->call(SexoSeeder::class);
        $this->call(PaisSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(ComunaSeeder::class);
        $this->call(EstiloSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(PerfilSeeder::class);
        $this->call(PerfilUsuarioSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenuItemSeeder::class);
        $this->call(PerfilMenuItemSeeder::class);
    }
}