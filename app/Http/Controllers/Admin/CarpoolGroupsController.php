<?php

namespace App\Http\Controllers\Admin;


use App\Models\CarpoolGroup;
use App\Models\CarpoolMessage;
use App\Models\CarpoolRide;
use App\Models\CarpoolStreetCoordinate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Auth;

class CarpoolGroupsController extends Controller
{

    public function overview()
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

        $data['groups'] = CarpoolGroup::where('user_id', Auth::user()->id)->get();
        return view('admin.carpool-groups.overview', $data);
    }


    public function create()
    {
        $data = [];
        return view('admin.carpool-groups.add', $data);
    }

    public function store(Request $request)
    {
        // save new item with array
        Log::debug('Add Group');
        Log::debug(json_decode($request));

        // basic street coordinates
        $streetLocationObj = (new CarpoolStreetCoordinate())->getStreet($request->LocationJson);

        // the group
        $data = [
            'title'                          => $request->get('title'),
            'location_street_coordinates_id' => $streetLocationObj->id,
            'does_need_authentication'       => ($request->get('authentication') == 'on') ? 1 : 0,
            'rides_are_private'              => ($request->get('private') == 'on') ? 1 : 0,
            'token'                          => substr(md5(microtime()),rand(0,26),25),
            'user_id'                        => \Illuminate\Support\Facades\Auth::user()->id
        ];
        $ride = new CarpoolGroup();
        $ride->create($data);

        return \Redirect::route('admin.carpoolGroupsOverview')->with('message', 'Votre groupe a été créé');

    }


    public function edit($groupId)
    {
        $data['group'] = CarpoolGroup::find($groupId);
        return view('admin.carpool-groups.edit', $data);
    }

    public function update($groupId, Request $request)
    {
        // save new item with array
        Log::debug('Add Group');
        Log::debug(json_decode($request));

        $streetLocationObj = (new CarpoolStreetCoordinate())->getStreet($request->LocationJson);
        $data = [
            'title'                          => $request->get('title'),
            'location_street_coordinates_id' => $streetLocationObj->id,
            'does_need_authentication'       => ($request->get('authentication') == 'on') ? 1 : 0,
            'rides_are_private'              => ($request->get('private') == 'on') ? 1 : 0,
        ];
        CarpoolGroup::find($groupId)->update($data);

        return \Redirect::route('admin.carpoolGroupsOverview')->with('message', 'Votre groupe a été actualisé');

    }


}
