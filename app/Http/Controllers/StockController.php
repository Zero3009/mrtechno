<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Stock;
use Validator;

class StockController extends Controller
{
    public function Index()
    {
    	return view('stock.stock');
    }
    public function NewStock(Request $request)
    {
    	DB::beginTransaction();
    	try 
        {
            $validator = Validator::make($request->all(), [
                'codbarras' => 'required',
                'modelo' => 'required',
                'proveedor' => 'required',
                'precioEntrada' => 'required',
                'fecha' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            for ($i=0; $i < sizeof($request->serial); $i++) { 
            	$query = new Stock;
                $query->prods_id = $request->modelo[0];
                $query->provs_id = $request->proveedor[0];
                $query->serial = $request->serial[$i];
                $query->precioEntrada = $request->precioEntrada[0];
                $query->fechaEntrada =$request->fecha[0];
            $query->save();
            }
            DB::commit();
            return redirect('/admin/stock');
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
