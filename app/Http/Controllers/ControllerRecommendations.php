<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerRecommendations extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $recommendation = Recommendation::join('users','users.id','=','recommendation.idPerson')
            ->join('category','category.idCategory','=','recommendation.idCategory')
            ->select(
                'recommendation.idRecommendation',
                'users.idCard',
                'users.name',
                'users.firstLastName',
                'users.secondLastName',
                'category.idCategory',
                'category.typeCategory'
            )
            ->get();
            return response()->json($recommendation);
        } else {

            $recommendation = Recommendation::findorfail($id);
            
            if(!$recommendation){
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $recommendation = Recommendation::join('users','users.id','=','recommendation.idPerson')
            ->join('category','category.idCategory','=','recommendation.idCategory')
            ->where('recommendation.idRecommendation','=',$id)
            ->select(
                'recommendation.idRecommendation',
                'users.idCard',
                'users.name',
                'users.firstLastName',
                'users.secondLastName',
                'category.idCategory',
                'category.typeCategory'
            )
            ->get();
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

            $isRecommendationExists =  Recommendation::whereIn('idRecommendation', [$request->input('idRecommendation')])
            ->orWhereIn('idPerson', [$request->input('idPerson')])
            ->first();

            if ($isRecommendationExists) {
                if ($isRecommendationExists->idRecommendation == $request->input('idRecommendation')) {
                    return response()->json(['error' => 'La recomendación ya ha sido registrado'], 400);
                } elseif ($isRecommendationExists->idPerson == $request->input('idPerson')) {
                    return response()->json(['error' => 'La persona ya ha sido registrada'], 400);
                }
            }

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
            $isRecommendationExists =  Recommendation::where('idPerson', [$request->input('idPerson')])
            ->first();

            if ($isRecommendationExists) {
                if ($recommendation->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'No es posible cambiar la persona de esta recomendación'], 400);
                }
            }
            
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
