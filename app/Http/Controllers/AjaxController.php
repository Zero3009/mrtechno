<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;

use Response;

class AjaxController extends Controller
{
	public function getProductos(Request $request)
	{	
		if($request->search){
			$ajax = Productos::select('prods.modelo as text','prods.id as id')
							->where('prods.estado','=',true)
							->where('prods.codbarras', '=', $request->mod)
							//->where('prods.modelo', 'ilike', '%'.$request->search.'%')
							->get();
		}else{
			$ajax = Productos::select('prods.modelo as text','prods.id as id')
							->where('prods.estado','=',true)
							->where('prods.codbarras', '=' , $request->mod)
							->get();
		}
	    return Response::json($ajax);
	}
	public function getMarcas(Request $request)
	{
		if($request->search){
			$ajax = Productos::select('prods.marca as text')
							->where('prods.estado','=',true)
							->where('prods.marca', 'ilike', '%'.$request->search.'%')
							->groupBy('text')
							->get();
		}else{
			$ajax = Productos::select('prods.marca as text')
							->where('prods.estado','=',true)
							//->where('prods.marca', 'ilike', '%'.$text.'%')
							->groupBy('text')
							->get();
		}
		
		return Response::json($ajax);
	}
	public function getCodbarras(Request $request){
		//return $request->all();
		if($request->search){
			$ajax = Productos::select('prods.codbarras as text','prods.id as id')
								->where('prods.codbarras', 'ilike', '%'.$request->search.'%')
								->where('prods.estado','=', true)
								->get();
		}else{
			$ajax = Productos::select('prods.codbarras as text','prods.id as id')
								->where('prods.estado','=', true)
								->get();
		}
		return Response::json($ajax);
	}
}
