<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Booking_gallery;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerBooking_gallerys extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $booking_gallery = Booking_gallery::join('booking','booking.idBooking','=','booking_gallery.idBooking')
            ->select(
                'booking.*',
                'booking_gallery.idBooking_gallery',
                'booking_gallery.image'
            )
            ->get();
            return response()->json($booking_gallery);
        } else {

            $booking_gallery =Booking_gallery::findorfail($id);
            
            if(!$booking_gallery){
                return response()->json(['error' => 'No existe imagen con este código'], 400);
            }
            $booking_gallery = Booking_gallery::join('booking','booking.idBooking','=','booking_gallery.idBooking')
            ->where('booking_gallery.idBooking','=',$id)
            ->select(
                'booking.*',
                'booking_gallery.idBooking_gallery',
                'booking_gallery.image'
            )
            ->get();
            return response()->json($booking_gallery);
        }
    } //End of index

   public function store(Request $request)
{
    try {
        $request->validate([
            'idBooking' => 'required',
            //'image'=>'nullable|image|dimensions:min_width = 200, min_height = 200'
            'image'=>'nullable|image'
        ]);

        $input = $request->all();
        $booking_gallery = new Booking_gallery();
        $booking_gallery->image = $input['image'];
        $booking_gallery->idBooking = $input['idBooking'];
        $booking_gallery->save();

        return response()->json($booking_gallery,201);

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
                'image' => 'required|image|dimensions:min_width = 200, min_height = 200',
                'idBooking' => 'required',
            ]);

            $booking_gallery = Booking_gallery::find($id);
            $isBooking_galleryExists =  Booking_gallery::where('idPerson', [$request->input('idPerson')])
            ->first();
            if ($isBooking_galleryExists) {
                if ($booking_gallery->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'No es posible cambiar la persona de esta publicacion de autor'], 400);
                }
            }
            
            if (!$booking_gallery) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
                
            } else {
                $booking_gallery->$booking_gallery = $id;
                $booking_gallery->image = $request->image;
                $booking_gallery->idBooking = $request->idBooking;
                $booking_gallery->save();
                return response()->json($booking_gallery);
                
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
        $booking_gallery = Booking_gallery::where('idBooking_gallery',$id)->first();
        $booking = Booking::where('booking','booking.idBooking','=','booking_gallery.idBooking');
        if($booking){
            return response()->json(['error' => 'No es posible eliminar ya que hay una publicación vigente.'], 400);
        }
        $booking_gallery->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }
}
