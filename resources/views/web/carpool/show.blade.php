@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 "><h1>{{ $ride->departure->city }} → {{ $ride->arrival->city }}</h1></div>
        </div> <!--  grid -->
    </div>


    <div class="block">
        @if(!empty($ride))
                @include('_includes.carpool-ride-block', ['layout' => 'overview-listing', 'showReservations' => 1, 'showConversations' => 0])
        @else
            <div class="grid">
                <div class="col-desk-12 text-center">
                    <div class="nothing-found">{{ __('carpool.no-rides-found') }}</div>
                </div>
            </div>
        @endif
    </div>
@endsection
