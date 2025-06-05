<?php

namespace App\Listeners;

use App\Events\CarpoolRequested;
use App\Models\CarpoolMessage;
use App\Mail\AdminMemberAdded;
use App\Mail\NotifyCarpoolRequested;
use App\Models\CarpoolRideReservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCarpoolRequestNotification
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

        //  send email
        $toEmail = $ride->user->email;
    //    $toEmail = 'dave@waanz.in';

        Log::debug('CarpoolRequested Listener -> MAIL NotifyCarpoolRequested to '.$toEmail);
        Mail::to($toEmail)->send(new NotifyCarpoolRequested($ride, $user, $amount));

        // store automatic message in messages
        $data = [
            'message'                       => 'auto-message',
            'user_id'                       => $user->id,
            'conversation_partner_user_id'  => $ride->user->id,
            'car_ride_id'                   => $ride->id,
            'is_request_for_reservation'    => 1,
            'is_sent'                       => 1
        ];
        $msgObj = new CarpoolMessage;
        $msgObj->create($data);

    }
}
