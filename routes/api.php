<?php

use App\Http\Controllers\ControllerBooking_gallerys;
use App\Http\Controllers\ControllerBookings;
use App\Http\Controllers\ControllerCategorys;
use App\Http\Controllers\ControllerHousing;
use App\Http\Controllers\ControllerHousings;
use App\Http\Controllers\ControllerPersons;
use App\Http\Controllers\ControllerPreferences;
use App\Http\Controllers\ControllerRecommendations;
use App\Http\Controllers\ControllerValorations;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
/* -------------------------------------------Person-----------------------------------------  */
Route::get('/person/{id?}',[ControllerPersons::class,'index']);
Route::post('/person/create',[ControllerPersons::class, 'store']);
Route::put('/person/update/{id}', [ControllerPersons::class, 'update']);
Route::delete('/person/delete/{id}',[ControllerPersons::class,'destroy']);

/* -------------------------------------------Category-----------------------------------------  */
Route::get('/category/{id?}',[ControllerCategorys::class,'index']);
Route::post('/category/create',[ControllerCategorys::class, 'store']);
Route::put('/category/update/{id}', [ControllerCategorys::class, 'update']);
Route::delete('/category/delete/{id}',[ControllerCategorys::class,'destroy']);

/* -------------------------------------------Recommmendation-----------------------------------------  */
Route::get('/recommendation/{id?}',[ControllerRecommendations::class,'index']);
Route::post('/recommendation/create',[ControllerRecommendations::class, 'store']);
Route::put('/recommendation/update/{id}', [ControllerRecommendations::class, 'update']);
Route::delete('/recommendation/delete/{id}',[ControllerRecommendations::class,'destroy']);

/* -------------------------------------------Preference-----------------------------------------  */
Route::get('/preference/{id?}',[ControllerPreferences::class,'index']);
Route::post('/preference/create',[ControllerPreferences::class, 'store']);
Route::put('/preference/update/{id}', [ControllerPreferences::class, 'update']);
Route::delete('/preference/delete/{id}',[ControllerPreferences::class,'destroy']);

/* -------------------------------------------Housing-----------------------------------------  */
Route::get('/housing/{id?}',[ControllerHousings::class,'index']);
Route::post('/housing/create',[ControllerHousings::class, 'store']);
Route::put('/housing/update/{id}', [ControllerHousings::class, 'update']);
Route::delete('/housing/delete/{id}',[ControllerHousings::class,'destroy']);

/* -------------------------------------------Booking-----------------------------------------  */
Route::get('/booking/{id?}',[ControllerBookings::class,'index']);
Route::post('/booking/create',[ControllerBookings::class, 'store']);
Route::put('/booking/update/{id}', [ControllerBookings::class, 'update']);
Route::delete('/booking/delete/{id}',[ControllerBookings::class,'destroy']);

/* -------------------------------------------Booking_gallery-----------------------------------------  */
Route::get('/booking_gallery/{id?}',[ControllerBooking_gallerys::class,'index']);
Route::post('/booking_gallery/create',[ControllerBooking_gallerys::class, 'store']);
Route::put('/booking_gallery/update/{id}', [ControllerBooking_gallerys::class, 'update']);
Route::delete('/booking_gallery/delete/{id}',[ControllerBooking_gallerys::class,'destroy']);

/* -------------------------------------------Valoration-----------------------------------------  */
Route::get('/valoration/{id?}',[ControllerValorations::class,'index']);
Route::post('/valoration/create',[ControllerValorations::class, 'store']);
Route::put('/valoration/update/{id}', [ControllerValorations::class, 'update']);
Route::delete('/valoration/delete/{id}',[ControllerValorations::class,'destroy']);

