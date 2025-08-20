<?php

namespace App\Helpers;


use Carbon\Carbon;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use App\User;
use Config;


class BusinessApiClusterTraffic {


    public function getClusterTraffic($dateFrom = '', $dateTo = '',$dateFromHour = '00:00:00',  $dateToHour = '23:59:59') {

        $clusterId = 366; // SEM
        $startDate = $dateFrom.' '.$dateFromHour;
        $endDate   = $dateTo.' '.$dateToHour;

        // find timezone
        $timezone = 'Europe/Brussels';

        // api call
        $startDateUtc   = $this->convertTimeZoneToUTC($startDate, $timezone);
        $endDateUtc     = $this->convertTimeZoneToUTC($endDate, $timezone);

        if ($clusterId) {
            $jsonArray = ['id' => $clusterId, "format" => "per-hour", "time_start" => $startDateUtc, "time_end" => $endDateUtc];
        } else {
            return false;
        }


        $endpointUrl = env('BUSINESS_API_BASE_URL').'/private/segment-clusters/traffic';

        Log::debug('businnesApi - getClusterTraffic Url: '.$endpointUrl);
        Log::debug('businnesApi - Body: '. json_encode($jsonArray));

        try {

            $client = new GuzzleHttpClient();
            $apiRequest = $client->request('POST', $endpointUrl, [
                'headers'         => [
                    'Content-Type'  =>  'application/json',
                    'X-Api-Key'     => env('TELRAAM_X_API_KEY'),
                    'db'            => env('BUSINESS_API_SECRET_DB'),
                ],
                'body'   => json_encode($jsonArray),
                'debug' => false
            ]);

            $content = json_decode($apiRequest->getBody()->getContents());
            if ($apiRequest->getStatusCode() == 200 || $apiRequest->getStatusCode() == 201) {
                return $content->report;
            } else {
                return true;
            }

        } catch (RequestException $re) {

            Log::debug('businnesApi - getCameras error: '.$re);
            return $re;

        }

    }

    public function getLastHourWithData($reportArray) {

        $lastIndex = count($reportArray);
        $lastEntry = $reportArray[$lastIndex-1]; // last hour in de database for the cluster

        return $lastEntry; // 5
    }

    // $responseArray is the answer from the business api
    // this converts UTC to timezone
    public function convertTimeZoneToUTC($dateUTC, $timezone = 'Europe/Brussels') {
        // $timezone = 'Europe/Brussels';
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $dateUTC, $timezone)->setTimezone('UTC')->format('Y-m-d H:i:s');
        return $date.'Z';

    }



}
