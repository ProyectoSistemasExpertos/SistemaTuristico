<?php

use App\Http\Controllers\ControllerBooking_gallerys;
use App\Http\Controllers\ControllerBookings;
use App\Http\Controllers\ControllerCategorys;
use App\Http\Controllers\ControllerHousings;
use App\Http\Controllers\ControllerPersons;
use App\Http\Controllers\ControllerPreferences;
use App\Http\Controllers\ControllerRecommendations;
use App\Http\Controllers\ControllerValorations;
use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerRoles;
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
/* -------------------------------------------Login-----------------------------------------  */
Route::post('/register',[ControllerLogin::class,'register']);
Route::post('/login',[ControllerLogin::class,'login']);
Route::get('/logout',[ControllerLogin::class,'logout']);
/* -------------------------------------------Person-----------------------------------------  */
Route::get('/person/{id?}',[ControllerPersons::class,'index']);
Route::post('/person/create',[ControllerPersons::class, 'store']);
Route::put('/person/update/{id}', [ControllerPersons::class, 'update']);
Route::delete('/person/delete/{id}',[ControllerPersons::class,'destroy']);

/* -------------------------------------------Rol-----------------------------------------  */
Route::get('/rol/{id?}',[ControllerRoles::class,'index']);
Route::post('/rol/create',[ControllerRoles::class, 'store']);
Route::put('/rol/update/{id}', [ControllerRoles::class, 'update']);
Route::delete('/rol/delete/{id}',[ControllerRoles::class,'destroy']);

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
Route::get('/recommendation/showRecommendation/{idPerson}', [ControllerRecommendations::class, 'showRecommendation']);

/* -------------------------------------------Preference-----------------------------------------  */
Route::get('/preference/{id?}',[ControllerPreferences::class,'index']);
Route::post('/preference/create',[ControllerPreferences::class, 'store']);
Route::put('/preference/update/{id}', [ControllerPreferences::class, 'update']);
Route::delete('/preference/delete/{id}',[ControllerPreferences::class,'destroy']);

Route::get('/preference/history_by_preferences/{idPerson}',[ControllerPreferences::class,'history_by_preferences']);

/* -------------------------------------------Housing-----------------------------------------  */
Route::get('/housing/{id?}',[ControllerHousings::class,'index']);
Route::post('/housing/create',[ControllerHousings::class, 'store']);
Route::put('/housing/update/{id}', [ControllerHousings::class, 'update']);
Route::delete('/housing/delete/{id}',[ControllerHousings::class,'destroy']);
Route::get('/housing/history_by_user/{idUser}',[ControllerHousings::class,'history_by_user']);
Route::get('/housing/history_by_bookings/{idBookings?}',[ControllerHousings::class,'history_by_bookings']);

/* -------------------------------------------Booking-----------------------------------------  */
Route::get('/booking/{id?}',[ControllerBookings::class,'index']);
Route::post('/booking/create',[ControllerBookings::class, 'store']);
Route::put('/booking/update/{id}', [ControllerBookings::class, 'update']);
Route::delete('/booking/delete/{id}',[ControllerBookings::class,'destroy']);
Route::get('/booking/filter_category/{idCategory}',[ControllerBookings::class,'filter_by_category']);

/* -------------------------------------------Booking_gallery-----------------------------------------  */
Route::get('/booking_gallery/{id?}',[ControllerBooking_gallerys::class,'index']);
Route::post('/booking_gallery/create',[ControllerBooking_gallerys::class, 'store']);
Route::put('/booking_gallery/update/{id}', [ControllerBooking_gallerys::class, 'update']);
Route::get('/booking_gallery/delete/{id}',[ControllerBooking_gallerys::class,'destroy']);

/* -------------------------------------------Valoration-----------------------------------------  */
Route::get('/valoration/{id?}',[ControllerValorations::class,'index']);
Route::post('/valoration/create',[ControllerValorations::class, 'store']);
Route::put('/valoration/update/{id}', [ControllerValorations::class, 'update']);
Route::delete('/valoration/delete/{id}',[ControllerValorations::class,'destroy']);

