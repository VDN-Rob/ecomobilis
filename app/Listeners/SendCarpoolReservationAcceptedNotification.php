<?php

namespace App\Listeners;

use App\Events\CarpoolReservationAccepted;
use App\Mail\NotifyCarpoolAccepted;
use App\Mail\NotifyCarpoolRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCarpoolReservationAcceptedNotification
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
        $ride        = $event->getRide();
        $user        = $event->getUser();
        $passenger   = $event->getPassenger();

        //  send email
        $toEmail      = $passenger->email;
        Log::debug('CarpoolReservationAccepted Listener -> MAIL NotifyCarpoolAccepted to '.$toEmail);
        Mail::to($toEmail)->send(new NotifyCarpoolAccepted($ride, $user, $passenger));

    }
}
