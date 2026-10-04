<?php

namespace App\Services\Carpool\Providers;

use App\Services\Carpool\Clients\BlaBlaCarDailyClient;
use App\Services\Carpool\Contracts\CarpoolProvider;
use App\Services\Carpool\DTO\CarpoolRideResult;
use App\Services\Carpool\DTO\CarpoolSearchRequest;
use App\Services\Carpool\DTO\CarpoolSearchResult;
use Carbon\Carbon;
use DateTimeInterface;
use InvalidArgumentException;

class BlaBlaCarDailyProvider implements CarpoolProvider
{
    private const PROVIDER_NAME = 'blablacar_daily';

    public function __construct(private readonly BlaBlaCarDailyClient $client) {}

    public function getName(): string {
        return self::PROVIDER_NAME;
    }

    public function search(CarpoolSearchRequest $request): CarpoolSearchResult {
        $this->validateSearchRequest($request);

        $rides = $this->client->search($request);

        $results = [];

        foreach ($rides as $ride) {
            $results[] = $this->mapRide($ride);
        }

        return new CarpoolSearchResult($results);
    }

    private function validateSearchRequest(CarpoolSearchRequest $request): void {
        $now = Carbon::now();
        $departure = Carbon::instance(
            \DateTime::createFromInterface($request->departureDatetime)
        );

        $minimumDeparture = $now->copy()->addMinutes(15);
        $maximumDeparture = $now->copy()->addWeek();

        if ($departure->lt($minimumDeparture)) {
            throw new InvalidArgumentException(
                'BlaBlaCar Daily searches must be at least 15 minutes in the future.'
            );
        }

        if ($departure->gt($maximumDeparture)) {
            throw new InvalidArgumentException(
                'BlaBlaCar Daily searches cannot be more than one week in advance.'
            );
        }
    }

    /**
     * @param array<string, mixed> $ride
     */
    private function mapRide(array $ride): CarpoolRideResult {
        return new CarpoolRideResult(
            provider: $this->getName(),
            providerRideId: (string) $ride['id'],

            duration: isset($ride['duration'])
                ? (int) $ride['duration']
                : null,

            distance: isset($ride['distance'])
                ? (int) $ride['distance']
                : null,

            pickupLatitude: (float) $ride['pickup_latitude'],
            pickupLongitude: (float) $ride['pickup_longitude'],

            pickupDatetime: Carbon::parse(
                $ride['pickup_datetime']
            ),

            dropoffLatitude: (float) $ride['dropoff_latitude'],
            dropoffLongitude: (float) $ride['dropoff_longitude'],

            detailsUrl: $ride['web_url'] ?? null,

            departureToPickupWalkingTime:
                isset($ride['departure_to_pickup_walking_time'])
                    ? (int) $ride['departure_to_pickup_walking_time']
                    : null,

            dropoffToArrivalWalkingTime:
                isset($ride['dropoff_to_arrival_walking_time'])
                    ? (int) $ride['dropoff_to_arrival_walking_time']
                    : null,

            journeyPolyline: $ride['journey_polyline'] ?? null,

            priceAmount: isset($ride['price']['amount'])
                ? (float) $ride['price']['amount']
                : null,

            priceCurrency: $ride['price']['currency'] ?? null,

            availableSeats: isset($ride['available_seats'])
                ? (int) $ride['available_seats']
                : null,
        );
    }
}