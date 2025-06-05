<?php

namespace App\Events;

use App\Models\CarpoolRide;
use App\Models\CarpoolRideReservation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CarpoolReservationAccepted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $rideReservationId;
    /**
     * Create a new event instance.
     */
    public function __construct($rideReservationId)
    {
       $this->rideReservationId = $rideReservationId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }

    public function getRide()
    {
        $reservation = CarpoolRideReservation::find($this->rideReservationId);
        $ride = CarpoolRide::find($reservation->ride_id);
        return $ride;
    }

    public function getUser()
    {
        $reservation = CarpoolRideReservation::find($this->rideReservationId);
        return $reservation->ride->user;
    }

    public function getReservation()
    {
        $reservation = CarpoolRideReservation::find($this->rideReservationId);
        return $reservation;
    }

    public function getPassenger()
    {
        $reservation = CarpoolRideReservation::find($this->rideReservationId);
        return $reservation->passenger;
    }



}
