<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Recommendations;
use App\Models\Valorations;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ControllerRecommendations extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            $recommendation = Recommendations::join('users', 'users.id', '=', 'recommendations.idPerson')
                ->join('categories', 'categories.idCategory', '=', 'recommendations.idCategory')
                ->select(
                    'recommendations.*',
                    //'users.idCard',
                    //'users.name',
                    //'users.firstLastName',
                    //'users.secondLastName',
                    'categories.idCategory',
                    'categories.typeCategory'
                )
                ->get();
            return response()->json($recommendation);
        } else {

            $recommendation = Recommendations::findorfail($id);

            if (!$recommendation) {
                return response()->json(['error' => 'No existe recomendación con este código'], 400);
            }
            $recommendation = Recommendations::join('users', 'users.id', '=', 'recommendations.idPerson')
                ->join('categories', 'categories.idCategory', '=', 'recommendations.idCategory')
                ->where('recommendations.idRecommendation', '=', $id)
                ->select(
                    'recommendations.*',
                    //'users.idCard',
                    //  'users.name',
                    //  'users.firstLastName',
                    //  'users.secondLastName',
                    //  'category.idCategory',
                    'categories.typeCategory'
                )
                ->get();
            return response()->json($recommendation);
        }
    } //End of index

    public function store(Request $request)
    {
        try {
            var_dump($request);
            die();
            $request->validate([
                'idPerson' => 'required',
                'idCategory' => 'required'
            ]);

            $isRecommendationExists =  Recommendations::where('idPerson', [$request->input('idPerson')])
                ->where('idCategory', [$request->input('idCategory')])
                ->first();

            if (!$isRecommendationExists) {
                $input = $request->all();
                $recommendation = new Recommendations();
                $recommendation->idPerson = $input['idPerson'];
                $recommendation->idCategory = $input['idCategory'];
                $recommendation->counter = 0;
                $recommendation->save();
                return response()->with(201);
                //$isRecommendationExists->idCategory == $request->input('idCategory')
            } else {
                $updateRecommendation = Recommendations::findOrFail($isRecommendationExists->idRecommendation);
                $updateRecommendation->idPerson = $request->idPerson;
                $updateRecommendation->idCategory = $request->idCategory;
                $updateRecommendation->counter = $updateRecommendation->counter + 1;
                $updateRecommendation->save();
                return response()->with(202);
            }
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1452) {
                return response()->json(['error' => 'Error de FK: el estado especificado o rol no existe.'], 400);
            } else {
                return response()->json(['error' => 'Error de base de datos.'], 500);
            }
        } //End try-catch
    } //End of store


    //está teniendo problemas!
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'idRecommendation' => 'required',
                'idPerson' => 'required',
                'idCategory' => 'required'
            ]);
            $recommendation = Recommendations::find($id);
            $isRecommendationExists =  Recommendations::where('idPerson', [$request->input('idPerson')])
                ->first();

            if ($isRecommendationExists) {
                if ($recommendation->idPerson != $request->input('idPerson')) {
                    return response()->json(['error' => 'No es posible cambiar la persona de esta recomendación'], 400);
                }
            }

            if (!$recommendation) {
                return response()->json(['message' => 'No se ha encontrado un registro.'], 404);
            } else {
                $recommendation->idPerson = $request->idPerson;
                $recommendation->idCategory = $request->idCategory;
                $recommendation->counter = $request->counter;
                $recommendation->save();
                return response()->json($recommendation);
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
        $recommendation = Recommendations::where('idRecommendation', $id)->first();
        $recommendation->delete();
        return response()->json(['message' => 'Se ha elimiado correctamente!'], 200);
    } //End of destroy

    public function showRecommendation($id)
    {

        $bookingsComplete = Bookings::leftJoin('booking_gallerys', 'booking_gallerys.idBooking', '=', 'bookings.idBooking')
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
        $recommendations = Recommendations::where('recommendations.idPerson', $id)
            ->select(
                'recommendations.idRecommendation',
                'recommendations.idPerson as recommendation_person',
                'recommendations.counter',
                'recommendations.idCategory',
            )
            ->get();
        // Ordenar las recomendaciones por contador de manera descendente
        $recommendationsSorted = $recommendations->sortByDesc('counter');

        // Obtener las categorías ordenadas por contador de manera descendente
        $categoriesSorted = $recommendationsSorted->pluck('idCategory')->toArray();

        // Filtrar los elementos de $bookingsComplete por categoría, respetando el orden de las categorías ordenadas por contador
        $bookings = collect([]);

        foreach ($categoriesSorted as $category) {
            $filteredBookings = $bookingsComplete->where('idCategory', $category);
            $bookings = $bookings->concat($filteredBookings);
        }

        //dd($recommendation_complete->idCategory);
        //dd($bookings);


        if ($recommendations->isEmpty()) {
            return redirect()->route('booking.index');
        }
        $valoration = [];

        foreach ($bookings as $booking) {
            $averageScore = Valorations::where('idBooking', $booking->idBooking)->avg('score');
            // Redondear el promedio a 2 decimales
            $roundedAverageScore = round($averageScore, 2);
            $valoration[$booking->idBooking] = $roundedAverageScore;
        }
        
        $recommendation_flag = true;
        return view('body.index', compact('bookings', 'valoration', 'recommendation_flag'));
    } //End of makeRecommendation
}
