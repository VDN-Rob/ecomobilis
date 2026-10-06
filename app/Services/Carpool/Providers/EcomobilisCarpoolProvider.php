<?php

namespace App\Services\Carpool\Providers;

use App\Models\CarpoolRide;
use App\Models\CarpoolStreetCoordinate;
use App\Services\Carpool\Contracts\CarpoolProvider;
use App\Services\Carpool\DTO\CarpoolRideResult;
use App\Services\Carpool\DTO\CarpoolSearchRequest;
use App\Services\Carpool\DTO\CarpoolSearchResult;
use Carbon\Carbon;

class EcomobilisCarpoolProvider implements CarpoolProvider
{
    public function getName(): string {
        return 'ecomobilis';
    }

    public function search(CarpoolSearchRequest $request): CarpoolSearchResult {
        $departure = new CarpoolStreetCoordinate();
        $arrival = new CarpoolStreetCoordinate();

        $departure->lat = $request->departureLatitude;
        $departure->lon = $request->departureLongitude;

        $arrival->lat = $request->arrivalLatitude;
        $arrival->lon = $request->arrivalLongitude;

        $rides = (new CarpoolRide())->getMatchingRides(
            $departure,
            $arrival,
            $request->departureDatetime
        );

        $rides->load([
            'departure',
            'arrival',
        ]);

        $results = $rides->map(function (CarpoolRide $ride) {
            return new CarpoolRideResult(
                provider: $this->getName(),
                providerRideId: (string) $ride->id,
                pickupLatitude: (float) $ride->departure->lat,
                pickupLongitude: (float) $ride->departure->lon,
                pickupDatetime: Carbon::parse($ride->travel_start_datetime),
                dropoffLatitude: (float) $ride->arrival->lat,
                dropoffLongitude: (float) $ride->arrival->lon,
                detailsUrl: route('web.carpoolShow', ['id' => $ride->id]),
                availableSeats: (int) $ride->seats_available,
                priceAmount: $ride->price_per_seat !== null
                    ? (float) $ride->price_per_seat
                    : null,
                priceCurrency: 'EUR',
            );
        })->all();

        return new CarpoolSearchResult($results);
    }
}