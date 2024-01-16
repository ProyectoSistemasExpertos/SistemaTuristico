<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerBookings extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $booking = Booking::join('person','person.idPerson','=','booking.idPerson')
            ->select(
                'booking.*',
                'person.idCard',
                'person.namePerson',
                'person.firstLastNamePerson',
                'person.secondLastNamePerson',
                'person.personPhone',
                'person.personEmail'
            )
            ->get();
            return response()->json($booking);
        } else {

            $booking =Booking::findorfail($id);
            
            if(!$booking){
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $booking = Booking::join('person','person.idPerson','=','booking.idPerson')
            ->where('booking.idBooking','=',$id)
            ->select(
                'booking.*',
                'person.idCard',
                'person.namePerson',
                'person.firstLastNamePerson',
                'person.secondLastNamePerson',
                'person.personPhone',
                'person.personEmail'
            )
            ->get();
            return response()->json($booking);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            $request->validate([
                'idBooking' => 'required',
                'description' => 'required',
                'state' => 'required',
                'price' => 'required',
                'location' => 'required',
                'totalPossibleReservation' => 'required',
                'idPerson' => 'required'
            ]);

            $isBookingExists =  Booking::whereIn('idBooking', [$request->input('idBooking')])->first();

            if ($isBookingExists) {
                if ($isBookingExists->idRecommendation == $request->input('idRecommendation')) {
                    return response()->json(['error' => 'La publicación ya ha sido registrado'], 400);
                }
            }

            $input = $request->all();
            $booking = new Booking();
            $booking->idbooking = $input['idBooking'];
            $booking->description = $input['description'];
            $booking->state = $input['state'];
            $booking->price = $input['price'];
            $booking->location = $input['location'];
            $booking->totalPossibleReservation = $input['totalPossibleReservation'];
            $booking->idPerson = $input['idPerson'];
            $booking->save();
            return response()->json($booking);

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
                'description' => 'required',
                'state' => 'required',
                'price' => 'required',
                'location' => 'required',
                'totalPossibleReservation' => 'required',
                'idPerson' => 'required'
            ]);

            $booking = Booking::find($id);
            $isBookingExists =  Booking::where('idPerson', [$request->input('idPerson')])
            ->first();
            if ($isBookingExists) {
                if ($booking->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'No es posible cambiar la persona de esta publicacion de autor'], 400);
                }
            }
            
            if (!$booking) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
                
            } else {
                $booking->idbooking = $id;
                $booking->description = $request->description;
                $booking->state = $request->state;
                $booking->price = $request->price;
                $booking->location = $request->location;
                $booking->totalPossibleReservation = $request->totalPossibleReservation;
                $booking->idPerson = $request->idPerson;
                $booking->save();
                return response()->json($booking);
                
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
        $housing = Booking::where('idBooking',$id)->first();
        $housing->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }
}
