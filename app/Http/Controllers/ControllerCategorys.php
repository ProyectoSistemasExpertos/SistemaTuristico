<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ControllerCategorys extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $category = Category::all();
            return response()->json($category);
        } else {
            $category = Category::findorfail($id);
            return response()->json($category);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idCategory' => 'required',
                'typeCategory' => 'required'
            ]);

            $input = $request->all();
            $category = new Category();
            $category->idCategory = $input['idCategory'];
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
                'idCategory' => 'required',
                'typeCategory' => 'required'
            ]);

            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
            } else {
                $category->idCategory = $request->idCategory;
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
        $category = Category::where('idCategory',$id)->first();
        $category->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }
}
