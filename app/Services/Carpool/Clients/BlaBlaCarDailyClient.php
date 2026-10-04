<?php

namespace App\Services\Carpool\Clients;

use App\Services\Carpool\DTO\CarpoolSearchRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

class BlaBlaCarDailyClient
{
    private const SEARCH_ENDPOINT = '/2/third_party/public/search';

    private Client $httpClient;

    private string $accessToken;

    public function __construct()
    {
        $baseUrl = config(
            'services.blablacar_daily.base_url',
            'https://partners.blablacardaily.com'
        );

        $this->accessToken = (string) config(
            'services.blablacar_daily.access_token'
        );

        $this->httpClient = new Client([
            'base_uri' => rtrim($baseUrl, '/'),
            'timeout' => 10,
            'connect_timeout' => 5,
        ]);
    }

    /**
     * Search available BlaBlaCar Daily rides.
     *
     * @return array<int, array<string, mixed>>
     */
    public function search(CarpoolSearchRequest $request): array
    {
        if ($this->accessToken === '') {
            throw new RuntimeException(
                'BlaBlaCar Daily API access token is not configured.'
            );
        }

        try {
            $response = $this->httpClient->get(self::SEARCH_ENDPOINT, [
                'query' => [
                    'access_token' => $this->accessToken,
                    'departure_latitude' => $request->departureLatitude,
                    'departure_longitude' => $request->departureLongitude,
                    'arrival_latitude' => $request->arrivalLatitude,
                    'arrival_longitude' => $request->arrivalLongitude,
                    'departure_epoch' => $request->departureDatetime->getTimestamp(),
                    'departure_timedelta' => $request->departureTimeTolerance,
                ],
            ]);
        } catch (GuzzleException $exception) {
            throw new RuntimeException(
                'Unable to communicate with the BlaBlaCar Daily API.',
                0,
                $exception
            );
        }

        $data = json_decode(
            $response->getBody()->getContents(),
            true
        );

        if (!is_array($data)) {
            throw new RuntimeException(
                'BlaBlaCar Daily API returned an invalid response.'
            );
        }

        return $data;
    }
}