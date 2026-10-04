<?php

namespace App\Services\Carpool\Contracts;

use App\Services\Carpool\DTO\CarpoolSearchRequest;
use App\Services\Carpool\DTO\CarpoolSearchResult;

/**
 * Contract/interface that every carpool provider must implement.
 */
interface CarpoolProvider
{
    public function getName(): string;

    public function search(CarpoolSearchRequest $request): CarpoolSearchResult;
}