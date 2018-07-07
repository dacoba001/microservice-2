<?php 

namespace App\Http\Controllers;

use App\Producto;
use App\Carrito;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
	
	public function index()
	{
        $producto = Producto::with(['tipo', 'stocks'])->get();
		return response()->json($producto, 200);
	}
    public function getTipo($tipo_id)
    {
        $producto = Producto::with(['tipo', 'stocks', 'carritos'])->where('tipo_id', $tipo_id)->get();
        return response()->json($producto, 200);;
    }
    public function getCarrito($user_id)
    {
        $producto = Producto::with(['tipo', 'stocks', 'carritos'])->whereNotIn('id', function($q) use ($user_id){
            $q->select('producto_id')
                ->from('carritos')
                ->where('user_id','=', $user_id);
        })->get();
        return response()->json($producto, 200);;
    }

	public function getProducto($id)
	{
		$producto = Producto::find($id);
		if($producto)
		{
			return response()->json($producto, 200);
		}
		return response()->json(["Producto no encontrado"], 404);
	}

	public function createProducto(Request $request)
	{
		$producto = Producto::create([
			'pro_nombre' => $request['pro_nombre'],
			'pro_descripcion' => $request['pro_descripcion'],
            'pro_image' => $request['pro_image'],
			'pro_codigo' => $request['pro_codigo'],
			'tipo_id' => $request['tipo_id'],
			]);
		return response()->json($producto,201);  
	}
	public function updateProducto(Request $request, $id)
	{     
		$producto = Producto::where('id', $id)
		->update([
			'pro_nombre' => $request['pro_nombre'],
			'pro_descripcion' => $request['pro_descripcion'],
			'pro_codigo' => $request['pro_codigo'],
			'tipo_id' => $request['tipo_id'],
			]);
		return response()->json($producto,201);
	}
	public function destroyProducto($id)
	{
		$producto = Producto::destroy($id);
		return response()->json($producto,201);
	}
}