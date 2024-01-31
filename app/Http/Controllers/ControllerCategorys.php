<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ControllerCategorys extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $category = Categories::all();
            return response()->json($category);
        } else {
            $category = Categories::findorfail($id);
            return response()->json($category);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            $request->validate([
                'typeCategory' => 'required'
            ]);

            $input = $request->all();
            $category = new Categories();
            $category->typeCategory = $input['typeCategory'];
            $category->save();

            return response()->json($category);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: el estado especificado o rol no existe.'], 400);
            } else {
                return response()->json(['error' => 'Error de base de datos.'], 500);
            }
        } //End try-catch
    } //End of store


    //está teniendo problemas!
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'typeCategory' => 'required'
            ]);

            $category = Categories::find($id);

            if (!$category) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
            } else {
                $category->typeCategory = $request->typeCategory;
                $category->save();
                return response()->json($category);
            }//end if exists
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: La categoría o estado especificada no existe.'], 400);
            }
        } //End try-catch
    } //End of update

    public function destroy($id){
        $category = Categories::where('idCategory', $id)->first();
        if (!$category) {
            return response()->json(['error' => 'La categoría no existe'], 404);
        }
        try {
            $category->delete();
            return response()->json(['message' => 'Se ha eliminado correctamente!'], 200);
        } catch (QueryException $e) {
            return response()->json(['error' => 'No se pudo eliminar la categoría', 'exception' => $e->getMessage()], 500);
        }
    }
}
