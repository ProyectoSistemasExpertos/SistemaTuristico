<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ControllerPersons extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $person = Person::all();
            return response()->json($person);
        } else {
            $person = Person::findorfail($id);
            return response()->json($person);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idPerson' => 'required',
                'namePerson' => 'required',
                'firstLastNamePerson' => 'required',
                'secondLastNamePerson' => 'required',
                'personPhone' => 'required',
                'personAddress' => 'required',
                'personEmail' => 'required',
                'personPassword' => 'required',
                'rolDescription' => 'required'
            ]);

            $input = $request->all();
            $person = new Person();
            $person->idPerson = $input['idPerson'];
            $person->namePerson = $input['namePerson'];
            $person->firstLastNamePerson = $input['firstLastNamePerson'];
            $person->secondLastNamePerson = $input['secondLastNamePerson'];
            $person->personPhone = $input['personPhone'];
            $person->personAddress = $input['personAddress'];
            $person->personEmail = $input['personEmail'];
            $person->personPassword = Hash::make($input['personPassword']);
            $person->rolDescription = $input['rolDescription'];


            $person->save();

            return response()->json($person);
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
                'idPerson' => 'required',
                'namePerson' => 'required',
                'firstLastNamePerson' => 'required',
                'secondLastNamePerson' => 'required',
                'personPhone' => 'required',
                'personAddress' => 'required',
                'personEmail' => 'required',
                'personPassword' => 'required',
                'rolDescription' => 'required'
            ]);

            $person = Person::find($id);

            if (!$person) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
            } else {
                $person->idPerson = $request->idPerson;
                $person->namePerson = $request->namePerson;
                $person->firstLastNamePerson = $request->firstLastNamePerson;
                $person->secondLastNamePerson = $request->secondLastNamePerson;
                $person->personPhone = $request->personPhone;
                $person->personAddress = $request->personAddress;
                $person->personEmail = $request->personEmail;
                $person->personPassword = Hash::make($request->personPassword);
                $person->rolDescription = $request->rolDescription;
                $person->save();

                return response()->json($person);
            }//end if exists
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: La categoría o estado especificada no existe.'], 400);
            }
        } //End try-catch
    } //End of update

    public function destroy($id){
        $person = Person::where('idPerson',$id)->first();
        $person->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }
}
