<?php

namespace App\Http\Controllers;

use App\Models\Preferences;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerPreferences extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $recommendation = Preferences::join('users','users.id','=','preferences.idPerson')
            ->join('categories','categories.idCategory','=','preferences.idCategory')
            ->select(
                'preferences.idPreference',
                'users.idCard',
                'users.name',
                'users.firstLastName',
                'users.secondLastName',
                'categories.idCategory',
                'categories.typeCategory'
            )
            ->get();
            return response()->json($recommendation);
        } else {

            $recommendation = Preferences::findorfail($id);
            
            if(!$recommendation){
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $recommendation = Preferences::join('users','users.id','=','preferences.idPerson')
            ->join('categories','categories.idCategory','=','preferences.idCategory')
            ->where('preferences.idPreference','=',$id)
            ->select(
                'preferences.idPreference',
                'users.idCard',
                'users.name',
                'users.firstLastName',
                'users.secondLastName',
                'categories.idCategory',
                'categories.typeCategory'
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

            $isPreferencesExists =  Preferences::where('idPerson', [$request->input('idPerson')])
            ->where('idCategory', [$request->input('idCategory')])
            ->first();

            if(!$isPreferencesExists){
                $input = $request->all();
                $preference = new Preferences();
                $preference->idPerson = $input['idPerson'];
                $preference->idCategory = $input['idCategory'];
                $preference->save();
                return response()->json($preference);
            }else{
                return response()->json("Ya ha sido creado el registro",200);
            }
           
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

            $preference = Preferences::find($id);
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
        $preference = Preferences::where('idPreference',$id)->first();
        $preference->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }//end of destroy

    public function history_by_preferences($idPerson){

        $preference = Preferences::join('users','users.id','preferences.idPerson')
        ->join('bookings','bookings.idPerson','users.id')
        ->join('booking_gallerys','booking_gallerys.idBooking','bookings.idBooking')
        ->join('housings','housings.idBooking','bookings.idBooking')
        ->join('categories','categories.idCategory','preferences.idCategory')
        ->where('bookings.idPerson',$idPerson)
        ->select(
            'preferences.*',
            'categories.typeCategory',
            'users.name',
            'users.firstLastName',
            'users.secondLastName',
            'bookings.idBooking',
            'bookings.title',
            'bookings_gallerys.idBooking_gallery',
            'bookings_gallerys.image',
            'housings.idHousing',
            'housings.initial_date',
            'housings.final_date'
        )
        ->get();

        return response()->json($preference, 200);
    }//end of history_by_preferences
}
