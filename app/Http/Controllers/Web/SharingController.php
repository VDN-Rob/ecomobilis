<?php

namespace App\Http\Controllers\Web;

use App\Models\CarpoolGroup;
use App\Models\CarpoolStreetCoordinate;
use App\Models\CarpoolRide;
use App\Models\CarpoolLuggage;
use App\Models\SharingDecisionNode;
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

        // questionairre
        // Start at root (assume id=1)
        $root = SharingDecisionNode::find(1);
        $data['firstQuestion'] = $root;

        return view('web.sharing.overview', $data);
    }

    public function show($id)
    {
        $data['org'] = SharingOrg::find($id);
        return view('web.sharing.show', $data);
    }


}
