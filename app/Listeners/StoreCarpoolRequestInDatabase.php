<?php

namespace App\Listeners;

use App\Events\CarpoolRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\CarpoolRideReservation;

class StoreCarpoolRequestInDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CarpoolRequested $event): void
    {
        $ride       = $event->getRide();
        $user       = $event->getUser();
        $amount     = $event->getAmount();

        // the ride
        $data['ride_id']            = $ride->id;
        $data['passenger_user_id']  = $user->id;
        $data['amount']             = $amount;
        $data['is_accepted']        = 0;
        $data['is_rejected']        = 0;
        $rideObj = new CarpoolRideReservation;
        $rideObj->create($data);
    }
}
