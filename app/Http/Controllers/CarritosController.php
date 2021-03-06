<?php

namespace App\Http\Controllers;

use App\Carrito;
use Illuminate\Http\Request;

use App\Http\Requests;

class CarritosController extends Controller
{
    public function index()
    {
        $carrito = Carrito::all();
        return response()->json($carrito, 200);
    }

    public function getCliente($user_id)
    {
        $carrito = Carrito::with(['producto', 'producto.tipo', 'producto.stocks'])->where('user_id', $user_id)->get();
        if($carrito)
        {
            return response()->json($carrito, 200);
        }
        return response()->json(["Producto no encontrado"], 404);
    }

    public function getCarrito($id)
    {
        $carrito = Producto::find($id);
        if($carrito)
        {
            return response()->json($carrito, 200);
        }
        return response()->json(["Producto no encontrado"], 404);
    }

    public function createCarrito(Request $request)
    {
        $existecarrito = Carrito::with(['producto', 'producto.tipo', 'producto.stocks'])
            ->where('user_id', $request['user_id'])
            ->where('producto_id', $request['producto_id'])->get();
        if($existecarrito)
        {
            $carrito = Carrito::where('id', $existecarrito['id'])
                ->update([
                    'car_cantidad' => $existecarrito['car_cantidad'] + $request['car_cantidad'],
                ]);
        }
        else
        {
            $carrito = Carrito::create([
                'car_cantidad' => $request['car_cantidad'],
                'user_id' => $request['user_id'],
                'producto_id' => $request['producto_id'],
            ]);
        }
        return response()->json($carrito,201);
    }
    public function updateCarrito(Request $request, $id)
    {
        $carrito = Producto::where('id', $id)
            ->update([
                'pro_nombre' => $request['pro_nombre'],
                'pro_descripcion' => $request['pro_descripcion'],
                'pro_codigo' => $request['pro_codigo'],
                'tipo_id' => $request['tipo_id'],
            ]);
        return response()->json($carrito,201);
    }
    public function destroyCarrito($id)
    {
        $carrito = Carrito::destroy($id);
        return response()->json($carrito,201);
    }
}
