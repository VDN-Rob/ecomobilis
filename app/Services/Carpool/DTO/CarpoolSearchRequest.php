<?php

namespace App\Services\Carpool\DTO;

use DateTimeInterface;

/**
 * Represents what the user is searching for - independently of the provider.
 */
class CarpoolSearchRequest
{
    public function __construct(
        public readonly float $departureLatitude,
        public readonly float $departureLongitude,
        public readonly float $arrivalLatitude,
        public readonly float $arrivalLongitude,
        public readonly DateTimeInterface $departureDatetime,
        public readonly int $departureTimeTolerance = 3600,
    ) {
    }
}