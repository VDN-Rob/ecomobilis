<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;
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
            if($keyDb->user_id !== $request->user_id) {
                return response()->json(['message' => 'Unauthorized. You can only do a POST, PUT, DELETE for your own user id. With your X-API-KEY you can only do operations for '.$keyDb->user_id.'.'], 401);
            }
        }
        if($request->getMethod() == 'DELETE' && $keyDb->level !== 'admin') {
            return response()->json(['message' => 'Unauthorized. You can not delete entries with your Api Key permission level. You need "admin" level.'], 401);
        }

        return $next($request);
    }
}
