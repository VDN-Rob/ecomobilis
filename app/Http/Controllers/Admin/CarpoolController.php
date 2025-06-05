<?php

namespace App\Http\Controllers\Admin;

use App\Events\CarpoolReservationAccepted;
use App\Events\CarpoolReservationRejected;
use App\Models\CarpoolMessage;
use App\Models\CarpoolRideReservation;
use App\Models\CarpoolStreetCoordinate;
use App\Models\CarpoolRide;
use App\Models\CarpoolLuggage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Auth;
use App\Events\CarpoolRequested;

class CarpoolController extends Controller
{

    public function overview()
    {
        // core  for subnav etc
        $data['currentConversation'] = (new CarpoolMessage())->getLastConversation(Auth::user()->id); // current = last one automatically
        if($data['currentConversation']) {
            $data['currentCarRideId']       = $data['currentConversation']->car_ride_id;
            if($data['currentConversation']->conversation_partner_user_id == Auth::user()->id) {
                $data['currentPartnerUserId']   = $data['currentConversation']->user_id;
            } else {
                $data['currentPartnerUserId']   = $data['currentConversation']->conversation_partner_user_id;
            }
        } else {
            $data['currentCarRideId']       = 0;
            $data['currentPartnerUserId']   = 0;
        }

        $yesterday = Carbon::yesterday();
        $data['rides'] = CarpoolRide::where('travel_start_datetime', '>', $yesterday)
                                ->where('user_id', Auth::user()->id)
                                ->orderBy('travel_start_datetime')->get();
        return view('admin.carpool-rides', $data);

    }

    public function carpoolOverviewAsPassenger()
    {
        // core  for subnav etc
        $data['currentConversation'] = (new CarpoolMessage())->getLastConversation(Auth::user()->id); // current = last one automatically
        if($data['currentConversation']) {
            $data['currentCarRideId']       = $data['currentConversation']->car_ride_id;
            $data['currentPartnerUserId']   = $data['currentConversation']->conversation_partner_user_id;
        } else {
            $data['currentCarRideId']       = 0;
            $data['currentPartnerUserId']   = 0;
        }

        $yesterday = Carbon::yesterday();
        $userId = Auth::user()->id;
        $data['rides'] = CarpoolRide::where('travel_start_datetime', '>', $yesterday)
                                ->whereHas('reservations', function ($query) use ($userId) {
                                    $query->where('passenger_user_id', $userId);
                                })->orderBy('travel_start_datetime')->get();
        return view('admin.carpool-rides-as-passenger', $data);

    }


    /* ----------------------- RESERVATION etc ------------------------- */
    public function carpoolReservation($rideId, $userId)
    {
        // core  for subnav etc
        $data['currentConversation'] = (new CarpoolMessage())->getLastConversation(Auth::user()->id); // current = last one automatically
        if($data['currentConversation']) {
            $data['currentCarRideId']       = $data['currentConversation']->car_ride_id;
            $data['currentPartnerUserId']   = $data['currentConversation']->conversation_partner_user_id;
        } else {
            $data['currentCarRideId']       = 0;
            $data['currentPartnerUserId']   = 0;
        }

        $data['ride'] = CarpoolRide::find($rideId);

        return view('admin.carpool-reservation', $data);

    }

    public function carpoolReservationStore($rideId, $userId, Request $request)
    {
        // core  for subnav etc
        $data['currentConversation'] = (new CarpoolMessage())->getLastConversation(Auth::user()->id); // current = last one automatically
        if($data['currentConversation']) {
            $data['currentCarRideId']       = $data['currentConversation']->car_ride_id;
            $data['currentPartnerUserId']   = $data['currentConversation']->conversation_partner_user_id;
        } else {
            $data['currentCarRideId']       = 0;
            $data['currentPartnerUserId']   = 0;
        }

        event(new CarpoolRequested($rideId, $userId, $request->amount));
        return \Redirect::route('web.carpoolOverview')->with('message', 'Votre demande est en cours de traitement.');

    }

    /* function after the user confirmed or rejected the request */
    public function carpoolReservationConfirmRejectStore($rideReservationId, Request $request)
    {
        Log::debug('carpoolReservationConfirmRejectStore - action:'.$request->submit);
        if ($request->submit == 'Refuser') {
            event(new CarpoolReservationRejected($rideReservationId));
        } else if ($request->submit == 'Confirmer') {
             event(new CarpoolReservationAccepted($rideReservationId));
        } else {
            dd('carpoolReservationConfirmRejectStore - action: '.$request->submit. ' went wrong');
        }

        $rideReservation = (new CarpoolRideReservation())::find($rideReservationId);
        return \Redirect::route('admin.carpoolMessagesSender', [$rideReservation->ride_id, $rideReservation->passenger_user_id])->with('message', 'Votre réponse sera envoyée!');

    }


}
