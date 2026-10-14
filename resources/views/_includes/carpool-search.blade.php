<div class="block carpool-search-block box">
    {!! Form::model(null, array('method' => 'POST', 'route' => ['web.carpoolMatching'], 'class' => 'ui form', 'files' => false)) !!}

    <div class="grid">

        <div class="col-desk-12 text-center titles">
            <h4>{{ __('carpool.search-subtitle') }}</h4>
            <h3>{{ __('carpool.search-title') }}</h3>
        </div>
        <div class="col-desk-12" style="margin-bottom: 20px;">
            <div class="field">
                <label for="carpool_provider">{{ __('carpool.search-provider') }}</label>
                <select id="carpool_provider" name="provider" onchange="saveCarpoolProvider(this.value)">
                    <option value="ecomobilis"
                        @selected(($selectedProvider ?? config('carpool.provider', 'ecomobilis')) === 'ecomobilis')>
                        Ecomobilis
                    </option>
                    <option value="blablacar_daily"
                        @selected(($selectedProvider ?? config('carpool.provider', 'ecomobilis')) === 'blablacar_daily')>
                        Caro'Ligne
                    </option>
                </select>
            </div>
        </div>
        <!--  dep and arrival autocomplete -->
        @include('_includes.carpool-dep-arr-autocomplete', ['layout' => 'search'])

        <div class="col-desk-3 col-mob-4 col-search-date">
            <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">Date </div>
            <div class="field special-placeholder">
                <input
                    type="datetime-local" id="travel_start_datetime" name="travel_start_datetime"
                     @if(isset($searchDateFormatted))
                        value="{{ $searchDateFormatted }}"
                     @else
                        value="{{ Carbon\Carbon::tomorrow()->format('Y-m-d h:00') }}"
                     @endif
                   />
            </div>
        </div>
        <div class="col-desk-2 col-mob-4">
            <button class="big button" style="width: 100%;">
                {{ __('carpool.search') }}
            </button>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>
    function saveCarpoolProvider(provider) {
        fetch(@json(route('web.carpoolSelectProvider')), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': @json(csrf_token()),
                'Accept': 'application/json',
            },
            body: JSON.stringify({ provider: provider }),
        }).then(function (response) {
            if (response.ok) {
                window.location.href = @json(route('web.carpoolOverview'));
            } else {
                window.location.reload();
            }
        });
    }
</script>
