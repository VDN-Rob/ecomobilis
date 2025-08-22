<?php

namespace App\Listeners;

use App\Events\CarpoolRideCancelled;
use App\Mail\NotifyCarpoolCancelled;
use App\Models\CarpoolMessage;
use App\Mail\AdminMemberAdded;
use App\Mail\NotifyCarpoolRequested;
use App\Models\CarpoolRideReservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCarpoolRideCancelledNotification
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
    public function handle(CarpoolRideCancelled $event): void
    {

        $ride       = $event->getRide();
        $user       = $event->getUser();
        $passengers  = $event->getPassengers();


        foreach($passengers as $passenger) {
            //  send email
            $toEmail = $passenger->email;
            $toEmail = 'dave@waanz.in';

            Log::debug('SendCarpoolRideCancelledNotification Listener -> MAIL NotifyCarpoolCancelled to '.$toEmail);
            Mail::to($toEmail)->send(new NotifyCarpoolCancelled($ride, $user, $passenger));

        }


        // store automatic message in messages
       /* $data = [
            'message'                       => 'auto-message',
            'user_id'                       => $user->id,
            'conversation_partner_user_id'  => $ride->user->id,
            'car_ride_id'                   => $ride->id,
            'is_request_for_reservation'    => 1,
            'is_sent'                       => 1
        ];
        $msgObj = new CarpoolMessage;
        $msgObj->create($data); */

    }
}
