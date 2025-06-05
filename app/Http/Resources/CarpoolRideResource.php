<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarpoolRideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                         => $this->id,
            'travel_start_datetime'      => $this->travel_start_datetime,
            'from_street_coordinates_id' => $this->from_street_coordinates_id,
            'to_street_coordinates_id'  => $this->to_street_coordinates_id,
            'luggage_id'                => $this->luggage_id,
            'seats_available'           => $this->seats_available,
            'remark'                    => $this->remark,
            'price_per_seat'            => $this->price_per_seat,
            'user_id'                   => $this->user_id,
            'group_id'                  => $this->group_id,
            'is_private'                => $this->is_private,
            'is_cancelled'              => $this->is_cancelled,
            'created_at'                => $this->created_at,
            'updated_at'                => $this->updated_at,
        ];
    }
}
