<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarpoolStreetCoordinateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'street,'               => $this->street,
            'zip_code'              => $this->zip_code,
            'city'                  => $this->city,
            'country'               => $this->country,
            'external_api_id'       => $this->external_api_id,
            'external_api_source'   => $this->external_api_source,
            'osm_id'                => $this->osm_id,
            'osm_way'               => $this->osm_way,
            'lat'                   => $this->lat,
            'lng'                   => $this->lng,
            'user_id'               => $this->user_id,
        ];
    }
}
