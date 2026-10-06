@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>{{ __('carpool.title') }}</h1>
            </div>
            <div class="col-desk-12 ">
                @guest
                    <a href="#" class="button disabled" > {{ __('carpool.add-a-ride') }}</a>
                @else
                    @if(empty(Auth::user()->birth_date) || empty(Auth::user()->car))
                        <a href="#" class="button disabled" > {{ __('carpool.add-a-ride') }}</a>
                        &nbsp;&nbsp;
                    @else
                        <a href="/carpool/add" class="button">{{ __('carpool.add-a-ride') }}</a>
                    @endif
                @endguest

            </div>
        </div> <!--  grid -->
    </div>


    <!--  block with search -->
    @include('_includes.carpool-search')



    <div class="block">
        <div class="grid">
            <div class="col-desk-12 text-center">
                <h2>{{ __('carpool.carpool-without-filter-overview-title') }}</h2>
            </div>
        </div>
        @if(count($rides) > 0)
            @foreach($rides as $ride)
                @if($ride instanceof \App\Services\Carpool\DTO\CarpoolRideResult)
                    @include('_includes.carpool-result')
                @else
                    @include('_includes.carpool-ride-block', ['layout' => 'overview-listing', 'showReservations' => 0, 'showConversations' => 0])
                @endif
            @endforeach
        @else
            <div class="grid">
                <div class="col-desk-12 text-center">
                    <div class="nothing-found">{{ __('carpool.no-rides-found') }}</div>
                </div>
            </div>
        @endif
    </div>
@endsection
