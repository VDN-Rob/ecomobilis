<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SharingOrgResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                            => $this->id,
            'name'                          => $this->name,
            'short_description'             => $this->short_description,
            'body'                          => $this->body,
            'prop_vehicle_car'              => $this->prop_vehicle_car,
            'prop_vehicle_ecar'             => $this->prop_vehicle_ecar,
            'prop_vehicle_bike'             => $this->prop_vehicle_bike,
            'prop_vehicle_ebike'            => $this->prop_vehicle_ebike,
            'prop_vehicle_cargobike'        => $this->prop_vehicle_cargobike,
            'prop_vehicle_ecargobike'       => $this->prop_vehicle_ecargobike,
            'prop_vehicle_step'             => $this->prop_vehicle_step,

            'website'                       => $this->website,
            'email'                         => $this->email,

            'payment_subscription_info'     => $this->payment_subscription_info,
            'created_at'                    => $this->created_at,
            'updated_at'                    => $this->updated_at,
        ];
    }
}
