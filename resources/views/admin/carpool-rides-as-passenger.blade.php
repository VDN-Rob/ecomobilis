@extends('_layout.app')
@section('content')

    <!--  block with search -->
    @include('admin._includes.sub-navigation')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1> {{ __('carpool.my-rides-as-passenger') }}</h1>
            </div>
        </div> <!--  grid -->
    </div>

    <div class="block">
        @if(count($rides) > 0)
            @foreach($rides as $ride)
                @include('_includes.carpool-ride-block', ['layout' => 'overview-listing', 'showReservations' => 1, 'showConversations' => 1])
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
