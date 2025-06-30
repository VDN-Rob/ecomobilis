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


                // a) CHECK FOR CARPOOL-CAR ENDPOINTS
                $shortPathCarpoolCarWithoutId = substr($request->getPathInfo(), 0, 23);

                if($request->getPathInfo() == '/open-api/carpool-cars' && $request->getMethod() == 'POST' ) {
                    // it's fine, just added. api user should add the car id in the according user
                    return $next($request);
                }

                if($shortPathCarpoolCarWithoutId == '/open-api/carpool-cars/' && $request->getMethod() == 'PUT' ) {
                    $id = str_replace('/open-api/carpool-cars/', '', $request->getPathInfo());
                    $user = User::where('car_id', $id)->first();
                    if($user) {
                        if((string) $user->id !== (string)  $keyDb->user_id) {
                            return response()->json(['message' => 'Unauthorized. You can only do a POST, PUT, DELETE for your own user id.  With your X-API-KEY you can only do operations for '.$keyDb->user_id.'. #1'], 401);
                        } else {
                            return $next($request);
                        }
                    }  else {
                        return response()->json(['message' => 'Unauthorized. No user  with car_id '.$id.'. Please create it first. #2'], 401);
                    }
                }

                // b) CHECK FOR USER ENDPOINTS
                $shortPathUserWithoutId = substr($request->getPathInfo(), 0, 16);

                if($request->getPathInfo() == '/open-api/users' && $request->getMethod() == 'POST' ) {
                    // it's fine, just add it
                    return $next($request);
                }

                if($shortPathUserWithoutId == '/open-api/users/' && $request->getMethod() == 'PUT' ) {
                    $id = str_replace('/open-api/users/', '', $request->getPathInfo());

                    if((string) $id == (string) $keyDb->user_id) {
                        return $next($request);
                    } else {
                        return response()->json(['message' => 'Unauthorized. You can only do a POST, PUT, DELETE for your own user id.  With your X-API-KEY you can only do operations for '.$keyDb->user_id.'. #3'], 401);
                    }
                }

                // c) the default for post/put without user_id or passenger_id
                Log::debug('---> Unauthorized You can only do a POST, PUT, DELETE for your own user id '.$apiKey);
                return response()->json(['message' => 'Unauthorized. You can only do a POST, PUT, DELETE for your own user id (user_id or passenger_user_id given in array). With your X-API-KEY you can only do operations for '.$keyDb->user_id.'. #D'], 401);

            }
        }
        if($request->getMethod() == 'DELETE' && $keyDb->level !== 'admin') {
            return response()->json(['message' => 'Unauthorized. You can not delete entries with your Api Key permission level. You need "admin" level.'], 401);
        }

        return $next($request);
    }
}
