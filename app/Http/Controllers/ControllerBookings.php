<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Booking_gallery;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ControllerBookings extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $booking = Booking::leftJoin('booking_gallery', 'booking_gallery.idBooking', '=', 'booking.idBooking')
                ->join('users', 'users.id', '=', 'booking.idPerson')
                ->join('category', 'category.idCategory', '=', 'booking.idCategory')
                ->select(
                    'booking.*',
                    'booking_gallery.idBooking_gallery',
                    'booking_gallery.image',
                    'users.id as idUser',
                    'users.name',
                    'users.email',
                    'users.idCard',
                    'users.firstLastName',
                    'users.secondLastName',
                    'users.phone',
                    'users.address',
                    'users.rol',
                    'category.typeCategory'

                )
                ->get();
            return response()->json($booking);
        } else {
            $booking = Booking::findorfail($id);

            if (!$booking) {
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $booking = Booking::leftJoin('booking_gallery', 'booking_gallery.idBooking', '=', 'booking.idBooking')
                ->join('users', 'users.id', '=', 'booking.idPerson')
                ->join('category', 'category.idCategory', '=', 'booking.idCategory')
                ->where('booking.idBooking', '=', $id)
                ->select(
                    'booking.*',
                    'booking_gallery.idBooking_gallery',
                    'booking_gallery.image',
                    'users.id as idPerson',
                    'users.name',
                    'users.email',
                    'users.idCard',
                    'users.firstLastName',
                    'users.secondLastName',
                    'users.phone',
                    'users.address',
                    'users.rol',
                    'category.typeCategory'
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
                'idPerson' => 'required',
                'idCategory' => 'required'
            ]);

            $isBookingExists = Booking::whereIn('idBooking', [$request->input('idBooking')])->first();

            if ($isBookingExists) {
                if ($isBookingExists->idRecommendation == $request->input('idRecommendation')) {
                    return response()->json(['error' => 'La publicación ya ha sido registrada'], 400);
                }
            }

            $input = $request->all();
            $booking = new Booking();
            $booking->title = $input['title'];
            $booking->description = $input['description'];
            $booking->state = $input['state'];
            $booking->price = $input['price'];
            $booking->location = $input['location'];
            $booking->totalPossibleReservation = $input['totalPossibleReservation'];
            $booking->uploadDate = Carbon::now()->format('Y-m-d');
            $booking->idPerson = $input['idPerson'];
            $booking->idCategory = $input['idCategory'];
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
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'tittle' => 'required',
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
                $booking->tittle = $request->tittle;
                $booking->description = $request->description;
                $booking->state = $request->state;
                $booking->price = $request->price;
                $booking->location = $request->location;
                $booking->totalPossibleReservation = $request->totalPossibleReservation;
                $booking->idPerson = $request->idPerson;
                $booking->idCategory = $request->idCategory;
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
    } //End destroy

    public function filter_by_category($id)
    {
        try {
            $booking = Booking::join('users', 'users.id', '=', 'booking.idPerson')
                ->join('booking_gallery', 'booking_gallery.idBooking', '=', 'booking.idBooking')
                ->join('category', 'category.idCategory', '=', 'booking.idCategory')
                ->where('booking.idCategory', '=', $id)
                ->select(
                    'booking.*',
                    'users.idCard',
                    'users.name',
                    'users.firstLastName',
                    'users.secondLastName',
                    'users.phone',
                    'users.email',
                    'booking_gallery.idBooking_gallery',
                    'booking_gallery.image',
                    'category.typeCategory'
                )
                ->get();

            if ($booking->isEmpty()) {
                return response()->json(['error' => 'No hay registros con ese idCategory'], 404);
            }

            return response()->json($booking);
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } //End filter_by_category

    public function history_by_booking($idBooking)
    {
        try {
            $booking = Booking::join('housing', 'housing.idBooking', '=', 'booking.idBooking')
                ->join('users', 'users.id', '=', 'booking.idPerson')
                ->join('booking_gallery', 'booking_gallery.idBooking', '=', 'booking.idBooking')
                ->where('housing.idBooking', '=', $idBooking)
                ->select(
                    'booking.*',
                    'users.id as idUser',
                    'users.name',
                    'users.firstLastName',
                    'users.secondLastName',
                    'booking_gallery.idBooking_gallery',
                    'booking_gallery.image',
                    'housing.idHousing',
                    'housing.initial_date',
                    'housing.final_date',
                    'housing.arrival_date',
                    'housing.total_person'
                )
                ->get();
            if ($booking->isEmpty()) {
                return response()->json(['error' => 'No hay registros'], 404);
            }

            return response()->json($booking);
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } //end of history_by_booking

    public function history_by_user($idUser)
    {
        try {
            $booking = Booking::join('housing', 'housing.idBooking', '=', 'booking.idBooking')
                ->join('users', 'users.id', '=', 'booking.idPerson')
                ->join('booking_gallery', 'booking_gallery.idBooking', '=', 'booking.idBooking')
                ->where('housing.idPerson', '=', $idUser)
                ->select(
                    'booking.*',
                    'users.id as idUser',
                    'users.name',
                    'users.firstLastName',
                    'users.secondLastName',
                    'booking_gallery.idBooking_gallery',
                    'booking_gallery.image',
                    'housing.idHousing',
                    'housing.initial_date',
                    'housing.final_date',
                    'housing.arrival_date',
                    'housing.total_person'
                )
                ->get();
            if ($booking->isEmpty()) {
                return response()->json(['error' => 'No hay registros'], 404);
            }

            return response()->json($booking);
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }//End of try-catch
    } //end of History_by_user
}//End controllerBooking
