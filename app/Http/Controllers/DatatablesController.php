<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Proveedores;
use App\Productos;
use Yajra\Datatables\Datatables;
use DB;

class DatatablesController extends Controller
{
	public function GetProveedores()
	{
		$retornar = Proveedores::select(['provs.id', 'provs.nombre', 'provs.tel'])
					->where('estado','=', true);
		$datatables = app('datatables')
						->of($retornar)
						->addColumn('action', function($retornar){
							return '<a href="/admin/proveedores/editar/'.$retornar->id.'" class="btn btn-xs btn-primary details-control"><i class="glyphicon glyphicon-edit"></i></a><a href="#" class="btn btn-xs btn-danger delete" data-id="'.$retornar->id.'"><i class="glyphicon glyphicon-trash"></i></a>';
						});
		return $datatables->make(true); 
	}
	public function GetProductos()
	{
		$retornar = Productos::select(['prods.id', 'prods.tipo','prods.marca','prods.modelo','prods.codbarras'])->where('estado','=', true);
		$datatables = app('datatables')
						->of($retornar)
						->addColumn('action', function($retornar){
							return '<a href="/admin/productos/editar/'.$retornar->id.'" class="btn btn-xs btn-primary details-control"><i class="glyphicon glyphicon-edit"></i></a><a href="#" class="btn btn-xs btn-danger delete" data-id="'.$retornar->id.'"><i class="glyphicon glyphicon-trash"></i></a>';
						});
		return $datatables->make(true);
	}
}
