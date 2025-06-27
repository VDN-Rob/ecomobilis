<?php

namespace App\Http\Controllers\ApiOpen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarpoolStreetCoordinateRequest;
use App\Http\Requests\UpdateCarpoolStreetCoordinateRequest;
use App\Http\Resources\CarpoolStreetCoordinateResource;
use App\Models\CarpoolStreetCoordinate;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;

class CarpoolStreetCoordinateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarpoolStreetCoordinateResource::collection(CarpoolStreetCoordinate::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarpoolStreetCoordinateRequest $request)
    {

        $carpoolStreetCoordinate = CarpoolStreetCoordinate::create($request->validated());

        return new CarpoolStreetCoordinateResource($carpoolStreetCoordinate);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarpoolStreetCoordinate $carpoolStreetCoordinate)
    {
        return new CarpoolStreetCoordinateResource($carpoolStreetCoordinate);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarpoolStreetCoordinateRequest $request, CarpoolStreetCoordinate $carpoolStreetCoordinate)
    {
        $carpoolStreetCoordinate->update($request->validated());

        return new CarpoolStreetCoordinateResource($carpoolStreetCoordinate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarpoolStreetCoordinate $carpoolStreetCoordinate)
    {
         return $carpoolStreetCoordinate->delete();
    }
}
