<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerRecommendation extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $recommendation = Recommendation::all();
            return response()->json($recommendation);
        } else {
            $recommendation = Recommendation::findorfail($id);
            return response()->json($recommendation);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idRecommendation' => 'required',
                'idPerson' => 'required',
                'idCategory'=> 'required'
            ]);

            $input = $request->all();
            $recommendation = new Recommendation();
            $recommendation->idRecommendation = $input['idRecommendation'];
            $recommendation->idPerson = $input['idPerson'];
            $recommendation->idCategory = $input['idCategory'];
            $recommendation->save();
            return response()->json($recommendation);

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
                'idRecommendation' => 'required',
                'idPerson' => 'required',
                'idCategory' => 'required'
            ]);

            $recommendation = Recommendation::find($id);
            if (!$recommendation) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
            } else {
                $recommendation->idRecommendation = $request->idRecommendation;
                $recommendation->idPerson = $request->idPerson;
                $recommendation->idCategory = $request->idCategory;
                $recommendation->save();
                return response()->json($recommendation);
            }//end if exists
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: La categoría o estado especificada no existe.'], 400);
            }
        } //End try-catch
    } //End of update

    public function destroy($id){
        $recommendation = Recommendation::where('idRecommendation',$id)->first();
        $recommendation->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }
}
