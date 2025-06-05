<?php

namespace App\Jobs;

use App\Mail\NotifyCarpoolRequested;
use App\Mail\SendCarpoolMessages;
use App\Models\CarpoolRide;
use App\Models\User;
use App\Models\CarpoolMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use \Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class CarpoolMessageAdded implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $rideId;
    private $userId;
    private $conversationPartnerId;

    public function __construct($rideId, $userId, $conversationPartnerId)
    {
        Log::debug('JOB CarpoolMessageAdded -- From User # '. $userId .' -> To '.$conversationPartnerId);
        $this->rideId = $rideId;
        $this->userId = $userId;
        $this->conversationPartnerId = $conversationPartnerId;
    }


    public function handle() {

        $ride = $this->getRide();
        $user = $this->getUser();
        $conversationPartner = $this->getConversationPartner();

        $messages = CarpoolMessage::where('user_id', $user->id)
            ->where('conversation_partner_user_id', $conversationPartner->id)
            ->where('car_ride_id', $ride->id)
            ->where('is_read', 0)
            ->where('is_sent', 0)
            ->get();

        $bodyEmail = '';
        if($messages->count() > 0) {
            foreach($messages as $mes) {
                if($mes->message !== 'auto-message') {
                    $bodyEmail .= $mes->message.'<br><br>';
                }
            }
        }

        if ($bodyEmail !== '') {
            $toEmail = $conversationPartner->email;
            Mail::to($toEmail)->send(new SendCarpoolMessages($ride, $user, $conversationPartner, $bodyEmail));
        } else {
            Log::debug('JOB CarpoolMessageAdded -- no messages to sent');
        }

        // put them to sent
        CarpoolMessage::where('user_id', $user->id)
            ->where('conversation_partner_user_id', $conversationPartner->id)->where('car_ride_id', $ride->id)->where('is_sent', 0)->update(['is_sent' => 1]);


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

    public function getConversationPartner()
    {
        $user = User::find($this->conversationPartnerId);
        return $user;
    }

}
