<?php

namespace App\Services\Carpool\DTO;

use DateTimeInterface;

/**
 * Common representation of one ride returned by any provider.
*/
class CarpoolRideResult
{
    public function __construct(
        public readonly string $provider,
        public readonly string $providerRideId,
    
        public readonly float $pickupLatitude,
        public readonly float $pickupLongitude,
        public readonly DateTimeInterface $pickupDatetime,
    
        public readonly float $dropoffLatitude,
        public readonly float $dropoffLongitude,
    
        public readonly ?int $duration = null,
        public readonly ?int $distance = null,
    
        public readonly ?string $detailsUrl = null,
    
        public readonly ?int $departureToPickupWalkingTime = null,
        public readonly ?int $dropoffToArrivalWalkingTime = null,
        public readonly ?string $journeyPolyline = null,
    
        public readonly ?float $priceAmount = null,
        public readonly ?string $priceCurrency = null,
        public readonly ?int $availableSeats = null,
    ) {
    }
}