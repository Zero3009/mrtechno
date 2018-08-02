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
    return view('admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/stock', 'StockController@IndexStock');
Route::get('/admin/proveedores', 'ProveedoresController@Index');
Route::get('/datatables/get', ['uses' => 'DatatablesController@Get']);
Route::post('/admin/proveedores/nuevo/post', ['uses' => 'ProveedoresController@NuevoProveedor']);
Route::get('/admin/proveedores/nuevo', ['uses' => 'ProveedoresController@NuevoProveedorView']);
Route::get('/admin/proveedores/editar/{id}', ['uses' => 'ProveedoresController@EditarProveedorView']);
Route::post('/admin/proveedores/editar/post', ['uses' => 'ProveedoresController@EditarProveedorUpdate']);
Route::post('/admin/proveedores/eliminar', ['uses' => 'ProveedoresController@EliminarProveedor']);
