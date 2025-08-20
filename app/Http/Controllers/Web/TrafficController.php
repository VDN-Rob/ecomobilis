<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Helpers\BusinessApiClusterTraffic;

class TrafficController extends Controller
{

    public function index()
    {
        $data = [];

        // api call
        $api = new BusinessApiClusterTraffic();
        $dateFrom = Carbon::yesterday()->toDateString();
        $dateTo   = Carbon::today()->toDateString(); // 2025-08-12

        // last hour
        $reportArray = $api->getClusterTraffic($dateFrom, $dateTo, '00:00:00', '23:59:59');
        $data['lastHour']    = $api->getLastHourWithData($reportArray);

         // yesterday same hour
        $prevHour = date("H:i:s", strtotime($data['lastHour']->time_local . " -1 hour"));
        $reportArrayYesterday = $api->getClusterTraffic($dateFrom, $dateFrom, $prevHour, $data['lastHour']->time_local);
        if(isset($reportArrayYesterday[0])) {
            $data['yesterdayHour'] = $reportArrayYesterday[0];
        }

        return view('web.traffic.overview', $data);

    }


}
