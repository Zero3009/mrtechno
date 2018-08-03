<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function Index()
    {
    	return view('stock.stock');
    }
}
