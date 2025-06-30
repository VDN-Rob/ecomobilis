<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\ApiOpen', 'as' => 'open-api.', ], function () {

    Route::apiResource('carpool-rides', CarpoolRideController::class);

    Route::apiResource('carpool-street-coordinates', CarpoolStreetCoordinateController::class);

    Route::apiResource('carpool-street-reservation', CarpoolRideReservationController::class);

    Route::apiResource('carpool-car', CarpoolCarController::class);

});


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
