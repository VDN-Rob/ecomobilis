<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarpoolStreetCoordinate;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class StreetController extends Controller
{

    /**
     * @group Street coordinates
     *
     * Retrieve a list of locations based on street/city
     *
     * @response 200 {
     *   "id": 1,
     *   "name": "John Doe",
     *   "email": "john@example.com"
     * }
     */

    public function autocomplete($searchString)
    {
        // $searchString = preg_replace('/[[:digit:]]/','', $searchString); // remove numbers eg house street 1
        $token = env('LOCATIONIQ_TOKEN');
        $endpointUrl = 'https://us1.locationiq.com/v1/autocomplete?key='.$token.'&q='.$searchString.'&accept-language=fr&countrycodes=BE';
        Log::debug('Autocomplete - '.$endpointUrl);

        try {

            $client = new GuzzleHttpClient();
            $apiRequest = $client->request('GET', $endpointUrl, [
                'headers' =>[
                    'Content-Type' =>  'application/json',
                ],
                'debug'  => false
            ]);
            $content = json_decode($apiRequest->getBody()->getContents());
            if ($apiRequest->getStatusCode() == 200 || $apiRequest->getStatusCode() == 201) {
                Log::debug('-> Autocomplete '. $apiRequest->getStatusCode());
                return response()->json($content);
            } else {
                Log::debug('autocomplete error: '.$apiRequest->getStatusCode());
                return true;
            }

        } catch (RequestException $re) {

            Log::debug('autocomplete error: '.$re);
            return $re;

        }


    }








}
