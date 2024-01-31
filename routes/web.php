<?php

use App\Http\Controllers\ControllerLogin;

use App\Http\Controllers\ControllerBooking_gallerys;
use App\Http\Controllers\ControllerBookings;
use App\Http\Controllers\ControllerCategorys;
use App\Http\Controllers\ControllerHousings;
use App\Http\Controllers\ControllerPersons;
use App\Http\Controllers\ControllerPreferences;
use App\Http\Controllers\ControllerRecommendations;
use App\Http\Controllers\ControllerValorations;
use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\ControllerRoles;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//Route::view('profile', "body/modules/profile")->name('profile');

//Route::get('/profile/{id}', [ControllerPersons::class, 'dataUser'])->name('profile');

Route::put('/update/{id}', [ControllerPersons::class, 'update'])->name('update');
Route::get('/profile/{id}',[ControllerPersons::class,'profile'])->name('profile');

/* -------------------------------------------Login-----------------------------------------  */

Route::post('/register',[ControllerAuth::class,'register'])->name('register');
Route::post('/login',[ControllerAuth::class,'login'])->name('login');
Route::post('/forgot-password',[ControllerAuth::class,'forgotPassword'])->name('forgot-link');
Route::post('/reset-password',[ControllerAuth::class,'resetPassword'])->name('reset-confirm');
Route::get('/logout',[ControllerAuth::class,'logout'])->name('logout');
/* -------------------------------------------ViewsLogin-----------------------------------------  */
Route::get('/home',function(){
    return view('auth.login');
});
Route::get('/login',[ControllerAuth::class,'showLoginForm'])->name('show-login');
Route::get('/register',[ControllerAuth::class,'showRegisterForm'])->name('show-register');
Route::get('/forgot-password',[ControllerAuth::class,'showForgotPasswordForm'])->name('show-forgot-password');
Route::get('/reset-password/{token}',[ControllerAuth::class,'showResetPasswordForm'])->name('show-reset-password');

/* -------------------------------------------Person-----------------------------------------  */
Route::get('/person/{id?}',[ControllerPersons::class,'index'])->name('person.index');
Route::post('/person/create',[ControllerPersons::class, 'store'])->name('person.store');
Route::put('/person/update/{id}', [ControllerPersons::class, 'update'])->name('person.update');
Route::delete('/person/delete/{id}',[ControllerPersons::class,'destroy'])->name('person.destroy');

/* -------------------------------------------Rol-----------------------------------------  */
Route::get('/rol/{id?}',[ControllerRoles::class,'index'])->name('rol.index');
Route::post('/rol/create',[ControllerRoles::class, 'store'])->name('rol.store');
Route::put('/rol/update/{id}', [ControllerRoles::class, 'update'])->name('rol.update');
Route::delete('/rol/delete/{id}',[ControllerRoles::class,'destroy'])->name('rol.destroy');

/* -------------------------------------------Categories-----------------------------------------  */
Route::get('/category/{id?}',[ControllerCategorys::class,'index'])->name('category.index');
Route::post('/category/create',[ControllerCategorys::class, 'store'])->name('category.create');
Route::put('/category/update/{id}', [ControllerCategorys::class, 'update'])->name('category.update');
Route::delete('/category/delete/{id}',[ControllerCategorys::class,'destroy'])->name('category.destroy');

/* -------------------------------------------Recommmendation-----------------------------------------  */
Route::get('/recommendation/{id?}',[ControllerRecommendations::class,'index'])->name('recommendation.index');
Route::post('/recommendation/create',[ControllerRecommendations::class, 'store'])->name('recommendation.create');
Route::put('/recommendation/update/{id}', [ControllerRecommendations::class, 'update'])->name('recommendation.update');
Route::delete('/recommendation/delete/{id}',[ControllerRecommendations::class,'destroy'])->name('recommendation.delete');
Route::get('/recommendation/showRecommendation/{idPerson}', [ControllerRecommendations::class, 'showRecommendation'])->name('recommendation.showRecommendation');

/* -------------------------------------------Preferences-----------------------------------------  */
Route::get('/preference/{id?}',[ControllerPreferences::class,'index']);
Route::post('/preference/create',[ControllerPreferences::class, 'store']);
Route::put('/preference/update/{id}', [ControllerPreferences::class, 'update']);
Route::delete('/preference/delete/{id}',[ControllerPreferences::class,'destroy']);

Route::get('/preference/history_by_preferences/{idPerson}',[ControllerPreferences::class,'history_by_preferences']);

/* -------------------------------------------Housing-----------------------------------------  */
Route::get('/housing/{id?}',[ControllerHousings::class,'index'])->name('housing.index');
Route::post('/housing/create', [ControllerHousings::class, 'store'])->name('housing.store');
Route::put('/housing/update/{id}', [ControllerHousings::class, 'update']);
Route::delete('/housing/delete/{id}',[ControllerHousings::class,'destroy']);
Route::get('/housing/history_by_user/{idUser}',[ControllerHousings::class,'history_by_user']);
//Route::get('/housing/history_by_bookings/{idBookings?}',[ControllerHousings::class,'history_by_bookings']);

Route::get('/history-by-user/{idUser}', [ControllerHousings::class, 'history_by_user'])->name('history_by_user');
//prueba mike
Route::get('/nav-bar', [ControllerHousings::class, 'showNavbarView']);
/* End housing */

/* -------------------------------------------Booking-----------------------------------------  */
Route::get('/booking/{id?}',[ControllerBookings::class,'index'])->name('booking.index');
Route::post('/booking/create',[ControllerBookings::class, 'store'])->name('booking.create');
Route::put('/booking/update/{id}', [ControllerBookings::class, 'update'])->name('booking.update');
Route::delete('/booking/delete/{id}',[ControllerBookings::class,'destroy'])->name('booking.destroy');
Route::get('/booking/filter_category/{idCategory}',[ControllerBookings::class,'filter_by_category'])->name('booking.filter_by_category');

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


