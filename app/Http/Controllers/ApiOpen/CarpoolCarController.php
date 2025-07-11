<?php

namespace App\Http\Controllers\ApiOpen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarpoolCarRequest;
use App\Http\Requests\UpdateCarpoolCarRequest;
use App\Http\Resources\CarpoolCarResource;
use App\Models\CarpoolCar;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;

class CarpoolCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarpoolCarResource::collection(CarpoolCar::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarpoolCarRequest $request)
    {
        $carpoolCar = CarpoolCar::create($request->validated());

        return new CarpoolCarResource($carpoolCar);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarpoolCar $carpoolCar)
    {
        return new CarpoolCarResource($carpoolCar);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarpoolCarRequest $request, CarpoolCar $carpoolCar)
    {
        $carpoolCar->update($request->validated());

        return new CarpoolCarResource($carpoolCar);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarpoolCar $carpoolCar)
    {
        return $carpoolCar->delete();
    }
}
