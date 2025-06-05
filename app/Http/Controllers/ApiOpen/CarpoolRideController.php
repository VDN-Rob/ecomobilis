<?php

namespace App\Http\Controllers\ApiOpen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarpoolRideRequest;
use App\Http\Requests\UpdateCarpoolRideRequest;
use App\Http\Resources\CarpoolRideResource;
use App\Models\CarpoolRide;
use Illuminate\Http\Request;

class CarpoolRideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarpoolRideResource::collection(CarpoolRide::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarpoolRideRequest $request)
    {
        $carpoolRide = CarpoolRide::create([
            'travel_start_datetime'      => $request->travel_start_datetime,
            'from_street_coordinates_id' => $request->from_street_coordinates_id,
            'to_street_coordinates_id'  => $request->to_street_coordinates_id,
            'luggage_id'                => $request->luggage_id,
            'seats_available'           => $request->seats_available,
            'remark'                    => $request->remark,
            'price_per_seat'            => $request->price_per_seat,
            'user_id'                   => $request->user_id,
            'group_id'                  => $request->group_id,
            'is_private'                => $request->is_private,
            'is_cancelled'              => $request->is_cancelled,
        ]);

        return new CarpoolRideResource($carpoolRide);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarpoolRide $carpoolRide)
    {
        return new CarpoolRideResource($carpoolRide);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarpoolRideRequest $request, CarpoolRide $carpoolRide)
    {
        $carpoolRide->update([
            'travel_start_datetime'      => $request->travel_start_datetime,
            'from_street_coordinates_id' => $request->from_street_coordinates_id,
            'to_street_coordinates_id'  => $request->to_street_coordinates_id,
            'luggage_id'                => $request->luggage_id,
            'seats_available'           => $request->seats_available,
            'remark'                    => $request->remark,
            'price_per_seat'            => $request->price_per_seat,
            'user_id'                   => $request->user_id,
            'group_id'                  => $request->group_id,
            'is_private'                => $request->is_private,
            'is_cancelled'              => $request->is_cancelled,
        ]);

        return new CarpoolRideResource($carpoolRide);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarpoolRide $carpoolRide)
    {
        return $carpoolRide->delete();
    }
}
