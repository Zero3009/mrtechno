<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Etiquetas;
use DB;
use Redirect;
use View;
use Validator;

class EtiquetasController extends Controller
{
    public function Index() 
    {
    	return view('etiquetas.etiquetas');
    }
    public function NuevoEtiquetaView()
    {
    	return view('etiquetas.etiquetas_nuevo');
    }
    public function EditarEtiquetaView($id)
    {
        $etiqueta = Etiquetas::select('*')->where('id','=', $id)->first();
        return View::make('etiquetas.etiquetas_editar')->with('etiqueta', $etiqueta); 
    }
    public function NuevoEtiqueta(Request $request)
    {
    	DB::beginTransaction();
    	try 
        {
            $validator = Validator::make($request->all(), [
                'nombre' => 'required',
                'tipo' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $query = new Etiquetas;
                $query->nombre = $request->nombre;
                $query->tipo = $request->tipo;
            $query->save();
            DB::commit();
            return redirect('/admin/etiquetas');
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
