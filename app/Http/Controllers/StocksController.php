<?php 

namespace App\Http\Controllers;

use App\Stock;
use App\StockMoves;
use App\Producto;
use Illuminate\Http\Request;

class StocksController extends Controller
{

	public function index()
	{
		$stock = Stock::with(['producto', 'producto.tipo'])->get();
		return response()->json($stock, 200);
	}

	public function getminStock()
    {
    	$cont = 0;
		$stocks = Stock::with(['producto', 'producto.tipo'])->get();
        foreach ($stocks as $stock)
        {
        	if ($stock['stk_cantidad'] <= $stock['stk_cantmin']) {
        		$cont++;
        	}
        }
        return response()->json($cont,201);
    }
    public function getlistaminStock()
    {
    	$listamin = [];
		$stocks = Stock::with(['producto', 'producto.tipo'])->get();
        foreach ($stocks as $stock)
        {
        	if ($stock['stk_cantidad'] <= $stock['stk_cantmin']) {
        		$listamin[] = $stock;
        	}
        }
        return response()->json($listamin,201);
    }
	public function getStock($id)
	{
		$stock = Stock::with(['producto', 'producto.tipo'])->find($id);
		if($stock)
		{
			return response()->json($stock, 200);
		}
		return response()->json(["Stock no encontrado"], 404);
	}

	public function createStock(Request $request)
	{
		$stock = Stock::create([
			'stk_cantidad' => $request['stk_cantidad'],
			'stk_precio' => $request['stk_precio'],
			'stk_cantmin' => $request['stk_cantmin'],
			'producto_id' => $request['producto_id'],
			]);
		return response()->json($stock,201);  
	}

	public function updateStock(Request $request, $id)
	{
		$stock = Stock::where('id', $id)
		->update([
			'stk_cantidad' => $request['stk_cantidad'],
			'stk_precio' => $request['stk_precio'],
			'stk_cantmin' => $request['stk_cantmin'],
			]);
        StockMoves::create([
            'tipo' => 'Manual',
            'cantidad_move' => $request['stk_cantidad'],
            'cantidad_stock' => $request['stk_cantidad'],
            'stock_id' => $id
        ]);
		return response()->json($stock,201);
	}

	public function destroyStock($id)
	{
		$stock = Stock::destroy($id);
		return response()->json($stock,201);
	}

}