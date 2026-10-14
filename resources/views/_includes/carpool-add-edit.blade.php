
<div class="grid grid-with-row-margin stackable">
    <!--  dep and arrival autocomplete -->
    <div class="col-desk-12">

    </div>
    @include('_includes.carpool-dep-arr-autocomplete', ['layout' => 'add-edit'])

    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.date') }}</div>
        <div class="field special-placeholder">
            <input type="datetime-local" id="travel_start_datetime" name="travel_start_datetime"
                   value="{{ old('travel_start_datetime', isset($ride) ? \Carbon\Carbon::parse($ride->travel_start_datetime)->format('Y-m-d\TH:i') : \Carbon\Carbon::tomorrow()->format('Y-m-d\TH:i')) }}"
            />
             @error('travel_start_datetime')
                <div class="error tiny red">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.seats_available') }}</div>
        <div class="field special-placeholder">
            <input type="text" id="seats_available" name="seats_available"
                value="{{ old('seats_available', isset($ride) ? $ride->seats_available : (Auth::user()->car->default_seats_available ?? 2)) }}"
            />
        </div>
    </div>

    <div class="col-desk-12">
        <h4>{{ __('carpool.details-title') }}</h4>
    </div>
    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.luggage') }}</div>
        <select name="luggage_id" class="dropdown" >
            @foreach($luggages as $luggage)
                <option
                    value="{{ $luggage->id }}"
                    @if((string) old('luggage_id', isset($ride) ? $ride->luggage_id : (Auth::user()->car->default_luggage_id ?? '')) === (string) $luggage->id)
                        selected
                    @endif
                >
                    {{ $luggage->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.price') }} &nbsp;&nbsp;
            <span class="tiny grey js-your-price-per-km">
                {{ __('carpool.your_price_per_km') }}:
                @if(empty(Auth::user()?->car?->price_per_km_per_seat))
                    {{ Auth::user()?->car?->price_per_km_per_seat }}
                @else
                    0.10
                @endif
                    /km
            </span>
            <span class="tiny grey js-distance-container" style="display: none;">| {{ __('carpool.distance_birds_view') }}: <span class="js-distance"></span></span>
            <span class="js-suggested-price"></span>
        </div>
        <div class="field special-placeholder">
            <input type="text" id="price_per_seat" name="price_per_seat"
                value="{{ old('price_per_seat', isset($ride) ? $ride->price_per_seat : '10.00') }}"
            />
        </div>
    </div>

    <div class="col-desk-6">
        <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">{{ __('carpool.remark') }} &nbsp;</div>
        <div class="field special-placeholder">
            <input type="text" id="remark" name="remark"
                value="{{ old('remark', isset($ride) ? $ride->remark : '') }}"
            />
        </div>
    </div>
</div>
<div class="grid grid-with-row-margin stackable">
    <input type="hidden" id="group_id" name="group_id"
        value="{{ old('group_id', $group_id ?? ($ride->group_id ?? '')) }}"
    >
    <div class="col-desk-6 col-mob-4 text-left">
        @if(isset($ride)) <a href="#" class=" js-open-modal" data-modal="modalCancelRide">{{ __('carpool.ride-cancel-btn') }}</a>  @endif
    </div>
    <div class="col-desk-6 col-mob-4 text-right">
        <input class="button big" name="submit" type="submit" @if(isset($ride)) value="{{ __('general.edit') }}"  @else  value="{{ __('general.add') }}" @endif style="width:250px">
    </div>
</div>

