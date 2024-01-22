<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Housing;
use App\Models\Person;
use App\Models\Preference;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerHousings extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $housing = Housing::join('users','users.id','=','housing.idPerson')
            ->join('booking','booking.idBooking','=','housing.idBooking')
            ->select(
                'housing.*',
                'users.idCard',
                'users.name',
                'users.firstLastName',
                'users.secondLastName',
                'users.phone',
                'users.email',
                'booking.*'
            )
            ->get();
            return response()->json($housing);
        } else {

            $housing = Housing::findorfail($id);
            
            if(!$housing){
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $housing = Housing::join('users','users.id','=','housing.idPerson')
            ->join('booking','booking.idBooking','=','housing.idBooking')
            ->where('housing.idHousing','=',$id)
            ->select(
                'housing.*',
                'users.idCard',
                'users.name',
                'users.firstLastName',
                'users.secondLastName',
                'booking.*'
            )
            ->get();
            return response()->json($housing);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            $request->validate([
                'initial_date' => 'required',
                'final_date' => 'required',
                'arrival_date' => 'required',
                'total_person' => 'required',
                'idPerson' => 'required',
                'idBooking'=>'required'
            ]);

            $isHousingExists =  Housing::whereIn('idBooking', [$request->input('idBooking')])->first();

            if ($isHousingExists) {
                if ($isHousingExists->idBooking == $request->input('idBooking')) {
                    return response()->json(['error' => 'La reservación ya ha sido registrado'], 400);
                }
            }

            $input = $request->all();
            $housing = new Housing();
            $housing->initial_date = $input['initial_date'];
            $housing->final_date = $input['final_date'];
            $housing->arrival_date = $input['arrival_date'];
            $housing->total_person = $input['total_person'];
            $housing->idPerson = $input['idPerson'];
            $housing->idBooking = $input['idBooking'];
            $housing->save();

            $booking = Booking::find($input['idBooking']);
            if($booking){
                $booking->state = '0';
                $booking->save();
            }

            
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
                'idPerson' => 'required',
                'idBooking'=>'required'
            ]);
            $housing = Housing::find($id);
            $isHousingExists =  Housing::where('idPerson', [$request->input('idPerson')])->first();
           
            if ($isHousingExists) {
                if ($housing->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'No es posible cambiar la persona de esta recomendación'], 400);
                }elseif ($housing->idBooking != $request->input('idBooking')) {
                    return response()->json(['error' => 'El lugar no se puede cambiar'], 400);
                }elseif ($housing->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'El usuario no se puede cambiar'], 400);
                }
            }
            
            if (!$housing) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
                
            } else {
                $housing->initial_date = $request->initial_date;
                $housing->final_date = $request->final_date;
                $housing->arrival_date = $request->arrival_date;
                $housing->total_person = $request->total_person;
                $housing->idPerson = $request->idPerson;
                $housing->idBooking = $request->idBooking;
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
