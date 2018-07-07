<?php 

namespace App\Http\Controllers;

use App\Tipo;
use Illuminate\Http\Request;

class TiposController extends Controller
{
	public function index()
	{
		$tipo = Tipo::all();
		return response()->json($tipo, 200);
	}

	public function getTipo($id)
	{
		$tipo = Tipo::find($id);
		if($tipo)
		{
			return response()->json($tipo, 200);
		}
		return response()->json(["Tipo no encontrado"], 404);
	}

	public function createTipo(Request $request)
	{
		$tipo = Tipo::create([
			'tip_nombre' => $request['tip_nombre'],
            'tip_image' => $request['tip_image'],
			]);
		return response()->json($tipo,201);  
	}
	public function updateTipo(Request $request, $id)
	{     
		$tipo = Tipo::where('id', $id)
		->update([
			'tip_nombre' => $request['tip_nombre'],
			]);
		return response()->json($tipo,201);
	}
	public function destroyTipo($id)
	{
        try {
            $tipo = Tipo::destroy($id);
        }
        catch (\Illuminate\Database\QueryException $e) {

            if($e->getCode() == "23000"){ //23000 is sql code for integrity constraint violation
                return response()->json("nodelete", 201);
            }
        }
        return response()->json($tipo,201);
	}
}