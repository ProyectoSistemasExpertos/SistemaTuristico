<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Booking_gallery;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerBookings extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $booking = Booking::leftJoin('booking_gallery', 'booking_gallery.idBooking', '=', 'booking.idBooking')
                ->select(
                    'booking.idBooking',
                    'booking.description',
                    'booking.state',
                    'booking.price',
                    'booking.location',
                    'booking.totalPossibleReservation',
                    'booking_gallery.idBooking_gallery',
                    'booking_gallery.image'
                )
                ->get();
            return response()->json($booking);
        } else {

            $booking = Booking::findorfail($id);

            if (!$booking) {
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $booking = Booking::join('users', 'users.id', '=', 'booking.idPerson')
                ->join('booking_gallery', 'booking_gallery.idBooking', '=', 'booking.idBooking')
                ->where('booking.idBooking', '=', $id)
                ->select(
                    'booking.*',
                    'users.idCard',
                    'users.name',
                    'users.firstLastName',
                    'users.secondLastName',
                    'users.phone',
                    'users.email',
                    'booking_gallery.idBooking_gallery',
                    'booking_gallery.image'
                )
                ->get();
            return response()->json($booking);
        }
    } //End of index

    public function store(Request $request)
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

            $isBookingExists = Booking::whereIn('idBooking', [$request->input('idBooking')])->first();

            if ($isBookingExists) {
                if ($isBookingExists->idRecommendation == $request->input('idRecommendation')) {
                    return response()->json(['error' => 'La publicación ya ha sido registrada'], 400);
                }
            }

            $input = $request->all();
            $booking = new Booking();
            $booking->description = $input['description'];
            $booking->state = $input['state'];
            $booking->price = $input['price'];
            $booking->location = $input['location'];
            $booking->totalPossibleReservation = $input['totalPossibleReservation'];
            $booking->idPerson = $input['idPerson'];
            $booking->save();

            //Create booking_gallery
            $booking_gallery = new Booking_gallery();
            $booking->booking_gallery()->save($booking_gallery);

            return response()->json($booking);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: el estado especificado o rol no existe.'], 400);
            } else {
                return response()->json(['error' => 'Error de base de datos.'], 500);
            }
        }
    }

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
                $booking->description = $request->description;
                $booking->state = $request->state;
                $booking->price = $request->price;
                $booking->location = $request->location;
                $booking->totalPossibleReservation = $request->totalPossibleReservation;
                $booking->idPerson = $request->idPerson;
                $booking->save();
                return response()->json($booking);
            } //end if exists
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: La categoría o estado especificada no existe.'], 400);
            } else {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } //End try-catch
    } //End of update

    public function destroy($id)
    {
        try {
            $booking = Booking::where('idBooking', $id)->first();

            if (!$booking) {
                return response()->json(['error' => 'No existe reserva con este código'], 400);
            }
            $booking->booking_gallery()->delete();
            $booking->delete();

            return response()->json(['message' => 'Se ha eliminado correctamente!'], 200);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                // Error de clave foránea (FK)
                return response()->json(['error' => 'No se puede eliminar la reserva porque tiene registros relacionados en booking_gallery.'], 400);
            } else {
                return response()->json(['error' => 'Error de base de datos.'], 500);
            }
        }
    }
}
