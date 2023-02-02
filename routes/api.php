<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ApiController\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' =>'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::post('event', [EventController::class, 'EventStore']);
Route::get('/event/edit/{id}',[EventController::class,'StudentEdit']);
Route::put('/event/update/{id}',[EventController::class,'StudentUpdate']);
Route::post('event/permission', [EventController::class, 'EventPermission']);

