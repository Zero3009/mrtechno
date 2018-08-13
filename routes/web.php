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
//INICIO
Route::get('/admin/inicio', ['uses' => 'InicioController@Index']);
//FIN INICIO

//AJAX
Route::get('/ajax/productos', ['uses' => 'AjaxController@getProductos']);
Route::get('/ajax/marcas', ['uses' => 'AjaxController@getMarcas']);
Route::get('/ajax/codbarras', ['uses' => 'AjaxController@getCodbarras']);
Route::get('/ajax/proveedores', ['uses' => 'AjaxController@getProveedores']);
Route::get('/ajax/seriales', ['uses' => 'AjaxController@getSeriales']);
Route::get('/ajax/chart', ['uses' => 'AjaxController@LineEntrada']);
Route::get('/ajax/linesalida',['uses' => 'AjaxController@LineSalida']);
//FIN AJAX


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/stock', 'StockController@IndexStock');
//DATATABLES
Route::get('/datatables/getproveedores', ['uses' => 'DatatablesController@GetProveedores']);
Route::get('/datatables/getproductos', ['uses' => 'DatatablesController@GetProductos']);
Route::get('/datatables/getstock', ['uses' => 'DatatablesController@GetStock']);
Route::get('/datatables/getproveedoreseliminados', ['uses' => 'DatatablesController@GetProveedoresEliminados']);
Route::get('/datatables/getproductoseliminados',['uses' => 'DatatablesController@GetProductosEliminados']);

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
Route::get('/admin/stock/editar/{id}', ['uses' => 'StockController@EditStockView']);
Route::post('/admin/stock/editar/post', ['uses' => 'StockController@EditStock']);
Route::post('/admin/stock/eliminar', ['uses' => 'StockController@EliminarStock']);
Route::post('/admin/stock/salida',['uses' => 'StockController@SalidaStock']);
//FIN STOCK

//RECUPERACION
Route::get('/admin/recuperacion/proveedores', ['uses' => 'RecuperacionController@IndexProveedores']);
Route::post('/admin/recuperacion/proveedores/post', ['uses' => 'RecuperacionController@ProveedoresRecuperacion']);
Route::get('/admin/recuperacion/productos', ['uses' => 'RecuperacionController@IndexProductos']);
Route::post('/admin/recuperacion/productos/post', ['uses' => 'RecuperacionController@ProductosRecuperacion']);
//FIN RECUPERACION