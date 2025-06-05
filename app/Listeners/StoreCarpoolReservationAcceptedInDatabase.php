<?php

namespace App\Listeners;

use App\Events\CarpoolRequested;
use App\Events\CarpoolReservationAccepted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\CarpoolRideReservation;

class StoreCarpoolReservationAcceptedInDatabase
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
    public function handle(CarpoolReservationAccepted $event): void
    {
        $reservation        = $event->getReservation();
        CarpoolRideReservation::find($reservation->id)->update(['is_accepted' => 1, 'is_rejected' => 0]);
    }
}
