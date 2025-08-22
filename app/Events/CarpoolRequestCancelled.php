<?php

namespace App\Events;

use App\Models\CarpoolRideReservation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\CarpoolRide;
use App\Models\User;

class CarpoolRequestCancelled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $rideReservationId;
    private $userId;

    public function __construct($rideReservationId, $userId)
    {
        $this->rideReservationId = $rideReservationId;
        $this->userId            = $userId;
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
        $reservation    = CarpoolRideReservation::find($this->rideReservationId);
        $ride           = CarpoolRide::find($reservation->ride_id);
        return $ride;
    }

    public function getReservation()
    {
        $reservation = CarpoolRideReservation::find($this->rideReservationId);
        return $reservation;
    }


    public function getUser()
    {
        $user = User::find($this->userId);
        return $user;
    }


}
