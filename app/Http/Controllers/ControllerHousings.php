<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Bookings;
use App\Models\Housing;
use App\Models\Housings;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControllerHousings extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $housing = Housings::join('users', 'users.id', '=', 'housings.idPerson')
                ->join('bookings', 'bookings.idBooking', '=', 'housings.idBooking')
                ->select(
                    'housings.*',
                    'users.idCard',
                    'users.name',
                    'users.firstLastName',
                    'users.secondLastName',
                    'users.phone',
                    'users.email',
                    'bookings.*'
                )
                ->get();
            return response()->json($housing);
        } else {

            $housing = Housings::findorfail($id);

            if (!$housing) {
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $housing = Housings::join('users', 'users.id', '=', 'housings.idPerson')
                ->join('bookings', 'bookings.idBooking', '=', 'housings.idBooking')
                ->where('housings.idHousing', '=', $id)
                ->select(
                    'housings.*',
                    'users.idCard',
                    'users.name',
                    'users.firstLastName',
                    'users.secondLastName',
                    'bookings.*'
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
            ]);
    
            $input = $request->all();
            $idBooking = $input['idBooking'];
    
            // Verificar si la reserva ya existe en Housing
            $isHousingExists = Housings::where('idBooking', $idBooking)
                ->where('initial_date', $input['initial_date'])
                ->where('idPerson', $input['idPerson'])
                ->first();
    
            if ($isHousingExists) {
                $notification = [
                    'message' => 'La reserva ya ha sido registrada para esta fecha y persona',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification);
            }
    
            $booking = Bookings::where('idBooking', $idBooking)->first();
            $housing = new Housings();
    
            if ($booking && $booking->totalPossibleReservation >= $input['total_person']) {
                $housing->initial_date = $input['initial_date'];
                $housing->final_date = $input['final_date'];
                $housing->arrival_date = $input['arrival_date'];
                $housing->total_person = $input['total_person'];
                $housing->idPerson = $input['idPerson'];
                $housing->idBooking = $input['idBooking'];
    
                $housing->save();
    
                $booking->state = '0';
                $booking->save();
    
                $notification = [
                    'message' => 'Registro Completo',
                    'alert-type' => 'success'
                ];
    
                return redirect()->route('booking.index', $idBooking)->with($notification);
            } else {
                $notification = [
                    'message' => 'La cantidad de personas supera a la capacidad del hospedaje',
                    'alert-type' => 'error'
                ];
    
                return redirect()->back()->with($notification);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: el estado especificado o rol no existe.'], 400);
            } else {
                return response()->json(['error' => 'Error de base de datos.'], 500);
            }
        }
    }
    


    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'initial_date' => 'required',
                'final_date' => 'required',
                'arrival_date' => 'required',
                'total_person' => 'required',
                'idPerson' => 'required',
                'idBooking' => 'required'
            ]);
            $housing = Housings::find($id);
            $isHousingExists = Housings::where('idPerson', [$request->input('idPerson')])->first();

            if ($isHousingExists) {
                if ($housing->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'No es posible cambiar la persona de esta recomendación'], 400);
                } elseif ($housing->idBooking != $request->input('idBooking')) {
                    return response()->json(['error' => 'El lugar no se puede cambiar'], 400);
                } elseif ($housing->idPerson != $request->input('idPerson')) {
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
        $housing = Housings::where('idHousing', $id)->first();
        $housing->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    } //End of destroy

    public function history_by_bookings($id)
    {
        try {
            if (!$id) {
                // No se proporcionó ningún ID de reserva
                return response()->json(['error' => 'No se proporcionó ningún ID de reserva'], 404);
            } else {
                // Obtener el idBooking más común en la tabla Housing
                $mostCommonBooking = DB::table('housings')
                    ->select('idBooking', DB::raw('COUNT(*) as count'))
                    ->groupBy('idBooking')
                    ->orderByDesc('count')
                    ->first();

                if (!$mostCommonBooking) {
                    return response()->json(['error' => 'No hay registros en la tabla Housing'], 404);
                }

                $mostCommonIdBooking = $mostCommonBooking->idBooking;

                // Recuperar los datos de booking correspondientes al idBooking más común
                $bookings = Housings::join('bookings', 'housings.idBooking', '=', 'bookings.idBooking')
                    ->join('users', 'users.id', '=', 'bookings.idPerson')
                    ->join('booking_gallerys', 'booking_gallerys.idBooking', '=', 'bookings.idBooking')
                    ->where('housings.idBooking', $mostCommonIdBooking)
                    ->select(
                        'bookings.*',
                        'users.id as idUser',
                        'users.name',
                        'users.firstLastName',
                        'users.secondLastName',
                        'booking_gallerys.idBooking_gallery',
                        'booking_gallerys.image',
                        'housings.idHousing',
                        'housings.initial_date',
                        'housings.final_date',
                        'housings.arrival_date',
                        'housings.total_person'
                    )
                    ->get();

                if ($bookings->isEmpty()) {
                    return response()->json(['error' => 'No hay registros'], 404);
                }

                return response()->json($bookings);
            }
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } //End history_by_bookings

    public function history_by_user($idUser)
    {
        try {
            $users = Bookings::join('housings', 'housings.idBooking', '=', 'bookings.idBooking')
                ->join('users', 'users.id', '=', 'bookings.idPerson')
                ->join('booking_gallerys', 'booking_gallerys.idBooking', '=', 'bookings.idBooking')
                ->where('housings.idPerson', '=', $idUser)
                ->select(
                    'bookings.*',
                    'users.id as idUser',
                    'users.name',
                    'users.firstLastName',
                    'users.secondLastName',
                    'booking_gallerys.idBooking_gallery',
                    'booking_gallerys.image',
                    'housings.idHousing',
                    'housings.initial_date',
                    'housings.final_date',
                    'housings.arrival_date',
                    'housings.total_person'
                )
                ->get();

            if ($users->isEmpty()) {
                return view('history_by_user', ['users' => []]);
            }

            return view('body/modules/history_by_user', compact('users'));
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } //End history_by_user

    //Prueba, se debe eliminar
    public function showNavbarView()
    {
        return view('body.navbar');
    }
} //End of controllerHousing
