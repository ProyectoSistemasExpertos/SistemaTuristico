<?php

namespace App\Http\Controllers;

use App\Models\Recommendations;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerRecommendations extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $recommendation = Recommendations::join('users','users.id','=','recommendations.idPerson')
            ->join('categories','categories.idCategory','=','recommendations.idCategory')
            ->select(
                'recommendations.*',
                //'users.idCard',
                //'users.name',
                //'users.firstLastName',
                //'users.secondLastName',
                'categories.idCategory',
                'categories.typeCategory'
            )
            ->get();
            return response()->json($recommendation);
        } else {

            $recommendation = Recommendations::findorfail($id);
            
            if(!$recommendation){
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $recommendation = Recommendations::join('users','users.id','=','recommendations.idPerson')
            ->join('categories','categories.idCategory','=','recommendations.idCategory')
            ->where('recommendations.idRecommendation','=',$id)
            ->select(
                'recommendations.*',
                //'users.idCard',
              //  'users.name',
              //  'users.firstLastName',
              //  'users.secondLastName',
              //  'category.idCategory',
                'categories.typeCategory'
            )
            ->get();
            return response()->json($recommendation);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            var_dump($request);die();
            $request->validate([
                'idPerson' => 'required',
                'idCategory'=> 'required'
            ]);

            $isRecommendationExists =  Recommendations::where('idPerson', [$request->input('idPerson')])
            ->where('idCategory', [$request->input('idCategory')])
            ->first();

            if (!$isRecommendationExists) {
                $input = $request->all();
                $recommendation = new Recommendations();
                $recommendation->idPerson = $input['idPerson'];
                $recommendation->idCategory = $input['idCategory'];
                $recommendation->counter = 0;
                $recommendation->save();
                return response()->with(201);
//$isRecommendationExists->idCategory == $request->input('idCategory')
            }else{
                $updateRecommendation = Recommendations::findOrFail($isRecommendationExists->idRecommendation);
                $updateRecommendation->idPerson = $request->idPerson;
                $updateRecommendation->idCategory = $request->idCategory;
                $updateRecommendation->counter = $updateRecommendation->counter+1;
                $updateRecommendation->save();
                return response()->with(202);
                
            }
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
            $recommendation = Recommendations::find($id);
            $isRecommendationExists =  Recommendations::where('idPerson', [$request->input('idPerson')])
            ->first();

            if ($isRecommendationExists) {
                if ($recommendation->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'No es posible cambiar la persona de esta recomendación'], 400);
                }
            }
            
            if (!$recommendation) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
            } else {
                $recommendation->idPerson = $request->idPerson;
                $recommendation->idCategory = $request->idCategory;
                $recommendation->counter = $request->counter;
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
        $recommendation = Recommendations::where('idRecommendation',$id)->first();
        $recommendation->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }//End of destroy

    public function showRecommendation($id){
        $recommendations = Recommendations::where('idPerson', $id)->get();


        if($recommendations->isEmpty()){
            return response()->json(['message' => 'No se encontraron recomendaciones para el idPerson dado.'], 404);
        }

        $maxCounters = $recommendations->max('counter');
        $recommendationWithMaxContadores = $recommendations->where('counter', $maxCounters)->first();

        return response()->json([
            'recommendationWithMaxContadores' => $recommendationWithMaxContadores,
        ], 200);
    }//End of makeRecommendation
}
