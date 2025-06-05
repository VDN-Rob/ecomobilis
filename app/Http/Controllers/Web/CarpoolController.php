<?php

namespace App\Http\Controllers\Web;

use App\Models\CarpoolGroup;
use App\Models\CarpoolStreetCoordinate;
use App\Models\CarpoolRide;
use App\Models\CarpoolLuggage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CarpoolController extends Controller
{

    public function overview()
    {
        $now = Carbon::now();
        $data['rides'] = CarpoolRide::orderBy('id','DESC')->where('is_private', 0)->where('travel_start_datetime', '>', $now)->take(50)->get();
        return view('web.carpool.overview', $data);

    }

    /* results */
    public function matching(Request $request)
    {

        $request->validate([
            'DepJson' => 'required',
            'ArrJson' => 'required',
            'travel_start_datetime' => 'required',
        ]);

        $streetDepObj = (new CarpoolStreetCoordinate())->getStreet($request->DepJson);
        $streetArrObj = (new CarpoolStreetCoordinate())->getStreet($request->ArrJson);

        $data['rides'] = (new CarpoolRide())->getMatchingRides($streetDepObj, $streetArrObj, $request->travel_start_datetime);

        // to refill search field
        $data['searchDepValue'] = $streetDepObj->street.', '.$streetDepObj->city;
        $data['searchArrValue'] = $streetArrObj->street.', '.$streetArrObj->city;
        $data['searchDepJson']  = $request->DepJson;
        $data['searchArrJson']  = $request->ArrJson;
        $data['searchDateFormatted']  =  Carbon::parse($request->travel_start_datetime)->format('Y-m-d h:00');

        return view('web.carpool.overview', $data);

    }

    /* ----- ADD A RIDE ------- */
    public function create(Request $request)
    {
        // for the group params, departure is default from the location and disabled
        if(!empty($request->groupid)) {
            $data['group_id']       = $request->groupid;
            $data['group']            = CarpoolGroup::find($request->groupid);
            $data['searchDepValue'] = $data['group'] ->location->street.', '.$data['group'] ->location->city;
            $data['searchDepJson']  = CarpoolStreetCoordinate::find($data['group'] ->location_street_coordinates_id);
            $data['departureIsFromGroup'] = 1;
        }

        $data['luggages'] = CarpoolLuggage::all();
        return view('web.carpool.create', $data);

    }

    public function store(Request $request)
    {
        $streetDepObj = (new CarpoolStreetCoordinate())->getStreet($request->DepJson);
        $streetArrObj = (new CarpoolStreetCoordinate())->getStreet($request->ArrJson);

        // save new item with array
        Log::debug('Add Ride');
        Log::debug(json_decode($request));

        $data = [
            'from_street_coordinates_id'    => $streetDepObj->id,
            'to_street_coordinates_id'      => $streetArrObj->id,
            'travel_start_datetime'         => $request->travel_start_datetime,
            'luggage_id'                    => $request->luggage_id,
            'seats_available'               => $request->seats_available,
            'price_per_seat'                => $request->price_per_seat,
            'remark'                        => $request->remark,
            'group_id'                      => $request->group_id,
            'user_id'                       => Auth::user()->id
        ];

        if(!empty($request->group_id)) {
            $group = CarpoolGroup::find($request->group_id);
            if($group) {
                if($group->rides_are_private) {
                    $data['is_private'] = 1;
                }
            }
        }

        $ride = new CarpoolRide();
        $ride->create($data);

        if(empty($request->group_id)) {
            return \Redirect::route('admin.carpoolOverview')->with('message', 'Votre trajet est ajouté!');
        } else {
            $group = CarpoolGroup::find($request->group_id);
            return \Redirect::route('web.carpoolGroupsDetail',  $group->token)->with('message', 'Votre trajet est ajouté!');
        }

    }



    /* ----- EDIT A RIDE ------- */
    public function edit($id)
    {

        $data['luggages']   = CarpoolLuggage::all();
        $data['ride']       = CarpoolRide::find($id);

        // for the group params, departure is default from the location and disabled
        if(!empty($data['ride']->group_id)) {
            $data['group']            = CarpoolGroup::find($data['ride']->group_id);

            if($data['group']->location_street_coordinates_id == $data['ride']->from_street_coordinates_id) {
                $data['searchDepValue'] = $data['group'] ->location->street.', '.$data['group'] ->location->city;
                $data['searchDepJson']  = CarpoolStreetCoordinate::find($data['group'] ->location_street_coordinates_id);
                $data['departureIsFromGroup'] = 1;
            }
            if($data['group']->location_street_coordinates_id == $data['ride']->to_street_coordinates_id) {
                $data['searchArrValue'] = $data['group'] ->location->street.', '.$data['group'] ->location->city;
                $data['searchArrJson']  = CarpoolStreetCoordinate::find($data['group'] ->location_street_coordinates_id);
                $data['arrivalIsFromGroup'] = 1;
            }

        }

        return view('web.carpool.edit', $data);
    }

    public function update($id, Request $request)
    {
        $streetDepObj = (new CarpoolStreetCoordinate())->getStreet($request->DepJson);
        $streetArrObj = (new CarpoolStreetCoordinate())->getStreet($request->ArrJson);

        // save new item with array
        Log::debug('Edit Ride');
        Log::debug(json_decode($request));

        $data = [
            'from_street_coordinates_id'    => $streetDepObj->id,
            'to_street_coordinates_id'      => $streetArrObj->id,
            'travel_start_datetime'         => $request->travel_start_datetime,
            'luggage_id'                    => $request->luggage_id,
            'seats_available'               => $request->seats_available,
            'price_per_seat'                => $request->price_per_seat,
            'remark'                        => $request->remark
        ];
        $ride = CarpoolRide::find($id);
        $ride->update($data);

        if(empty($ride->group_id)) {
            return \Redirect::route('web.carpoolOverview')->with('message', 'Votre trajet est edité!');
        } else {
            $group = CarpoolGroup::find($ride->group_id);
            return \Redirect::route('web.carpoolGroupsDetail',  $group->token)->with('message', 'Votre trajet est edité!');
        }

    }



}
