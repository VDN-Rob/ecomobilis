<?php

namespace App\Listeners;

use App\Events\CarpoolRequestCancelled;
use App\Mail\NotifyCarpoolRequestCancelled;
use App\Models\CarpoolMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCarpoolReservationCancelledNotification
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

        $ride = $event->getRide();
        $user = $event->getUser();

        //  send email
        $toEmail = $ride->user->email;
        //    $toEmail = 'dave@waanz.in';

        Log::debug('CarpoolRequestCancelled Listener -> MAIL NotifyCarpoolRequested to ' . $toEmail);
        Mail::to($toEmail)->send(new NotifyCarpoolRequestCancelled($ride, $user));

        // store automatic message in messages
        $data = [
            'message' => 'auto-message',
            'user_id' => $user->id,
            'conversation_partner_user_id' => $ride->user->id,
            'car_ride_id' => $ride->id,
            'is_request_for_reservation' => 0,
            'is_request_cancelled' => 1,
            'is_sent' => 1
        ];
        Log::debug('CarpoolRequestCancelled auto-message added to Message');
        Log::debug(json_encode($data));

        $msgObj = new CarpoolMessage();
        $msgObj->create($data);

    }
}
