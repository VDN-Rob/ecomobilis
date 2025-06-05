<?php

namespace App\Http\Middleware;

use App\Models\CarpoolGroup;
use Closure;
use App\Models\ApiKey;
use Illuminate\Support\Facades\Auth;

class CheckGroupNeedsAuth
{
    public function handle($request, Closure $next)
    {
        // auth needed when defined for that group
        $token = $request->segment(2);
        $data['group'] = CarpoolGroup::where('token', $token)->first();
        if($data['group']->does_need_authentication == 1 && !Auth::check()) {
            return \Redirect::route('login')->with('message', 'Vous devez être connecté pour voir ce groupe');
        }

        return $next($request);

    }
}
