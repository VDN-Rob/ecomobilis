<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\CarpoolRide;
use App\Models\User;

class CarpoolRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $rideId;
    private $userId;
    private $amount;

    public function __construct($rideId, $userId, $amount)
    {
        $this->rideId = $rideId;
        $this->userId = $userId;
        $this->amount = $amount;
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
        $user = User::find($this->userId);
        return $user;
    }

    public function getAmount()
    {
        return $this->amount ;
    }

}
