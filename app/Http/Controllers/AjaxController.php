<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etiquetas;

use Response;

class AjaxController extends Controller
{
	public function getTags()
	{
	    $ajax = Etiquetas::select('tags.id','tags.nombre')
	    					->where('tags.tipo','=','DEFAULTTAG')
	    					->where('tags.estado','=',true)
	    					->get();
	    return Response::json($ajax);
	}
}
