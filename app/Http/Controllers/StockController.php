<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Stock;
use Validator;
use View;
use Redirect;

class StockController extends Controller
{
    public function Index()
    {
    	return view('stock.stock');
    }
    public function NewStock(Request $request)
    {   
        //return $request->all();
    	DB::beginTransaction();
    	try 
        {
            $validator = Validator::make($request->all(), [
                'codbarras' => 'required',
                'modelo' => 'required',
                'proveedor' => 'required',
                'precioEntrada' => 'required',
                'fecha' => 'required',
                'cantidadseriales' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }   


            $g = 0;
                for ($i=0; $i < sizeof($request->cantidadseriales); $i++) {
                    for($h = 0;$h < $request->cantidadseriales[$i];$h++){                        
                        
                        $query = new Stock;
                            $query->prods_id = $request->modelo[$i];
                            $query->provs_id = $request->proveedor[$i];
                            $query->serial = $request->serial[$g];
                            $query->precioEntrada = $request->precioEntrada[$i];
                            $query->fechaEntrada =$request->fecha[$i];
                        $query->save();
                        $g = $g + 1;
                    }
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
    public function EditStockView($id)
    {
        $stock = Stock::select('stock.id','prods.codbarras','stock.serial as serial','provs.nombre','prods.modelo','prods.id as prodsid', 'stock.fechaEntrada', 'stock.precioEntrada')
                        ->join('provs','stock.provs_id','=','provs.id')
                        ->join('prods','stock.prods_id','=','prods.id')
                        ->where('stock.id','=', $id)->first();
        return View::make('stock.stock_editar')->with('stock', $stock);
    }
    public function EditStock(Request $request)
    {
        $this->validate($request, [
            'codbarras' => 'required',
            'modelo' => 'required',
            'fecha' => 'required',
            'precioEntrada' => 'required',
            'proveedor' => 'required',
            'id' => 'required'
        ]);

        $post = $request->all();
        Stock::find($post['id'])->update([
            'modelo' => $post['modelo'],
            'fechaEntrada' => $post['fecha'],
            'precioEntrada' => $post['precioEntrada'],
            'serial' => $post['serial'],
            'provs_id' => $post['proveedor']
        ]);
        return Redirect::to('/admin/stock')->with('status', 'Se ha editado correctamente la etiqueta.');
    }
}
