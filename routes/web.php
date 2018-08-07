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
//AJAX
Route::get('/ajax/productos', ['uses' => 'AjaxController@getProductos']);
Route::get('/ajax/marcas', ['uses' => 'AjaxController@getMarcas']);
Route::get('/ajax/codbarras', ['uses' => 'AjaxController@getCodbarras']);
Route::get('/ajax/proveedores', ['uses' => 'AjaxController@getProveedores']);
//FIN AJAX


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/stock', 'StockController@IndexStock');
//DATATABLES
Route::get('/datatables/getproveedores', ['uses' => 'DatatablesController@GetProveedores']);
Route::get('/datatables/getproductos', ['uses' => 'DatatablesController@GetProductos']);

//PROVEEDORES
Route::get('/admin/proveedores', 'ProveedoresController@Index');

Route::post('/admin/proveedores/nuevo/post', ['uses' => 'ProveedoresController@NuevoProveedor']);
Route::get('/admin/proveedores/nuevo', ['uses' => 'ProveedoresController@NuevoProveedorView']);
Route::get('/admin/proveedores/editar/{id}', ['uses' => 'ProveedoresController@EditarProveedorView']);
Route::post('/admin/proveedores/editar/post', ['uses' => 'ProveedoresController@EditarProveedorUpdate']);
Route::post('/admin/proveedores/eliminar', ['uses' => 'ProveedoresController@EliminarProveedor']);
//FIN PROVEEDORES

//PRODUCTOS
Route::get('/admin/productos', ['uses' => 'ProductosController@Index']);
Route::get('/admin/productos/nuevo', ['uses' => 'ProductosController@NuevoProductoView']);
Route::post('/admin/productos/nuevo/post', ['uses' => 'ProductosController@NuevoProducto']);
Route::get('/admin/productos/editar/{id}', ['uses' => 'ProductosController@EditarProductoView']);
Route::post('/admin/productos/editar/post', ['uses' => 'ProductosController@EditarProducto']);
Route::post('/admin/productos/eliminar', ['uses' => 'ProductosController@EliminarProducto']);
//FIN PRODUCTOS

//STOCK
Route::get('/admin/stock', ['uses' => 'StockController@Index']);
Route::post('/admin/stock/nuevo/post', ['uses' => 'StockController@NewStock']);