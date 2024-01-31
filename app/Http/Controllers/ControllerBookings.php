<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Booking_gallerys;
use App\Models\Categories;
use App\Models\Recommendations;
use App\Models\Valorations;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Toastr;

use Carbon\Carbon;

class ControllerBookings extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $bookings = Bookings::leftJoin('booking_gallerys', 'booking_gallerys.idBooking', '=', 'bookings.idBooking')
                ->join('users', 'users.id', '=', 'bookings.idPerson')
                ->join('categories', 'categories.idCategory', '=', 'bookings.idCategory')
                ->select(
                    'bookings.*',
                    'booking_gallerys.idBooking_gallery',
                    'booking_gallerys.image',
                    'users.id as idUser',
                    'users.name',
                    'users.email',
                    'users.idCard',
                    'users.firstLastName',
                    'users.secondLastName',
                    'users.phone',
                    'users.address',
                    'users.idRol',
                    'categories.typeCategory'
                )
                ->get();

            $category = Categories::all();
            $valoration = [];

            foreach ($bookings as $booking) {
                $averageScore = Valorations::where('idBooking', $booking->idBooking)->avg('score');
                $valoration[$booking->idBooking] = $averageScore;
            }

            return view('body.index', compact('bookings', 'valoration'));
        } else {
            $booking = Bookings::findorfail($id);

            if (!$booking) {
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }

            $bookings = Bookings::leftJoin('booking_gallerys', 'booking_gallerys.idBooking', '=', 'bookings.idBooking')
                ->join('users', 'users.id', '=', 'bookings.idPerson')
                ->join('categories', 'categories.idCategory', '=', 'bookings.idCategory')
                ->where('bookings.idBooking', '=', $id)
                ->select(
                    'bookings.idBooking',
                    'bookings.title',
                    'bookings.description',
                    'bookings.state',
                    'bookings.price',
                    'bookings.location',
                    'bookings.totalPossibleReservation',
                    'bookings.uploadDate',
                    'bookings.idPerson',
                    'bookings.idCategory',
                    'booking_gallerys.idBooking_gallery',
                    'booking_gallerys.image',
                    'users.id as idUser',
                    'users.name',
                    'users.email',
                    'users.idCard',
                    'users.firstLastName',
                    'users.secondLastName',
                    'users.phone',
                    'users.address',
                    'users.idRol',
                    'categories.typeCategory'
                )
                ->get();
                foreach ($bookings as $booking) {
                    $idCategory_aux = $booking->idCategory;
                }
                
                $isRecommendationExists =  Recommendations::where('idPerson', auth()->user()->id)
                ->where('idCategory',$idCategory_aux)
                ->first();
    
                //make recommendation
                if (!$isRecommendationExists) {
                    $recommendation = new Recommendations();
                    $recommendation->idPerson = auth()->user()->id;
                    $recommendation->idCategory = $idCategory_aux;
                    $recommendation->counter = 0;
                    $recommendation->save();
    //$isRecommendationExists->idCategory == $request->input('idCategory')
                }else{
                    $updateRecommendation = Recommendations::findOrFail($isRecommendationExists->idRecommendation);
                    $updateRecommendation->idPerson = auth()->user()->id;
                    $updateRecommendation->idCategory = $idCategory_aux;
                    $updateRecommendation->counter = $updateRecommendation->counter+1;
                    $updateRecommendation->save();
                }
                
            $valoration = [];

            foreach ($bookings as $booking) {
                $averageScore = Valorations::where('idBooking', $booking->idBooking)->avg('score');
                $valoration[$booking->idBooking] = $averageScore;
            }

            return view('body/components/booking_complete', compact('bookings', 'valoration'));
        }
    } //End of index
    public function store(Request $request)
    {
        try {
            $input = $request->all();

            // Verificar si se envió una imagen y guardarla
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/booking_images'), $filename);
                $input['image'] = $filename;
            } else {
                $input['image'] = null; // No se ha proporcionado ninguna imagen
            }

            $booking = new Bookings();
            $booking->fill($input); // Llenar el modelo con los datos del formulario
            $booking->uploadDate = now()->toDateTimeString(); // Carbon se encargará de dar formato adecuado
            $booking->save();

            // Crear booking_gallery solo si hay una imagen
            if ($input['image'] !== null) {
                $booking_gallery = new Booking_gallerys(['image' => $input['image']]);
                $booking->booking_gallery()->save($booking_gallery);
            }

            $notification = [
                'message' => 'El hospedaje se guardó con éxito',
                'alert-type' => 'success'
            ];

            return redirect()->route('booking.index')->with($notification);
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

            $booking = Bookings::find($id);
            $isBookingExists = Bookings::where('idPerson', [$request->input('idPerson')])
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
            $booking = Bookings::where('idBooking', $id)->first();

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
            $bookings = Bookings::join('users', 'users.id', '=', 'bookings.idPerson')
                ->join('booking_gallerys', 'booking_gallerys.idBooking', '=', 'bookings.idBooking')
                ->join('categories', 'categories.idCategory', '=', 'bookings.idCategory')
                ->where('bookings.idCategory', '=', $id)
                ->select(
                    'bookings.*',
                    'users.idCard',
                    'users.name',
                    'users.firstLastName',
                    'users.secondLastName',
                    'users.phone',
                    'users.email',
                    'booking_gallerys.idBooking_gallery',
                    'booking_gallerys.image',
                    'categories.typeCategory'
                )
                ->get();

            $valoration = [];

            foreach ($bookings as $booking) {
                $averageScore = Valorations::where('idBooking', $booking->idBooking)->avg('score');
                $valoration[$booking->idBooking] = $averageScore;
            }


            if ($bookings->isEmpty()) {
                // Mensaje de éxito en la sesión flash
                session()->flash('success', 'El registro se ha guardado correctamente.');
                return redirect()->route('booking.index');
            }
            

            return view('body.index', compact('bookings', 'valoration'));
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } //End filter_by_category
} //End controllerBooking
