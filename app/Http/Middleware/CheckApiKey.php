<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CheckApiKey
{
    public function handle($request, Closure $next)
    {

        $apiKey = $request->header('X-API-KEY');
        $keyDb = ApiKey::where('key', $apiKey)->first();
        Log::debug($request->getMethod().' '.$request->getPathInfo());

        // check on key
        if (!$apiKey || !$keyDb) {
            Log::debug('---> Unauthorized '.$apiKey);
            return response()->json(['message' => 'Unauthorized. Put the correct X-API-KEY in your header. Current used X-API-KEY: '.$apiKey], 401);
        }

        // for post and put, only for your own user
        if($request->getMethod() == 'POST' || $request->getMethod() == 'PUT') {
            if($keyDb->user_id !== $request->user_id && $keyDb->user_id !== $request->passenger_user_id) {
                $shortPathWithoutId = substr($request->getPathInfo(), 0, 22);

                if($request->getPathInfo() == '/open-api/carpool-car' && $request->getMethod() == 'POST' ) {
                    // it's fine, just added. api user should add the car id in the according user
                }

                if($shortPathWithoutId == '/open-api/carpool-car/' && $request->getMethod() == 'PUT' ) {
                    $id = str_replace('/open-api/carpool-car/', '', $request->getPathInfo());
                    $user = User::where('car_id', $id)->first();
                    if($user) {
                        if($user->id !== $keyDb->user_id) {
                            return response()->json(['message' => 'Unauthorized. You can only do a POST, PUT, DELETE for your own user id.  With your X-API-KEY you can only do operations for '.$keyDb->user_id.'.'], 401);
                        }
                    }  else {
                        return response()->json(['message' => 'Unauthorized. User not found with car_id '.$id], 401);
                    }
                }

                // the default
                if($shortPathWithoutId !== '/open-api/carpool-car/') {
                    Log::debug('---> Unauthorized You can only do a POST, PUT, DELETE for your own user id '.$apiKey);
                    return response()->json(['message' => 'Unauthorized. You can only do a POST, PUT, DELETE for your own user id (user_id or passenger_user_id given in array).   With your X-API-KEY you can only do operations for '.$keyDb->user_id.'.'], 401);
                }
            }
        }
        if($request->getMethod() == 'DELETE' && $keyDb->level !== 'admin') {
            return response()->json(['message' => 'Unauthorized. You can not delete entries with your Api Key permission level. You need "admin" level.'], 401);
        }

        return $next($request);
    }
}
