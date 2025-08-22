<?php

namespace App\Listeners;

use App\Events\CarpoolRequestCancelled;
use App\Events\CarpoolReservationRejected;
use App\Models\CarpoolRideReservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class RemoveCarpoolReservationInDatabase
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
    public function handle(CarpoolRequestCancelled $event): void
    {
        $reservation        = $event->getReservation();
        Log::debug('RemoveCarpoolReservationInDatabase - remove reservation id '.$reservation->id);
        CarpoolRideReservation::find($reservation->id)->delete();
    }
}
