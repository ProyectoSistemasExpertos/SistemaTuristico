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
                'name' => 'required',
                'firstLastName' => 'required',
                'secondLastName' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required',
                'password' => 'required',
                'rol' => 'required'
            ]);
            $isPersonExists =  Person::whereIn('email', [$request->input('email')])
                ->orWhereIn('idCard', [$request->input('idCard')])
                ->first();

            if ($isPersonExists) {
                if ($isPersonExists->personEmail == $request->input('email')) {
                    return response()->json(['error' => 'El correo ya ha sido registrado'], 400);
                } elseif ($isPersonExists->idCard == $request->input('idCard')) {
                    return response()->json(['error' => 'La cédula ya ha sido registrada'], 400);
                }
            }
            $input = $request->all();
            $person = new Person();
            $person->idCard = $input['idCard'];
            $person->name = $input['name'];
            $person->firstLastName = $input['firstLastName'];
            $person->secondLastName = $input['secondLastName'];
            $person->phone = $input['phone'];
            $person->address = $input['address'];
            $person->email = $input['email'];
            $person->password = Hash::make($input['password']);
            $person->rol = $input['rol'];

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
                'name' => 'required',
                'firstLastName' => 'required',
                'secondLastName' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'email' => 'required',
                'password' => 'required',
                'rol' => 'required'
            ]);

            $person = Person::find($id);

            if (!$person) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
            } else {
                $person->idCard = $request->idCard;
                $person->name = $request->name;
                $person->firstLastName = $request->firstLastName;
                $person->secondLastName = $request->secondLastName;
                $person->phone = $request->phone;
                $person->address = $request->address;
                $person->email = $request->email;
                $person->password = Hash::make($request->password);
                $person->rol = $request->rol;
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

            // Check and delete recommendations
            $recommendations = Recommendation::where('idPerson', $id)->get();
            foreach ($recommendations as $recommendation) {
                $recommendation->delete();
            }

            // Check and delete preferences
            $preferences = Preference::where('idPerson', $id)->get();
            foreach ($preferences as $preference) {
                $preference->delete();
            }

            // Check if recommendations and preferences were deleted
            $recommendationsCount = count($recommendations);
            $preferencesCount = count($preferences);
            $deletedMessage = '';

            if ($recommendationsCount > 0) {
                $deletedMessage .= "Se han eliminado $recommendationsCount recomendaciones. ";
            }

            if ($preferencesCount > 0) {
                $deletedMessage .= "Se han eliminado $preferencesCount preferencias. ";
            }

            // Delete the person
            $person->delete();

            // Return response with appropriate message
            if ($deletedMessage !== '') {
                $message = 'Se ha eliminado correctamente. ' . $deletedMessage;
            } else {
                $message = 'Se ha eliminado correctamente!';
            }

            return response()->json(['message' => $message], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No se encontró el usuario'], 404);
        } catch (QueryException $e) {
            if ($e->getCode() == 1451) {
                return response()->json(['error' => 'No es posible eliminar el usuario debido a una restricción de clave externa. Mensaje de la base de datos: ' . $e->getMessage()], 500);
            } else {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    } //end destroy

}
