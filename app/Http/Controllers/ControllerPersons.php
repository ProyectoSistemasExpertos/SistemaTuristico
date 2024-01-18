<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Preference;
use App\Models\Recommendation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
                'idCard' => 'required',
                'namePerson' => 'required',
                'firstLastNamePerson' => 'required',
                'secondLastNamePerson' => 'required',
                'personPhone' => 'required',
                'personAddress' => 'required',
                'personEmail' => 'required',
                'personPassword' => 'required',
                'rolDescription' => 'required'
            ]);
            $isPersonExists =  Person::whereIn('personEmail', [$request->input('personEmail')])
                ->orWhereIn('idCard', [$request->input('idCard')])
                ->first();

            if ($isPersonExists) {
                if ($isPersonExists->personEmail == $request->input('personEmail')) {
                    return response()->json(['error' => 'El correo ya ha sido registrado'], 400);
                } elseif ($isPersonExists->idCard == $request->input('idCard')) {
                    return response()->json(['error' => 'La cédula ya ha sido registrada'], 400);
                }
            }
            $input = $request->all();
            $person = new Person();
            $person->idCard = $input['idCard'];
            $person->namePerson = $input['namePerson'];
            $person->firstLastNamePerson = $input['firstLastNamePerson'];
            $person->secondLastNamePerson = $input['secondLastNamePerson'];
            $person->personPhone = $input['personPhone'];
            $person->personAddress = $input['personAddress'];
            $person->personEmail = $input['personEmail'];
            $person->personPassword = Hash::make($input['personPassword']);
            $person->rolDescription = $input['rolDescription'];

            $person->save();

            return response()->json($person, 201);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: el estado especificado o rol no existe.'], 400);
            } else {
                return response()->json(['error' => 'Error de base de datos. ', $e], 500);
            }
        } //End try-catch
    } //End of store


    //está teniendo problemas!
    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'idCard' => 'required',
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
                $person->idCard = $request->idCard;
                $person->namePerson = $request->namePerson;
                $person->firstLastNamePerson = $request->firstLastNamePerson;
                $person->secondLastNamePerson = $request->secondLastNamePerson;
                $person->personPhone = $request->personPhone;
                $person->personAddress = $request->personAddress;
                $person->personEmail = $request->personEmail;
                $person->personPassword = Hash::make($request->personPassword);
                $person->rolDescription = $request->rolDescription;
                $person->save();

                return response()->json($person,);
            } //end if exists
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: La categoría o estado especificada no existe.'], 400);
            }
        } //End try-catch
    } //End of update

    public function destroy($id)
    {
        try {
            $person = Person::findOrFail($id);

            $recommendations = Recommendation::where('idPerson', $id)->get();
            foreach ($recommendations as $recommendation) {
                $recommendation->delete();
            }

            $preferences = Preference::where('idPerson', $id)->get();
            foreach ($preferences as $preference) {
                $preference->delete();
            }

            $person->delete();
            return response()->json(['message' => 'Se ha eliminado correctamente!'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No se encontró el usuario'], 404);
        } catch (QueryException $e) {
            if ($e->getCode() == 1451) {
                return response()->json(['error' => 'No es posible eliminar el usuario debido a una restricción de clave externa. Mensaje de la base de datos: ' . $e->getMessage()], 500);
            } else {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
}
