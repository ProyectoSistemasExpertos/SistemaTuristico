<?php

use App\Http\Controllers\ControllerCategorys;
use App\Http\Controllers\ControllerPersons;
use App\Http\Controllers\ControllerRecommendation;
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
Route::get('/recommendation/{id?}',[ControllerRecommendation::class,'index']);
Route::post('/recommendation/create',[ControllerRecommendation::class, 'store']);
Route::put('/recommendation/update/{id}', [ControllerRecommendation::class, 'update']);
Route::delete('/recommendation/delete/{id}',[ControllerRecommendation::class,'destroy']);





