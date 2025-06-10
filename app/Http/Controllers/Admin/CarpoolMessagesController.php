<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\CarpoolMessageAdded;
use App\Models\CarpoolMessage;
use App\Models\CarpoolRideReservation;
use App\Models\CarpoolStreetCoordinate;
use App\Models\CarpoolRide;
use App\Models\CarpoolLuggage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Auth;
use Illuminate\Support\Facades\Redirect;

class CarpoolMessagesController extends Controller
{

    public function overview($carRideId, $conversationPartnerId)
    {

        // core  for subnav etc
        if($carRideId && $conversationPartnerId) {

            $currentConversation = (new CarpoolMessage())->getConversation($conversationPartnerId, $carRideId);
            if(isset($currentConversation[0])) {
                $data['currentConversation']    = $currentConversation[0];
                $data['currentCarRideId']       = $carRideId;
                $data['currentPartnerUserId']   = $conversationPartnerId;
            } else {
                // new conversation to be started
                $data['currentConversation']    = false;
                $data['currentCarRideId']       = $carRideId;
                $data['currentPartnerUserId']   = $conversationPartnerId;
            }
        } else {
            // when carRideId and conversationPartner are not given, reset to last conversation
            $data['currentConversation'] = (new CarpoolMessage())->getLastConversation(Auth::user()->id); // current = last one automatically
            if(isset($data['currentConversation']->car_ride_id) && isset($data['currentConversation']->conversation_partner_user_id)) {
                $senderId = $data['currentConversation']->conversation_partner_user_id;
                if($data['currentConversation']->conversation_partner_user_id == Auth::user()->id) {
                    $senderId =  $data['currentConversation']->user_id;
                }
                $url = url('/').'/admin/carpool-messages/ride/'.$data['currentConversation']->car_ride_id .'/sender/'.$senderId;
                return Redirect::to($url);
            } else {
                $data['currentCarRideId']       = $carRideId;
                $data['currentPartnerUserId']   = $conversationPartnerId;
                $data['ride'] = CarpoolRide::find($carRideId);
            }
        }

        $data['lastMessages'] = CarpoolMessage::all();

        return view('admin.carpool-messages', $data);
    }




}
