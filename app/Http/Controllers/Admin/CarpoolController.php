<?php

namespace App\Http\Controllers\Admin;

use App\Events\CarpoolRequestCancelled;
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

    // filter = [future|past]
    public function overview($filter = 'future')
    {
        if($filter == 'past') {
            // oldies
            $tomorrow = Carbon::tomorrow();
            $data['rides'] = CarpoolRide::where('travel_start_datetime', '<', $tomorrow)
                ->where('user_id', Auth::user()->id)
                ->where('is_cancelled', 0)
                ->orderBy('travel_start_datetime', 'ASC')
                ->paginate(25);
        } else {
            // future
            $yesterday = Carbon::yesterday();
            $data['rides'] = CarpoolRide::where('travel_start_datetime', '>', $yesterday)
                ->where('user_id', Auth::user()->id)
                ->where('is_cancelled', 0)
                ->orderBy('travel_start_datetime', 'ASC')
                ->paginate(25);
        }

        return view('admin.carpool-rides', $data);

    }

    public function carpoolOverviewAsPassenger()
    {
        $yesterday = Carbon::yesterday();
        $userId = Auth::user()->id;
        $data['rides'] = CarpoolRide::where('travel_start_datetime', '>', $yesterday)
                                ->whereHas('reservations', function ($query) use ($userId) {
                                    $query->where('passenger_user_id', $userId);
                                })->orderBy('travel_start_datetime')->get();
        return view('admin.carpool-rides-as-passenger', $data);

    }


    /* ----------------------- RESERVATION etc ------------------------- */
    public function carpoolReservation($rideId)
    {
        $data['ride'] = CarpoolRide::find($rideId);
        return view('admin.carpool-reservation', $data);
    }

    public function carpoolReservationStore($rideId, Request $request)
    {
        $userId = Auth::user()->id;
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
        return \Redirect::route('admin.carpoolMessagesThread', [$rideReservation->ride_id, $rideReservation->passenger_user_id])->with('message', 'Votre réponse sera envoyée!');

    }

    /* function after modal launch where request from passager is cancelled / removed */
    public function carpoolReservationCancelStore($rideReservationId, Request $request)
    {
        $userId             = Auth::user()->id;
        $rideReservation    = (new CarpoolRideReservation())::find($rideReservationId);
        $ride               = (new CarpoolRide())::find($rideReservation->ride_id);

        Log::debug('carpoolReservationCancelStore - action event | rideReservationId:'.$rideReservationId. ' from Auth User id (passenger) '.$userId);
        event(new CarpoolRequestCancelled($rideReservationId, $userId));

        return \Redirect::route('admin.carpoolMessagesThread', [$ride->id, $ride->user_id])->with('message', 'Votre annulation a été transmise!');

    }


}
