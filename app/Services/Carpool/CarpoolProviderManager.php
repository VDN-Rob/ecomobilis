<?php

namespace App\Services\Carpool;

use App\Services\Carpool\Contracts\CarpoolProvider;
use App\Services\Carpool\Providers\BlaBlaCarDailyProvider;
use App\Services\Carpool\Providers\EcomobilisCarpoolProvider;
use InvalidArgumentException;

class CarpoolProviderManager
{
    /**
     * @var array<string, CarpoolProvider>
     */
    private array $providers;

    public function __construct(
        EcomobilisCarpoolProvider $ecomobilisProvider,
        BlaBlaCarDailyProvider $blaBlaCarDailyProvider,
    ) {
        $this->providers = [
            'ecomobilis' => $ecomobilisProvider,
            'blablacar_daily' => $blaBlaCarDailyProvider,
        ];
    }

    public function getProvider(): CarpoolProvider
    {
        $providerName = config('carpool.provider', 'ecomobilis');

        if (!isset($this->providers[$providerName])) {
            throw new InvalidArgumentException(
                "Unknown carpool provider: {$providerName}"
            );
        }

        return $this->providers[$providerName];
    }

    public function getProviderByName(string $name): CarpoolProvider
    {
        if (!isset($this->providers[$name])) {
            throw new InvalidArgumentException(
                "Unknown carpool provider: {$name}"
            );
        }

        return $this->providers[$name];
    }

    /**
     * @return array<string, CarpoolProvider>
     */
    public function getProviders(): array
    {
        return $this->providers;
    }
}