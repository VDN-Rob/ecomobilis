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

        $reportArray = $api->getClusterTraffic($dateFrom, $dateTo, '00:00:00', '23:59:59');
dd($reportArray);
        return view('web.traffic.overview', $data);

    }


}
