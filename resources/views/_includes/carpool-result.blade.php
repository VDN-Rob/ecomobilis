@if(isset($ride)) <div class="box box-with-border box-ride box-ride-overview-listing"> <div class="grid grid-ride-block">

        <div class="col-desk-2 col-mob-2 col-mob-header-design">
            {{ $ride->pickupDatetime->format('d M y') }}<br>
            <div class="tiny">
                {{ $ride->pickupDatetime->format('H:i') }}
            </div>
        </div>

        <div class="col-desk-2 col-mob-2 col-from-to col-from col-mob-dep-design">
            <strong>{{ __('carpool.departure') }}</strong><br>
            <div class="tiny">
                {{ number_format($ride->pickupLatitude, 5) }},
                {{ number_format($ride->pickupLongitude, 5) }}
            </div>
        </div>

        <div class="col-desk-1 hide-on-mobile-only col-from-to">
            <div style="position: relative; top: 5px;"> → </div>
        </div>

        <div class="col-desk-2 col-mob-2 col-from-to col-to col-mob-arr-design">
            <strong>{{ __('carpool.arrival') }}</strong><br>
            <div class="tiny">
                {{ number_format($ride->dropoffLatitude, 5) }},
                {{ number_format($ride->dropoffLongitude, 5) }}
            </div>
        </div>

        <div class="col-desk-2 col-mob-4 hide-on-mobile-only">
            @if($ride->priceAmount !== null)
                <strong>
                    {{ number_format($ride->priceAmount, 2, ',', ' ') }}
                    {{ $ride->priceCurrency }}
                </strong>
            @endif
        </div>

        <div class="col-desk-2 text-right last-col col-mob-4 details">

            @if($ride->availableSeats !== null)
                <div class="tiny">
                    <strong>{{ $ride->availableSeats }}</strong>
                    {{ __('carpool.places-available') }}
                </div>
            @endif

            @if($ride->duration !== null)
                <div class="tiny">
                    {{ __('carpool.duration') }}:
                    {{ round($ride->duration / 60) }} min
                </div>
            @endif

            @if($ride->distance !== null)
                <div class="tiny">
                    {{ __('carpool.distance') }}:
                    {{ number_format($ride->distance / 1000, 1, ',', ' ') }} km
                </div>
            @endif

            @if($ride->departureToPickupWalkingTime !== null)
                <div class="tiny">
                    {{ __('carpool.walk-to-pickup') }}:
                    {{ round($ride->departureToPickupWalkingTime / 60) }} min
                </div>
            @endif

            @if($ride->dropoffToArrivalWalkingTime !== null)
                <div class="tiny">
                    {{ __('carpool.walk-from-dropoff') }}:
                    {{ round($ride->dropoffToArrivalWalkingTime / 60) }} min
                </div>
            @endif

            @if($ride->detailsUrl !== null)
                <a
                    href="{{ $ride->detailsUrl }}"
                    class="button tiny bg-white"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    {{ __('carpool.view-ride') }}
                </a>
            @endif

        </div>

        <div class="col-desk-12 tiny text-right">
            {{ $ride->provider }}
        </div>

    </div>
</div>

@endif
