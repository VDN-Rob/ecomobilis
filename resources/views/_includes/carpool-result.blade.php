<div class="block carpool-result">
    <div class="grid">
        <div class="col-desk-12">
            <strong>{{ $ride->provider }}</strong>
        </div>

```
    <div class="col-desk-6">
        <div>
            <strong>{{ __('carpool.departure') }}</strong>
        </div>
        <div>
            {{ $ride->pickupDatetime->format('Y-m-d H:i') }}
        </div>
        <div>
            {{ number_format($ride->pickupLatitude, 5) }},
            {{ number_format($ride->pickupLongitude, 5) }}
        </div>
    </div>

    <div class="col-desk-6">
        <div>
            <strong>{{ __('carpool.arrival') }}</strong>
        </div>
        <div>
            {{ number_format($ride->dropoffLatitude, 5) }},
            {{ number_format($ride->dropoffLongitude, 5) }}
        </div>
    </div>

    @if($ride->duration !== null || $ride->distance !== null)
        <div class="col-desk-6">
            @if($ride->duration !== null)
                <div>
                    {{ __('carpool.duration') }}:
                    {{ round($ride->duration / 60) }} min
                </div>
            @endif

            @if($ride->distance !== null)
                <div>
                    {{ __('carpool.distance') }}:
                    {{ round($ride->distance / 1000, 1) }} km
                </div>
            @endif
        </div>
    @endif

    <div class="col-desk-6">
        @if($ride->priceAmount !== null)
            <div>
                {{ $ride->priceAmount }}
                {{ $ride->priceCurrency }}
            </div>
        @endif

        @if($ride->availableSeats !== null)
            <div>
                {{ $ride->availableSeats }}
                {{ __('carpool.available-seats') }}
            </div>
        @endif
    </div>

    @if($ride->departureToPickupWalkingTime !== null)
        <div class="col-desk-6">
            {{ __('carpool.walk-to-pickup') }}:
            {{ round($ride->departureToPickupWalkingTime / 60) }} min
        </div>
    @endif

    @if($ride->dropoffToArrivalWalkingTime !== null)
        <div class="col-desk-6">
            {{ __('carpool.walk-from-dropoff') }}:
            {{ round($ride->dropoffToArrivalWalkingTime / 60) }} min
        </div>
    @endif

    @if($ride->detailsUrl !== null)
        <div class="col-desk-12">
            <a
                href="{{ $ride->detailsUrl }}"
                class="button"
                target="_blank"
                rel="noopener noreferrer"
            >
                {{ __('carpool.view-ride') }}
            </a>
        </div>
    @endif
</div>
```

</div>
