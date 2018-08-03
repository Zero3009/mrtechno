<?php

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
    return view('proveedores.proveedores');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/stock', 'StockController@IndexStock');
//DATATABLES
Route::get('/datatables/getproveedores', ['uses' => 'DatatablesController@GetProveedores']);
Route::get('/datatables/getetiquetas', ['uses' => 'DatatablesController@GetEtiquetas']);

//PROVEEDORES
Route::get('/admin/proveedores', 'ProveedoresController@Index');

Route::post('/admin/proveedores/nuevo/post', ['uses' => 'ProveedoresController@NuevoProveedor']);
Route::get('/admin/proveedores/nuevo', ['uses' => 'ProveedoresController@NuevoProveedorView']);
Route::get('/admin/proveedores/editar/{id}', ['uses' => 'ProveedoresController@EditarProveedorView']);
Route::post('/admin/proveedores/editar/post', ['uses' => 'ProveedoresController@EditarProveedorUpdate']);
Route::post('/admin/proveedores/eliminar', ['uses' => 'ProveedoresController@EliminarProveedor']);
//FIN PROVEEDORES

//ETIQUETAS
Route::get('/admin/etiquetas', ['uses' => 'EtiquetasController@Index']);
Route::get('/admin/etiquetas/nuevo', ['uses' => 'EtiquetasController@NuevoEtiquetaView']);
Route::post('/admin/etiquetas/nuevo/post', ['uses' => 'EtiquetasController@NuevoEtiqueta']);
Route::get('/admin/etiquetas/editar/{id}', ['uses' => 'EtiquetasController@EditarEtiquetaView']);