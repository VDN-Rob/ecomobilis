@extends('_layout.app')
@section('content')

    <!-- top block with title -->
    <div class="block no-bottom-margin no-bottom-padding">
        <div class="grid">
            @if($group->is_archived == 1)
            <div class="col-desk-12 extra-margin-top">
                <div class="warning red box">
                    <span class="heroicon heroicon-archive"></span> {{ __('carpool.group-is-archived') }}
                </div>
            </div>
            @endif
            <div class="col-desk-6">
                <h1 class="no-bottom-margin">{{ $group->title }}</h1>
                <div class="dark-blue">{{ $group->description }}</div>
                <br>
                <!-- <strong class="grey no-bottom-margin"><span class="heroicon heroicon-information"></span> {{ $group->description }}</strong><br> -->
                <div  class="grey no-bottom-margin"><span class="heroicon heroicon-location"></span> {{ $group->location->street }}, {{ $group->location->city }}</div>
                @if($group->rides_are_private == 1) <div class="grey"><span class="heroicon heroicon-lock-closed"></span> {{ __('carpool.rides-are-private') }}</div> @endif
            </div>

            <div class="col-desk-6 text-right">
                @if($group->is_archived !== 1)
                    <div class="extra-padding-top">
                        @if(!isset(Auth::user()->id))
                            <a href="#" class="button disabled" > {{ __('carpool.add-a-ride') }}</a>
                        @elseif(empty(Auth::user()->birth_date) || empty(Auth::user()->car))
                            <a href="#" class="button disabled" > {{ __('carpool.add-a-ride') }}</a>
                            <a href="{{ url('/') }}/admin/user/profile/edit/" class="grey tiny">Complétez d'abord votre profil</a>
                        @else
                            <a href="/carpool/add?groupid={{ $group->id }}" class="button">{{ __('carpool.add-a-ride') }}</a>
                        @endif
                    </div>
                @endif
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
