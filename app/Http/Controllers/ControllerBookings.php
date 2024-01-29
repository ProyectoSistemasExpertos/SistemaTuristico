<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Booking_gallery;
use App\Models\Category;
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
                    'users.idRol',
                    'category.typeCategory'

                )
                ->get();

                $category = Category::all();
            return view('body.index',compact('booking','category'));
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
                    'users.idRol',
                    'category.typeCategory'
                )
                ->get();
                return view('body.index',compact('booking'));
        }
    } //End of index

    public function store(Request $request)
{
    try {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'state' => 'required',
            'price' => 'required',
            'location' => 'required',
            'totalPossibleReservation' => 'required',
            'idPerson' => 'required',
            'idCategory' => 'required',
            'image' => 'nullable|image'
        ]);

        $input = $request->all();

        // Verificar si se envió una imagen y guardarla
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName(); // Añadir una marca de tiempo para evitar conflictos de nombres
            $file->move(public_path('upload/booking_images'), $filename);
            $input['image'] = $filename;
        }

        $booking = new Booking();
        $booking->title = $input['title'];
        $booking->description = $input['description'];
        $booking->state = $input['state'];
        $booking->price = $input['price'];
        $booking->location = $input['location'];
        $booking->totalPossibleReservation = $input['totalPossibleReservation'];
        $booking->uploadDate = now()->toDateTimeString(); // Carbon se encargará de dar formato adecuado
        $booking->idPerson = $input['idPerson'];
        $booking->idCategory = $input['idCategory'];
        $booking->save();

        // Crear booking_gallery
        $booking_gallery = new Booking_gallery();
        $booking->booking_gallery()->save($booking_gallery);

        // Guardar la ruta de la imagen en la base de datos si se cargó una imagen
        if (!empty($input['image'])) {
            $booking_gallery->image = $input['image'];
            $booking_gallery->save();
        }

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
}//End controllerBooking
