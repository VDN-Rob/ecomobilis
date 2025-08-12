<?php

namespace App\Http\Controllers\Web;

use App\Models\CarpoolGroup;
use App\Models\CarpoolStreetCoordinate;
use App\Models\CarpoolRide;
use App\Models\CarpoolLuggage;
use App\Models\SharingOrg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SharingController extends Controller
{

    public function index()
    {
        $data = []; // orgs via livewire
        return view('web.sharing.overview', $data);
    }



}
