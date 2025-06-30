<?php

namespace App\Http\Controllers\ApiOpen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarpoolRideReservationRequest;
use App\Http\Requests\UpdateCarpoolRideReservationRequest;
use App\Http\Resources\CarpoolRideReservationResource;
use App\Models\CarpoolRideReservation;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;

class CarpoolRideReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarpoolRideReservationResource::collection(CarpoolRideReservation::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarpoolRideReservationRequest $request)
    {

        $carpoolRideReservation = CarpoolRideReservation::create($request->validated());

        return new CarpoolRideReservationResource($carpoolRideReservation);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarpoolRideReservation $carpoolRideReservation)
    {
        return new CarpoolRideReservationResource($carpoolRideReservation);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarpoolRideReservationRequest $request, CarpoolRideReservation $carpoolRideReservation)
    {
        $carpoolRideReservation->update($request->validated());

        return new CarpoolRideReservationResource($carpoolRideReservation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarpoolRideReservation $carpoolRideReservation)
    {
         return $carpoolRideReservation->delete();
    }
}
