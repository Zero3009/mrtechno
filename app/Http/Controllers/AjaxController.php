<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Proveedores;
use App\Stock;

use DB;
use Response;

class AjaxController extends Controller
{
	public function getProductos()
	{
		/*if($request->search){
			$ajax = Productos::select('prods.modelo as label','prods.id as value')
							->where('prods.estado','=',true)
							//->where('prods.codbarras', '=', $request->mod)
							->where('prods.modelo', 'ilike', '%'.$request->search.'%')
							->get();*/
		//}else{
			$ajax = Productos::select('prods.modelo as label','prods.id as value')
							->where('prods.estado','=',true)
							//->where('prods.codbarras', '=' , $request->mod)
							->get();
		//}
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
	public function getCodbarras(){
		//return $request->search;
		/*if($request->search){
			$ajax = Productos::select('prods.codbarras as text','prods.id as id')
								->where('prods.codbarras', 'ilike', '%'.$request->search.'%')
								->where('prods.estado','=', true)
								->get();
		}else{*/
			$ajax = Productos::select('prods.codbarras as label','prods.id as value', 'prods.modelo')
								->where('prods.estado','=', true)
								->get();
		//}
		return Response::json($ajax);
	}
	public function getProveedores(){
		/*if($request->search){
			$ajax = Proveedores::select('provs.nombre as text','provs.id as id')
								->where('provs.nombre', 'ilike', '%'.$request->search.'%')
								->where('provs.estado','=', true)
								->get();
		}else{*/
			$ajax = Proveedores::select('provs.nombre as label','provs.id as value')
								->where('provs.estado','=', true)
								->get();
		//}
		return Response::json($ajax);	
	}
	public function getSeriales(Request $request)
	{
		/*if($request->search)
		{
			$ajax = Stock::select('stock.serial as text','stock.id as id')
							->where('stock.estado','=', true)
							->where('stock.serial','ilike', '%'.$request->search.'%')
							->get();
		}else{*/
			$ajax = Stock::select('stock.serial as label')
							->where('stock.estado','=',true)
							->get();
		//}
		return Response::json($ajax);
	}
	public function LineEntrada()
	{

		$ajax = //\DB::table('stock')
				Stock::groupBy('fechaEntrada')
					->selectRaw('sum("stock"."precioEntrada") AS y, "stock"."fechaEntrada" as t')
					->where('estado','=',true)
					->orderBy('fechaEntrada')
					->get();
		return Response::json($ajax);
	}
	public function LineSalida()
	{

		$ajax = //\DB::table('stock')
				Stock::groupBy('fechaSalida')
					->selectRaw('sum("stock"."precioSalida") AS y, "stock"."fechaSalida" as t')
					->where('estado','=',true)
					//->whereNotNull('precioSalida')
					->orderBy('fechaSalida')
					->get();
		return Response::json($ajax);
	}
	public function getTiposProds(Request $request)
	{
		if($request->search){
			
		$ajax = Productos::select('prods.tipo as text')
				->where('prods.tipo','ilike', '%'.$request->search.'%')
				->groupBy('prods.tipo')
				->get();
		}
		else
		{
			$ajax = Productos::select('prods.tipo as text')
				->groupBy('prods.tipo')
				->get();
		}

		return Response::json($ajax);
	}
}
