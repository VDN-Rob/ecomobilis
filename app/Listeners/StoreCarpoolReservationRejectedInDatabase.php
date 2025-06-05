<?php

namespace App\Listeners;

use App\Events\CarpoolReservationRejected;
use App\Models\CarpoolRideReservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreCarpoolReservationRejectedInDatabase
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
    public function handle(CarpoolReservationRejected $event): void
    {
        $reservation        = $event->getReservation();
        CarpoolRideReservation::find($reservation->id)->update(['is_accepted' => 0, 'is_rejected' => 1]);
    }
}
