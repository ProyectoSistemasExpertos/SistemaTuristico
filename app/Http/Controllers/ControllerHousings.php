<?php

namespace App\Http\Controllers;

use App\Models\Housing;
use App\Models\Preference;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerHousings extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $housing = Housing::join('person','person.idPerson','=','housing.idPerson')
            ->select(
                'housing.*',
                'person.idCard',
                'person.namePerson',
                'person.firstLastNamePerson',
                'person.secondLastNamePerson',
                'person.personPhone',
                'person.personEmail'
            )
            ->get();
            return response()->json($housing);
        } else {

            $housing = Housing::findorfail($id);
            
            if(!$housing){
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $housing = Housing::join('person','person.idPerson','=','housing.idPerson')
            ->where('housing.idHousing','=',$id)
            ->select(
                'housing.*',
                'person.idCard',
                'person.namePerson',
                'person.firstLastNamePerson',
                'person.secondLastNamePerson'
            )
            ->get();
            return response()->json($housing);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idHousing' => 'required',
                'initial_date' => 'required',
                'final_date' => 'required',
                'arrival_date' => 'required',
                'total_person' => 'required',
                'idPerson' => 'required'
            ]);

            $isHousingExists =  Housing::whereIn('idHousing', [$request->input('idHousing')])->first();

            if ($isHousingExists) {
                if ($isHousingExists->idRecommendation == $request->input('idRecommendation')) {
                    return response()->json(['error' => 'La reservación ya ha sido registrado'], 400);
                }
            }

            $input = $request->all();
            $housing = new Housing();
            $housing->idHousing = $input['idHousing'];
            $housing->initial_date = $input['initial_date'];
            $housing->final_date = $input['final_date'];
            $housing->arrival_date = $input['arrival_date'];
            $housing->total_person = $input['total_person'];
            $housing->idPerson = $input['idPerson'];
            $housing->save();
            return response()->json($housing);

        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: el estado especificado o rol no existe.'], 400);
            } else {
                return response()->json(['error' => 'Error de base de datos.'], 500);
            }
        } //End try-catch
    } //End of store


    //
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'initial_date' => 'required',
                'final_date' => 'required',
                'arrival_date' => 'required',
                'total_person' => 'required',
                'idPerson' => 'required'
            ]);
            $housing = Housing::find($id);
            $isHousingExists =  Housing::where('idPerson', [$request->input('idPerson')])
            ->first();
            if ($isHousingExists) {
                if ($housing->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'No es posible cambiar la persona de esta recomendación'], 400);
                }
            }
            
            if (!$housing) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
                
            } else {
                $housing->idHousing = $id;
                $housing->initial_date = $request->initial_date;
                $housing->final_date = $request->final_date;
                $housing->arrival_date = $request->arrival_date;
                $housing->total_person = $request->total_person;
                $housing->idPerson = $request->idPerson;
                $housing->save();
                return response()->json($housing);
                
            }//end if exists
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: La categoría o estado especificada no existe.'], 400);
            }else {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } //End try-catch
    } //End of update

    public function destroy($id){
        $housing = Housing::where('idHousing',$id)->first();
        $housing->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }
}
