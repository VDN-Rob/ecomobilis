<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\ApiOpen', 'as' => 'open-api.', ], function () {

    Route::apiResource('users', UserController::class);

    // carpool
    Route::get('carpool-rides/future',    'CarpoolRideController@future')->name('future');
    Route::post('carpool-rides/matching',    'CarpoolRideController@matching')->name('matching');

    Route::apiResource('carpool-rides', CarpoolRideController::class);

    Route::apiResource('carpool-street-coordinates', CarpoolStreetCoordinateController::class);

    Route::apiResource('carpool-street-reservations', CarpoolRideReservationController::class);

    Route::apiResource('carpool-cars', CarpoolCarController::class);

    // sharing
    Route::apiResource('sharing-org', SharingOrgController::class);

    // ios / android app content
    Route::get('/mobile/language/{lang}',    'MobileAppController@language')->name('language');


});


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
