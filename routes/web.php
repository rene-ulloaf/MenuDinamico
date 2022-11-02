<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified', 'CheckSelPerfil']);

Auth::routes(['verify' => true]);//vendor\laravel\ui\src\AuthRouteMethods.php
Route::get('cambio_email/{idUsuario}', 'Auth\ResetEmailController@resetEmail')->name('cambio_email');
Route::post('cambio_email/update/{idUsuario}', 'Auth\ResetEmailController@update')->name('cambio_email.update');

//Perfiles
Route::get('perfiles/{idUsuario}', 'PerfilUsuarioController@index')->name('perfiles');
Route::get('perfilUsuario/seleccion/{idUsuario}/{idPerfil}', ["as" => "perfilUsuario.seleccion", "uses" => 'PerfilUsuarioController@seleccion']);

//DashBoard
Route::get('dashboard_sa', 'DashboardController@dashboardSA')->name('dashboard_sa');
Route::get('dashboard_admin', 'DashboardController@dashboardAdmin')->name('dashboard_admin');
Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
Route::get('dashboard_ocacional', 'DashboardController@dashboardOcacional')->name('dashboard_ocacional');
Route::get('dashboard/cantidad_registrados/{idPerfil}', ["as" => "dashboard.cantidad_registrados", "uses" => 'DashboardController@CantidadRegistrados']);
Route::get('dashboard/cantidad_activos', ["as" => "dashboard.cantidad_activos", "uses" => 'UsuarioIngresoController@CantidadActivos']);
Route::get('dashboard/venta_dia/{anno}/{mes}/{dia}', ["as" => "dashboard.venta_dia", "uses" => 'DashboardController@VentaDia']);
Route::get('dashboard/venta_mes/{anno}/{mes}', ["as" => "dashboard.venta_mes", "uses" => 'DashboardController@VentaMes']);
Route::get('dashboard/producto_mas_vendido', ["as" => "dashboard.producto_mas_vendido", "uses" => 'DashboardController@ProductoMasVendido']);

Route::get('region/lista/{idPais}', ["as" => "region.lista", "uses" => 'RegionController@lista']);
Route::get('provincia/lista/{idRegion}', ["as" => "provincia.lista", "uses" => 'ProvinciaController@lista']);
Route::get('comuna/lista/{idProvincia}', ["as" => "comuna.lista", "uses" => 'ComunaController@lista']);

//Route::resource('menu', 'MenuController');
Route::get('menu', ["as" => "menu.index", "uses" => 'MenuController@index']);
Route::get('menu/lista', ["as" => "menu.lista", "uses" => 'MenuController@lista']);
Route::get('menu/obtener/{idMenu}', ["as" => "menu.obtener", "uses" => 'MenuController@obtener']);
Route::post('menu/store', ["as" => "menu.store", "uses" => 'MenuController@store']);
Route::put('menu/update/{idMenu}', ["as" => "menu.update", "uses" => 'MenuController@update']);
Route::put('menu/destroy/{idMenu}', ["as" => "menu.destroy", "uses" => 'MenuController@destroy']);

//Route::resource('menu_item', 'MenuItemController');
Route::get('menu_item/index/{idMenu}', ["as" => "menu_item.index", "uses" => 'MenuItemController@index']);
Route::get('menu_item/listaMenu/{idMenu}/{idUsuario}/{idPerfil}', ["as" => "menu_item.listaMenu", "uses" => 'MenuItemController@listaMenu']);
Route::get('menu_item/lista/{idMenu}', ["as" => "menu_item.lista", "uses" => 'MenuItemController@lista']);
Route::get('menu_item/listaMenuItemPadre/{idMenu}', ["as" => "menu_item.listaMenuItemPadre", "uses" => 'MenuItemController@listaMenuItemPadre']);
Route::post('menu_item/store', ["as" => "menu_item.store", "uses" => 'MenuItemController@store']);
Route::get('menu_item/obtener/{idMenuItem}', ["as" => "menu_item.obtener", "uses" => 'MenuItemController@obtener']);
Route::put('menu_item/update/{idMenu}', ["as" => "menu_item.update", "uses" => 'MenuItemController@update']);
Route::put('menu_item/destroy/{idMenu}', ["as" => "menu_item.destroy", "uses" => 'MenuItemController@destroy']);

//Route::resource('perfil', 'PerfilController');
Route::get('perfil', ["as" => "perfil.index", "uses" => 'PerfilController@index']);
Route::get('perfil/lista', ["as" => "perfil.lista", "uses" => 'PerfilController@lista']);
Route::get('perfil/obtener/{idMenu}', ["as" => "perfil.obtener", "uses" => 'PerfilController@obtener']);
Route::post('perfil/store', ["as" => "perfil.store", "uses" => 'PerfilController@store']);
Route::put('perfil/update/{idMenu}', ["as" => "perfil.update", "uses" => 'PerfilController@update']);
Route::put('perfil/destroy/{idMenu}', ["as" => "perfil.destroy", "uses" => 'PerfilController@destroy']);

Route::resource('persona', 'PersonaController');
//Route::post('persona/destroy/{idPersona}', ["as" => "persona.destroy", "uses" => 'PersonaController@destroy']);
Route::get('persona/lista/{idPerfil}', ["as" => "persona.lista", "uses" => 'PersonaController@lista']);

Route::get('PerfilMenuItem/perfil_menu_item', ["as" => "PerfilMenuItem.perfil_menu_item", "uses" => 'PerfilMenuItemController@perfilMenuItem']);
Route::get('PerfilMenuItem/lista/{idPerfil}', ["as" => "PerfilMenuItem.lista", "uses" => 'PerfilMenuItemController@lista']);
Route::post('PerfilMenuItem/asignar', ["as" => "PerfilMenuItem.asignar", "uses" => 'PerfilMenuItemController@asignar']);
Route::put('PerfilMenuItem/update/{idPerfil}/{idMenuItem}', ["as" => "PerfilMenuItem.update", "uses" => 'PerfilMenuItemController@update']);
Route::put('PerfilMenuItem/destroy/{idPerfil}/{idMenuItem}', ["as" => "PerfilMenuItem.destroy", "uses" => 'PerfilMenuItemController@destroy']);

Route::get('PerfilUsuario/perfil_usuario', ["as" => "PerfilUsuario.perfil_usuario", "uses" => 'PerfilUsuarioController@perfilUsuario']);
Route::get('PerfilUsuario/lista/{idPerfil}', ["as" => "PerfilUsuario.lista", "uses" => 'PerfilUsuarioController@lista']);
Route::post('PerfilUsuario/asignar', ["as" => "PerfilUsuario.asignar", "uses" => 'PerfilUsuarioController@asignar']);
Route::put('PerfilUsuario/destroy/{idPerfil}/{idUsuario}', ["as" => "PerfilUsuario.destroy", "uses" => 'PerfilUsuarioController@destroy']);