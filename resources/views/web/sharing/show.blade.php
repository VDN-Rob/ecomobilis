@extends('_layout.app')
@section('extraSeoTitle', __('public-general.seo-title-blog'))
@section('content')

    <!-- top block with first - paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 text-center">
                <h1>{{ $org->name }}</h1>
            </div>
            <div class="col-desk-8 center-the-column text-center    " >
                <strong class="intro">{{ $org->short_description }}</strong>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="grid">
            <div class="col-desk-8 center-the-column" >
                <div class="short-description">{!! $org->body !!}</div> <br>
                @if($org->website) <div class="website"><a href="{{ $org->website }}" target="_blank">{{ $org->website }}</a></div>    <br>@endif
                <div class="filters">
                    @if($org->prop_vehicle_car) <span class="tiny label">{{ __('sharing.car') }}</span> @endif
                    @if($org->prop_vehicle_ecar) <span class="tiny label">{{ __('sharing.ecar') }}</span> @endif
                    @if($org->prop_vehicle_bike) <span class="tiny label">{{ __('sharing.bike') }}</span> @endif
                    @if($org->prop_vehicle_ebike) <span class="tiny label">{{ __('sharing.ebike') }}</span> @endif
                    @if($org->prop_vehicle_cargobike) <span class="tiny label">{{ __('sharing.cargobike') }}</span>@endif
                    @if($org->prop_vehicle_ecargobike) <span class="tiny label">{{ __('sharing.ecargobike') }}</span>@endif
                    @if($org->prop_vehicle_step) <span class="tiny label">{{ __('sharing.step') }}</span>@endif
                </div>

            </div>
        </div>
    </div>



@endsection
