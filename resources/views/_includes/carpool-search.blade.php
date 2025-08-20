<div class="block carpool-search-block box">
    {!! Form::model(null, array('method' => 'POST', 'route' => ['web.carpoolMatching'], 'class' => 'ui form', 'files' => false)) !!}

    <div class="grid">

        <div class="col-desk-12 text-center titles">
            <h4>{{ __('carpool.search-subtitle') }}</h4>
            <h3>{{ __('carpool.search-title') }}</h3>
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
