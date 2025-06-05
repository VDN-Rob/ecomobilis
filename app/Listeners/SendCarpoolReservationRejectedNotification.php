<?php

namespace App\Listeners;

use App\Events\CarpoolReservationRejected;
use App\Mail\NotifyCarpoolRejected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCarpoolReservationRejectedNotification
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
        $ride        = $event->getRide();
        $user        = $event->getUser();
        $passenger   = $event->getPassenger();

        //  send email
        $toEmail      = $passenger->email;
        Log::debug('CarpoolReservationRejected Listener -> MAIL NotifyCarpoolRejected to '.$toEmail);
        Mail::to($toEmail)->send(new NotifyCarpoolRejected($ride, $user, $passenger));

    }
}
