<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarpoolCarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'car_type_id'         => $this->car_type_id,
            'brand'               => $this->brand,
            'description'         => $this->description,
            'default_luggage_id'  => $this->default_luggage_id,
            'is_smoking_allowed'  => $this->is_smoking_allowed,
            'is_isofix_present'   => $this->is_isofix_present,
            'price_per_km_per_seat' => $this->price_per_km_per_seat,
            'created_at'                => $this->created_at,
            'updated_at'                => $this->updated_at,
         ];
    }
}
