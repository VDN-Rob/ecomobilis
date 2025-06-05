<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UserController extends Controller
{

    public function profileShow($userId)
    {
        $data['user'] = User::find($userId);
        return view('web.user.profile', $data);
    }


}
