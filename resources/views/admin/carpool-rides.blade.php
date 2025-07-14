@extends('_layout.app')
@section('content')

    <!--  block with search -->
    @include('admin._includes.sub-navigation')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1> {{ __('carpool.my-rides') }}</h1>
            </div>
            <div class="col-desk-12 ">
                @if(empty(Auth::user()->car))
                    <a href="#" class="button disabled" > {{ __('carpool.add-a-ride') }}</a>
                    &nbsp;&nbsp;
                    <a href="{{ url('/') }}/admin/user/profile/{{ Auth::user()->id }}/edit/" class="grey tiny">Complete your profile first</a>
                @else
                    <a href="/carpool/add" class="button"> {{ __('carpool.add-a-ride') }}</a>
                @endif
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
                    <div class="nothing-found">
                        {{ __('carpool.no-rides-found') }}
                        @if(empty(Auth::user()->birth_date) || empty(Auth::user()->car))
                            <div class="go-to-profile box" style="margin-top: 25px">
                                {{ __('general.please-complete-profile') }}<br><br>
                                <a href="{{ url('/') }}/admin/user/profile/{{ Auth::user()->id }}/edit/" class="button tiny">{{ __('general.user-profile-btn') }}</a>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        @endif
    </div>

@endsection
