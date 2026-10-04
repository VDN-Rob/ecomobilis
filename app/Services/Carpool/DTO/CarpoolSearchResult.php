<?php

namespace App\Services\Carpool\DTO;

/**
 * Represents the complete result of a provider search. (a list of search results)
 */
class CarpoolSearchResult
{
    /**
     * @param CarpoolRideResult[] $rides
     */
    public function __construct(
        public readonly array $rides = [],
    ) {
    }

    public function count(): int
    {
        return count($this->rides);
    }

    public function isEmpty(): bool
    {
        return empty($this->rides);
    }
}