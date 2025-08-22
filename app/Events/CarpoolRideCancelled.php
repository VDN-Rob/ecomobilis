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

class CarpoolRideCancelled
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $rideId;
    /**
     * Create a new event instance.
     */
    public function __construct($rideId)
    {
       $this->rideId = $rideId;
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
        $ride = CarpoolRide::find($this->rideId);
        return $ride;
    }

    public function getUser()
    {
        $ride = CarpoolRide::find($this->rideId);
        return $ride->user;
    }


    public function getPassengers()
    {
        $passengers = CarpoolRideReservation::where('ride_id', $this->rideId)->where('is_rejected', 0)->get();
        return $passengers;
    }



}
