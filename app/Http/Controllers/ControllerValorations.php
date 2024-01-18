<?php

namespace App\Http\Controllers;

use App\Models\Valoration;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerValorations extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $booking = Valoration::join('person','person.idPerson','=','valoration.idPerson')
            ->join('booking','booking.idBooking','=','valoration.idBooking')
            ->join('booking_gallery','booking_gallery.idBooking','=','booking.idBooking')
            ->select(
                'valoration.*',
                'person.idCard',
                'person.namePerson',
                'person.firstLastNamePerson',
                'booking.idBooking',
                'booking.description',
                'booking_gallery.idBooking_gallery',
                'booking_gallery.image'
            )
            ->get();
            return response()->json($booking);
        } else {

            $booking =Valoration::findorfail($id);
            
            if(!$booking){
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $booking = Valoration::join('person','person.idPerson','=','valoration.idPerson')
            ->join('booking','booking.idBooking','=','valoration.idBooking')
            ->join('booking_gallery','booking_gallery.idBooking','=','booking.idBooking')
            ->where('booking.idBooking','=',$id)
            ->select(
                'valoration.*',
                'person.idCard',
                'person.namePerson',
                'person.firstLastNamePerson',
                'booking.idBooking',
                'booking.description',
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
                'idValoration' => 'required',
                'score' => 'required',
                'commentary' => 'required',
                'idPerson' => 'required',
                'idBooking' => 'required'
            ]);

            $isValorationExists =  Valoration::whereIn('idBooking', [$request->input('idBooking')])
            ->orWhere('idPerson',[$request->input('idPerson')])
            ->first();

            if ($isValorationExists) {
                if ($isValorationExists->idValoration == $request->input('idValoration')) {
                    return response()->json(['error' => 'La valoración ya ha sido registrado'], 400);
                }elseif ($isValorationExists->idPerson == $request->input('idPerson')) {
                    return response()->json(['error' => 'La persona ya cuenta con una valoración para esta publicación'], 400);
                }
            }

            $input = $request->all();
            $valoration = new Valoration();
            $valoration->idValoration = $input['idValoration'];
            $valoration->score = $input['score'];
            $valoration->commentary = $input['commentary'];
            $valoration->idPerson = $input['idPerson'];
            $valoration->idBooking = $input['idBooking'];
            $valoration->save();
            return response()->json($valoration);

        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: el estado especificado o rol no existe.'], 400);
            } else {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } //End try-catch
    } //End of store


    //
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'score' => 'required',
                'commentary' => 'required',
                'idPerson' => 'required',
                'idBooking' => 'required'
            ]);

            $valoration = Valoration::find($id);
            $isValorationExists =  Valoration::whereIn('idBooking', [$request->input('idBooking')])
            ->orWhere('idPerson',[$request->input('idPerson')])
            ->first();
            if ($isValorationExists) {
                if ($valoration->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'No es posible cambiar la persona de esta publicacion de autor'], 400);
                }else if ($valoration->idBooking != $request->input('idBooking')) {
                    return response()->json(['error' => 'No es posible cambiar el lugar de destino en esta publicacion'], 400);
                }
            }
            
            if (!$valoration) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
                
            } else {
                $valoration->idValoration = $id;
                $valoration->score = $request->score;
                $valoration->commentary = $request->commentary;
                $valoration->idPerson = $request->idPerson;
                $valoration->idBooking = $request->idBooking;
                $valoration->save();
                return response()->json($valoration);
                
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
        $valoration = Valoration::where('idValoration',$id)->first();
        $valoration->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    }

}
