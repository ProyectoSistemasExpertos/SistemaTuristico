<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerPreferences extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $recommendation = Preference::join('users','users.id','=','preference.idPerson')
            ->join('category','category.idCategory','=','preference.idCategory')
            ->select(
                'preference.idPreference',
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

            $recommendation = Preference::findorfail($id);
            
            if(!$recommendation){
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $recommendation = Preference::join('users','users.id','=','preference.idPerson')
            ->join('category','category.idCategory','=','preference.idCategory')
            ->where('preference.idPreference','=',$id)
            ->select(
                'preference.idPreference',
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
                'idPerson' => 'required',
                'idCategory'=> 'required'
            ]);

            $input = $request->all();
            $preference = new Preference();
            $preference->idPerson = $input['idPerson'];
            $preference->idCategory = $input['idCategory'];
            $preference->save();
            return response()->json($preference);

        } catch (QueryException $e) {
            $errorCode = $e->getCode();
            //var_dump($errorCode);die();
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: el estado especificado o rol no existe.'], 400);
            } elseif($errorCode == 23000) {
                return response()->json(['error' => 'Ya hay un registro con este id'], 400);
            }else{
                return response()->json(['message' => 'Error de base de datos.', 'error' => $e->getMessage()], 500);
            }
        }
        
    } //End of store


    //está teniendo problemas!
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'idPerson' => 'required',
                'idCategory' => 'required'
            ]);

            $preference = Preference::find($id);
            if (!$preference) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
            } else {
                $preference->idPerson = $request->idPerson;
                $preference->idCategory = $request->idCategory;
                $preference->save();
                return response()->json($preference);
            }//end if exists
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: La categoría o estado especificada no existe.'], 400);
            }
        } //End try-catch
    } //End of update

    public function destroy($id){
        $preference = Preference::where('idPreference',$id)->first();
        $preference->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }
}
