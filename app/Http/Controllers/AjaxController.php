<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;

use Response;

class AjaxController extends Controller
{
	public function getProductos()
	{
	    $ajax = Productos::select('prods.id as id','prods.modelo as text')
	    					->where('prods.estado','=',true)
	    					->get();
	    return Response::json($ajax);
	}
	public function getMarcas()
	{
		$ajax = Productos::select('prods.marca as text')
							->where('prods.estado','=',true)
							->groupBy('text')
							->get();
		return Response::json($ajax);
	}
}
