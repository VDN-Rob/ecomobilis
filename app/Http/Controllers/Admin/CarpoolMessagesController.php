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

    /* this function is called in the navigation and jumps to the last conversation or shows a "no messages yet" notification */
    public function lastMessage()
    {
        $data['currentConversation'] = (new CarpoolMessage())->getLastConversation(Auth::user()->id); // current = last one automatically
        if(isset($data['currentConversation']->car_ride_id) && isset($data['currentConversation']->conversation_partner_user_id)) {
            $senderId = $data['currentConversation']->conversation_partner_user_id;
            if($data['currentConversation']->conversation_partner_user_id == Auth::user()->id) {
                $senderId =  $data['currentConversation']->user_id;
            }
            $url = url('/').'/admin/carpool-messages/ride/'.$data['currentConversation']->car_ride_id .'/sender/'.$senderId;
            return Redirect::to($url);
        } else {
            // no conversations yet
            $data['currentConversation']    = false;
            $data['currentCarRideId']       = false;
            $data['currentPartnerUserId']   = false;
            return view('admin.carpool-messages', $data);
        }

    }

    /* the messages from one thread (unique ride / conversation partner) */
    public function thread($carRideId, $conversationPartnerId)
    {
        // coming from a non logged-in url?
        $cpRide = CarpoolRide::find($carRideId);
        if($conversationPartnerId == 0) {
            $conversationPartnerId = $cpRide->user_id;
            return \Redirect::route('admin.carpoolMessagesThread', ['rideId' => $carRideId, 'conversationPartnerId' => $conversationPartnerId]);
        }
        // check you can not send a message to your own car ride
        /* if($cpRide->user_id == Auth::user()->id) {
            Log::debug('You can not send a message for your own carpool ride. #E1 Ride from '.$cpRide->user_id);
            dd('You can not send a message for your own carpool ride.');
        } */
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
        }
        return view('admin.carpool-messages', $data);
    }



}
