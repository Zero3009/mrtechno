<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Productos;
use DB;
use Redirect;
use View;
use Validator;

class ProductosController extends Controller
{
    public function Index() 
    {
    	return view('productos.productos');
    }
    public function NuevoProductoView()
    {
    	return view('productos.productos_nuevo');
    }
    public function EditarProductoView($id)
    {
        $producto = Productos::select('*')->where('id','=', $id)->first();
        return View::make('productos.productos_editar')->with('producto', $producto); 
    }
    public function NuevoProducto(Request $request)
    {
    	DB::beginTransaction();
    	try 
        {
            $validator = Validator::make($request->all(), [
                'tipo' => 'required',
                'modelo' => 'required',
                'marca' => 'required',
                'codbarras' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $query = new Productos;
                $query->tipo = $request->tipo;
                $query->modelo = $request->modelo;
                $query->marca = $request->marca;
                $query->codbarras = $request->codbarras;
            $query->save();
            DB::commit();
            return redirect('/admin/productos');
        }
        catch(Exception $e)
        {
        	DB::rollback();
        	return redirect()
                ->back()
                ->withErrors('Se ha producido un errro: ( ' . $e->getCode() . ' ): ' . $e->getMessage().' - Copie este texto y envielo a informática');
        }
    }
    public function EditarProducto(Request $request)
    {
        $this->validate($request, [
            'tipo' => 'required',
            'modelo' => 'required',
            'marca' => 'required',
            'codbarras' => 'required'
        ]);

        $post = $request->all();
        Productos::find($post['id'])->update([
            'tipo' => $post['tipo'],
            'modelo' => $post['modelo'],
            'marca' => $post['marca'],
            'codbarras' => $post['codbarras']
        ]);
        return Redirect::to('/admin/productos')->with('status', 'Se ha editado correctamente la etiqueta.');
    }
    public function EliminarProducto(Request $request)
    {
        //return $request['id'];
        $this->validate($request, [
            'id' => 'required|integer',
        ]);

        $queryinfo = Productos::find($request['id']);
            $queryinfo->estado = false;
        $queryinfo->save();
        return Redirect::to('/admin/productos')->with('status', 'Se ha eliminado correctamente el producto.');
    }
}
