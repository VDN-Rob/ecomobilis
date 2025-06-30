<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarpoolRideReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'ride_id'           => $this->ride_id,
            'passenger_user_id' => $this->passenger_user_id,
            'amount'            => $this->amount,
            'is_accepted'       => $this->is_accepted,
            'is_rejected'       => $this->is_rejected
        ];
    }
}
