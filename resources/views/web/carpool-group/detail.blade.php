@extends('_layout.app')
@section('content')

    <!-- top block with title -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-6">
                <h1 class="no-bottom-margin">{{ $group->title }}</h1>
                <br>
                <strong class="grey no-bottom-margin"><span class="heroicon heroicon-information"></span> {{ $group->description }}</strong><br>
                <strong  class="grey no-bottom-margin"><span class="heroicon heroicon-location"></span> {{ $group->location->street }}, {{ $group->location->city }}</strong><br>
                @if($group->rides_are_private == 1) <span class="grey"><span class="heroicon heroicon-lock-closed"></span> {{ __('carpool.rides-are-private') }}</span> @endif

            </div>

            <div class="col-desk-6 text-right">
                <div class="extra-padding-top">
                    @if(!isset(Auth::user()->id))
                        <a href="#" class="button disabled" > {{ __('carpool.add-a-ride') }}</a>
                    @elseif(empty(Auth::user()->birth_date) || empty(Auth::user()->car))
                        <a href="#" class="button disabled" > {{ __('carpool.add-a-ride') }}</a>
                        <a href="{{ url('/') }}/admin/user/profile/{{ Auth::user()->id }}/edit/" class="grey tiny">Complete your profile first</a>
                    @else
                        <a href="/carpool/add?groupid={{ $group->id }}" class="button">{{ __('carpool.add-a-ride') }}</a>
                    @endif

                </div>
            </div>
        </div> <!--  grid -->
    </div>

    <div class="block">
        @include('_includes.group-map')
    </div>

    <div class="block">
        @if(count($group->rides) > 0)
            @foreach($group->rides as $ride)
                @include('_includes.carpool-ride-block', ['layout' => 'overview-listing', 'showReservations' => 0, 'showConversations' => 0])
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
