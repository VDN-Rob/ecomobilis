<?php

namespace App\Http\Controllers\Web;


use App\Models\CarpoolGroup;
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

    public function detail($token)
    {
        $data['group'] = CarpoolGroup::where('token', $token)->first();

        // claen array for the markers
        $data['markers'] = [];
        foreach($data['group']->rides as $ride) {
            $arr = [];
            // departure same --> add arrival
            if($ride->from_street_coordinates_id == $data['group']->location_street_coordinates_id) {
                $arr['lat'] = $ride->arrival->lat;
                $arr['lng'] = $ride->arrival->lng;
                $arr['type'] = 'departs-from';
            }
            // arrival same --> add dep
            if($ride->to_street_coordinates_id == $data['group']->location_street_coordinates_id) {
                $arr['lat'] = $ride->departure->lat;
                $arr['lng'] = $ride->departure->lng;
                $arr['type'] = 'arrives-to';
            }
            $data['markers'][] = $arr;
        }

        return view('web.carpool-group.detail', $data);

    }



}
