<?php

namespace App\Http\Controllers\ApiOpen;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSharingOrgRequest;
use App\Http\Requests\UpdateSharingOrgRequest;
use App\Http\Resources\SharingOrgResource;
use App\Models\SharingOrg;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;

class SharingOrgController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SharingOrgResource::collection(SharingOrg::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSharingOrgRequest $request)
    {

        $sharingOrg = SharingOrg::create($request->validated());

        return new SharingOrgResource($sharingOrg);
    }

    /**
     * Display the specified resource.
     */
    public function show(SharingOrg $sharingOrg)
    {
        return new SharingOrgResource($sharingOrg);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSharingOrgRequest $request, SharingOrg $sharingOrg)
    {
        $sharingOrg->update($request->validated());

        return new SharingOrgResource($sharingOrg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SharingOrg $sharingOrg)
    {
        return $sharingOrg->delete();
    }
}
