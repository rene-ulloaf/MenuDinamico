<?php

use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder {
    public function run() {
        DB::table('Menu_Item')->delete();
        
        DB::table('Menu_Item')->insert([
            /*1*/['padre' => 0, 'glosa' => 'Inicio', 'link' => 'dashboard_sa', 'target' => '_parent', 'desplegable' => false, 'habilitado' => true, 'descripcion' => 'Pagina inicio super admin', 'orden' => 1, 'idMenu' => 3],
            /*2*/['padre' => 0, 'glosa' => 'Inicio', 'link' => 'dashboard_admin', 'target' => '_parent', 'desplegable' => false, 'habilitado' => true, 'descripcion' => 'Pagina inicio administrador', 'orden' => 1, 'idMenu' => 3],
            /*3*/['padre' => 0, 'glosa' => 'Inicio', 'link' => 'dashboard', 'target' => '_parent', 'desplegable' => false, 'habilitado' => true, 'descripcion' => 'Pagina inicio usuario generico', 'orden' => 1, 'idMenu' => 3],
            /*4*/['padre' => 0, 'glosa' => 'Inicio', 'link' => 'dashboard_ocacional', 'target' => '_parent', 'desplegable' => false, 'habilitado' => true, 'descripcion' => 'Pagina inicio usuario ocacional', 'orden' => 1, 'idMenu' => 3],
            /*5*/['padre' => 0, 'glosa' => 'Menu', 'link' => 'menu', 'target' => '_parent', 'desplegable' => true, 'habilitado' => true, 'descripcion' => '', 'orden' => 1, 'idMenu' => 1],
            /*6*/['padre' => 0, 'glosa' => 'Perfil', 'link' => 'perfil', 'target' => '_parent', 'desplegable' => true, 'habilitado' => true, 'descripcion' => '', 'orden' => 2, 'idMenu' => 1],
            /*7*/['padre' => 0, 'glosa' => 'Permisos', 'link' => '', 'target' => '_parent', 'desplegable' => true, 'habilitado' => true, 'descripcion' => '', 'orden' => 3, 'idMenu' => 1],
            /*8*/['padre' => 0, 'glosa' => 'Persona', 'link' => '', 'target' => '_parent', 'desplegable' => true, 'habilitado' => true, 'descripcion' => '', 'orden' => 4, 'idMenu' => 1],
            /*9*/['padre' => 7, 'glosa' => 'Asignar menu item a perfil', 'link' => 'PerfilMenuItem/perfil_menu_item', 'target' => '_parent', 'desplegable' => false, 'habilitado' => true, 'descripcion' => 'Asignar menu item a Perfil', 'orden' => 1, 'idMenu' => 1],
            /*10*/['padre' => 7, 'glosa' => 'Asignar perfil a usuario', 'link' => 'PerfilUsuario/perfil_usuario', 'target' => '_parent', 'desplegable' => false, 'habilitado' => true, 'descripcion' => 'Asignar Perfil a usuarios', 'orden' => 2, 'idMenu' => 1],
            /*11*/['padre' => 8, 'glosa' => 'Crear', 'link' => 'persona/create', 'target' => '_parent', 'desplegable' => false, 'habilitado' => true, 'descripcion' => 'Creación de persona', 'orden' => 5, 'idMenu' => 1],
            /*12*/['padre' => 8, 'glosa' => 'Listado', 'link' => 'persona', 'target' => '_parent', 'desplegable' => false, 'habilitado' => true, 'descripcion' => 'Listar personas', 'orden' => 6, 'idMenu' => 1],
        ]);
    }
}