<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Productos;
use App\Proveedores;
use Redirect;

class RecuperacionController extends Controller
{
    public function IndexProveedores()
    {
    	return View('recuperacion.proveedores');
    }
    public function IndexProductos()
    {
    	return View('recuperacion.productos');
    }
    public function ProveedoresRecuperacion(Request $request)
    {
    	$this->validate($request, [
            'id' => 'required',
        ]);

        $post = $request->all();
        Proveedores::find($post['id'])->update([
            'estado' => true
        ]);
        return Redirect::to('/admin/proveedores')->with('status', 'Se ha restaurado correctamente el proveedor.');
    }
    public function ProductosRecuperacion(Request $request)
    {
    	$this->validate($request, [
            'id' => 'required',
        ]);

        $post = $request->all();
        Productos::find($post['id'])->update([
            'estado' => true
        ]);
        return Redirect::to('/admin/recuperacion/productos')->with('status', 'Se ha restaurado correctamente el proveedor.');
    }
}
