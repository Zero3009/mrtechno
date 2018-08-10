<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperacionController extends Controller
{
    public function IndexProveedores()
    {
    	return View('recuperacion.proveedores');
    }
}
