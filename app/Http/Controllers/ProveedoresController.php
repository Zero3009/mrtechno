<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Proveedores;
use DB;
use Redirect;
use View;
use Validator;

class ProveedoresController extends Controller
{
    public function Index(){
    	return view('proveedores.proveedores');
    }
    public function NuevoProveedorView()
    {
        return view('proveedores.proveedores_nuevo');
    }
    public function EditarProveedorView($id)
    {
        $prov = Proveedores::select('*')->where('id','=', $id)->first();
        return View::make('proveedores.proveedores_editar')->with('prov', $prov); 
    }
    public function EliminarProveedor(Request $request)
    {
        //return $request['id'];
        $this->validate($request, [
            'id' => 'required|integer',
        ]);

        $queryinfo = Proveedores::find($request['id']);
            $queryinfo->estado = false;
        $queryinfo->save();
        return Redirect::to('/admin/proveedores')->with('status', 'Se ha eliminado correctamente el usuario.');
    }
    public function EditarProveedorUpdate(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
        ]);

        $post = $request->all();
        Proveedores::find($post['id'])->update([
            'nombre' => $post['nombre'],
            'tel' => $post['tel']
        ]);
        return Redirect::to('/admin/proveedores')->with('status', 'Se ha editado correctamente la etiqueta.');
    }
    public function NuevoProveedor(Request $request){
    	DB::beginTransaction();
    	try 
        {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $query = new Proveedores;
                $query->nombre = $request->nombre;
                $query->tel = $request->tel;
            $query->save();
            DB::commit();
            return redirect('/admin/proveedores')->with('status', 'Proveedor creado correctamente');
        }
        catch(Exception $e)
        {
        	DB::rollback();
        	return redirect()
                ->back()
                ->withErrors('Se ha producido un errro: ( ' . $e->getCode() . ' ): ' . $e->getMessage().' - Copie este texto y envielo a informática');
        }
    }
}
