@extends('_layout.app')
@section('content')



    <!-- top block with first paragraph -->
    <div class="block extra-margin-bottom extra-padding-bottom">
        <div class="col-desk-12 ">
            <h1>{{ $user->firstname }} @guest @else {{ $user->lastname }} @endif </h1>
        </div>

        <div class="box extra-box-shadow">
            <div class="grid stackable grid-with-row-margin ">

                <div class="col-desk-3 ">
                    <strong>{{ __('user.first-name') }}</strong>
                </div>
                <div class="col-desk-3 ">
                    {{ $user->firstname }}
                </div>

                <div class="col-desk-3 ">
                    <strong>{{ __('user.last-name') }}</strong>
                </div>
                <div class="col-desk-3 ">
                    {{ $user->lastname }}
                </div>

                <div class="col-desk-3 ">
                    <strong>{{ __('user.gender') }}</strong>
                </div>
                <div class="col-desk-3 ">
                    {{ $user->gender }}
                </div>

                <div class="col-desk-3 ">
                    <strong>{{ __('user.email') }}</strong>
                </div>
                <div class="col-desk-3 ">
                    @guest
                        <div class="tiny">{{ __('user.login-to-view') }}</div>
                    @else
                        {{ $user->email }}
                    @endguest
                </div>

                <div class="col-desk-3 ">
                    <strong>{{ __('user.member-since') }}</strong>
                </div>
                <div class="col-desk-3 ">
                    @guest
                        <div class="tiny">{{ __('user.login-to-view') }}</div>
                    @else
                        {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d M y') }}
                    @endguest
                </div>


                <div class="col-desk-3 ">
                        <strong>{{ __('user.age') }}</strong>
                </div>
                <div class="col-desk-3 ">
                    @guest
                        <div class="tiny">{{ __('user.login-to-view') }}</div>
                    @else
                        @if(!empty($user->birth_date))
                            {{ Carbon\Carbon::parse($user->birth_date)->age }}
                        @endif
                    @endguest
                </div>

                <hr>
                <div class="col-desk-3 ">
                    <strong>{{ __('user.bio') }}</strong>
                </div>
                <div class="col-desk-3 ">
                    @guest
                        <div class="tiny">{{ __('user.login-to-view') }}</div>
                    @else
                        {{ $user->bio }}
                    @endguest
                </div>

            </div> <!--  grid -->
        </div>

        @if(isset($user->car))
            <div class="box extra-box-shadow">
                <div class="grid stackable grid-with-row-margin ">

                    <div class="col-desk-3 ">
                        <strong>{{ __('carpool.brand') }}</strong>
                    </div>
                    <div class="col-desk-3 ">
                        {{ $user?->car?->brand }}
                    </div>

                    <div class="col-desk-3 ">
                        <strong>{{ __('carpool.car_type') }}</strong>
                    </div>
                    <div class="col-desk-3 ">
                        {{ $user?->car?->type->type }}
                    </div>

                    <div class="col-desk-3 ">
                        <strong>{{ __('carpool.description') }}</strong>
                    </div>
                    <div class="col-desk-3 ">
                        {{ $user?->car?->description }}
                    </div>


                    <div class="col-desk-3 ">
                        <strong>{{ __('carpool.luggage') }}</strong>
                    </div>
                    <div class="col-desk-3 ">
                        {{ $user?->car?->luggage->name }}
                    </div>

                    <div class="col-desk-3 ">
                        <strong>{{ __('carpool.seats_available') }}</strong>
                    </div>
                    <div class="col-desk-3 ">
                        {{ $user?->car?->default_seats_available }}
                    </div>

                    <div class="col-desk-3 ">
                        <strong>{{ __('carpool.is_smoking_allowed') }}</strong>
                    </div>
                    <div class="col-desk-3 ">
                        @if($user?->car?->is_smoking_allowed == 1) ✓ @else x @endif
                    </div>

                    <div class="col-desk-3 ">
                        <strong>{{ __('carpool.is_isofix_present') }}</strong>
                    </div>
                    <div class="col-desk-3 ">
                        @if($user?->car?->is_isofix_present == 1) ✓ @else x @endif
                    </div>

                    <div class="col-desk-3 ">
                        <strong>{{ __('carpool.price_per_km') }}</strong>
                    </div>
                    <div class="col-desk-3 ">
                        € {{ $user?->car?->price_per_km_per_seat }}
                    </div>

                </div>
            </div>
        @endif

    </div>

@endsection
