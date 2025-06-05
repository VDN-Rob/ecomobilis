<?php

namespace App\Livewire;

use App\Jobs\CarpoolMessageAdded;
use App\Models\CarpoolMessage;
use App\Models\CarpoolRide;
use App\Models\CarpoolRideReservation;
use App\Models\Network;
use Illuminate\Http\Request;
use Livewire\Component;
use Auth;

class ShowMessages extends Component
{
    public $currentPartnerUserId;
    public $currentCarRideId;
    public $ride;
    public $conversations;
    public $rideReservationSent;
    public $conversationsListArr;
    public $newMessage;

    public function mount($currentPartnerUserId, $currentCarRideId)
    {
        // params
        $this->currentPartnerUserId = $currentPartnerUserId;
        $this->currentCarRideId     = $currentCarRideId;

        // load the data
        $this->fetchTheData($currentPartnerUserId, $currentCarRideId);
    }

    public function render()
    {

        return view('livewire.show-messages');
    }

    /* ----- ADD A MESSAGE ------- */
    public function save()
    {
        $data = [
            'message'                       => $this->newMessage,
            'user_id'                       => Auth::user()->id,
            'conversation_partner_user_id'  => $this->currentPartnerUserId,
            'car_ride_id'                   => $this->currentCarRideId
        ];
        $msg = new CarpoolMessage();
        $msg->create($data);

        // clear form
        $this->newMessage = '';

        // just load everything again
        $this->fetchTheData($this->currentPartnerUserId, $this->currentCarRideId);

        // send email as mail
        $job = (new CarpoolMessageAdded($this->currentCarRideId, Auth::user()->id, $this->currentPartnerUserId));
        dispatch($job)->delay(now()->addMinutes(5));

    }


    public function fetchTheData($currentPartnerUserId, $currentCarRideId) {

        // for header etc
        $userId = Auth::user()->id;

        $this->ride = CarpoolRide::find($currentCarRideId);

        // current conversation = messages thread
        $this->conversations = (new CarpoolMessage())->getConversation($currentPartnerUserId, $currentCarRideId); // current = last one automatically

        // is there a reservation?
        $this->rideReservationSent = (new CarpoolRideReservation())::where('ride_id', $currentCarRideId)
                                                    ->whereIn('passenger_user_id', [$userId, $currentPartnerUserId])
                                                    ->first();


        // sidebar
        $this->conversationsListArr = (new CarpoolMessage())->getConversationsWithRides(Auth::user()->id);

        // set old ones as read
        (new CarpoolMessage())->setConversationsAsRead($currentPartnerUserId, $currentCarRideId);

        // scroll
        $this->jsScrollToBottom();

    }

    /* javascript call */
    public function jsScrollToBottom()
    {
        $this->dispatch('LivewireScrollToBottom');
    }

}
