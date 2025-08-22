@if(isset($ride))
<div class="box box-with-border box-ride box-ride-{{ $layout }} @if($ride->is_cancelled) box-ride-is-cancelled @endif">
    <div class="grid">
        @if($ride->is_cancelled) <div class="col-desk-12 red text-center"><strong>Votre trajet a été annulé!</strong><br><br></div>@endif
        @if($layout !== 'email-listing')
            <div class="col-desk-1 col-mob-1 text-center col-mob-header-design text-center">
                <div class="driver-info">
                    <a href="{{ url('/') }}/user/profile/{{ $ride->user->id }}">
                        <div class="msg-img">{{ strtoupper(substr($ride->user->firstname, 0, 1)) }}{{ strtoupper(substr($ride->user->lastname, 0, 1)) }}</div>
                        <div class="name tiny grey">{{ __('carpool.driver') }} {{ $ride->user->firstname }} </div>
                    </a>
                </div>
                @if($ride->is_private == 1)
                    <div class="ride-private">
                        <img src="{{ url('/') }}/images/icons/lock.svg" width="18px">
                    </div>
                @endif
                @if($layout == 'overview-listing')
                    @if($ride->group)
                         <a href="{{ url('/') }}/group/{{ $ride->group->token }}" class="ride-group tiny grey">{{ $ride->group->title }}</a>
                    @endif
                @endif
            </div>
        @endif
        <div class="col-desk-2 col-mob-2 col-mob-header-design " @if($layout == 'email-listing') style="width:100%; display: block; font-size: 20px" @endif>
            {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ride->travel_start_datetime)->format('d M y') }}<br>
            <div class="tiny">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $ride->travel_start_datetime)->format('H:i') }}</div>
        </div>
        <div class="col-desk-0 col-mob-1 show-on-mobile-only col-mob-header-design"  @if($layout == 'email-listing') style="width:100%; display: block; margin-bottom: 10px" @endif>
            <strong>€ {{ $ride->price_per_seat}}</strong>
        </div>
        <div class="col-desk-2 col-mob-2 col-from-to col-from  col-mob-dep-design">
            <strong>{{ $ride->departure->city }}</strong><br>
            <div class="tiny">{{ $ride->departure->street }}</div>
        </div>
        <div class="col-desk-1 hide-on-mobile-only col-from-to">
            <div style="position: relative; top: 5px;"> → </div>
        </div>
        <div class="col-desk-2 col-mob-2 col-from-to col-mob-arr-design">
            <strong>{{ $ride->arrival->city }}</strong><br>
            <div class="tiny">{{ $ride->arrival->street }}</div>
        </div>
        <div class="col-desk-2 col-mob-4 hide-on-mobile-only">
            <strong>€ {{ $ride->price_per_seat}}</strong>
        </div>
        <div class="@if($layout == 'email-listing') col-desk-3 @else col-desk-2 @endif text-right last-col col-mob-4 details">
            <div class="tiny">
                @if($ride->reservedamount)
                    @if($ride->seats_available - $ride->reservedamount()->sum('amount') < 1)
                        <span class="red">{{ $ride->seats_available - $ride->reservedamount()->sum('amount') }}</span>
                    @else
                        <strong>{{ $ride->seats_available - $ride->reservedamount()->sum('amount') }}</strong>
                    @endif
                @else
                    {{ $ride->seats_available }}
                @endif
                    / {{ $ride->seats_available }} {{ __('carpool.places-available') }}
            </div>
            <div class="tiny"></div>
            <div class="tiny grey">{{ $ride->luggage->name }}</div>
            @if(!empty($ride->remark))
                <div class="tiny">{{ $ride->remark }}</div>
            @endif

            @if($layout == 'header')
                @if($ride->group)
                    <a href="{{ url('/') }}/group/{{ $ride->group->token }}" class="ride-group ride-group-header tiny grey">{{ $ride->group->title }}</a>
                @endif
            @endif

        </div>

        <!-- extra's --->
        @if($layout == 'overview-listing')
            <div class="col-desk-12  text-right col-ride-edit-btns">
                    <div class="container-ride-edit-btns">
                        @guest
                            @if( $ride->seats_available - $ride->reservedamount()->sum('amount') > 0)
                                <a href="{{ url('/') }}/admin/carpool-reservation/ride/{{ $ride->id }}" class="button tiny bg-white">{{ __('carpool.make-reservation-btn') }}</a>
                            @else
                                <span class="tiny grey">{{ __('carpool.no-seat-available') }}</span>
                            @endif
                            <a href="{{ url('/') }}/admin/carpool-messages/ride/{{ $ride->id }}/sender/0" class="button tiny bg-white">{{ __('carpool.send-message-btn') }}</a>
                        @else
                            @if($ride->user_id == Auth::user()->id)
                                <a href="{{ url('/') }}/carpool/{{ $ride->id }}/edit" class="button tiny bg-white">{{ __('general.edit') }}</a>
                            @else
                                @if(in_array(Auth::user()->id, $ride->reservations->pluck('passenger_user_id')->toArray()))
                                    <span class="tiny">{{ __('carpool.reserved') }}</span>
                                @elseif( $ride->seats_available - $ride->reservedamount()->sum('amount') > 0)
                                    <a href="{{ url('/') }}/admin/carpool-reservation/ride/{{ $ride->id }}" class="button tiny bg-white">{{ __('carpool.make-reservation-btn') }}</a>
                                @else
                                    <span class="tiny grey">{{ __('carpool.no-seat-available') }}</span>
                                @endif
                                <a href="{{ url('/') }}/admin/carpool-messages/ride/{{ $ride->id }}/sender/{{ $ride->user_id }}" class="button tiny bg-white">{{ __('carpool.send-message-btn') }}</a>
                            @endif
                        @endif
                    </div>
            </div>
        @endif
    </div>

    @if($showReservations == 1)
        @if(count($ride->reservations) > 0)
            <div class="passenger-list">
                @if($layout == 'email-listing')
                    <table border="0" cellpadding="1" width="80%" style=" margin-left: auto; margin-right: auto;" style="color: rgb(169, 169, 169)">
                        @foreach($ride->reservations as $reservation)
                            <tr>
                                {{ $reservation->passenger->firstname }} {{ $reservation->passenger->lastname }}
                            </tr>
                            <tr>
                                {{ $reservation->amount }} {{ __('carpool.places-necessary') }}
                            </tr>
                            <tr>
                                @if($reservation->is_accepted == 1) <span class="green"><span class="heroicon heroicon-check-circle"></span> {{ __('carpool.is-accepted') }} </span> @endif
                                @if($reservation->is_rejected == 1) <span class="red"><span class="heroicon heroicon-x-circle"></span> {{ __('carpool.is-rejected') }} </span> @endif
                                @if($reservation->is_accepted == 0 && $reservation->is_rejected == 0) <span class="heroicon heroicon-archive"></span> {{ __('carpool.is-waiting') }} @endif
                            </tr>
                        @endforeach
                    </table>
                @else
                    <div class="grid">
                        @foreach($ride->reservations as $reservation)
                            <div class=" col-desk-3 col-mob-2 tiny passenger-list-name">
                                {{ $reservation->passenger->firstname }} {{ $reservation->passenger->lastname }}
                            </div>
                            <div class="col-desk-3 col-mob-2 tiny passenger-list-places">
                                {{ $reservation->amount }} {{ __('carpool.places-necessary') }}
                            </div>
                            <div class="col-desk-2 col-mob-2 tiny">
                                @if($reservation->is_accepted == 1) <span class="green"><span class="heroicon heroicon-check-circle"></span> {{ __('carpool.is-accepted') }} </span> @endif
                                @if($reservation->is_rejected == 1) <span class="red"><span class="heroicon heroicon-x-circle"></span> {{ __('carpool.is-rejected') }} </span> @endif
                                @if($reservation->is_accepted == 0 && $reservation->is_rejected == 0) <span class="heroicon heroicon-archive"></span> {{ __('carpool.is-waiting') }} @endif
                            </div>
                            <div class="col-desk-3 col-mob-2  tiny">
                                @if($showConversations == 1)
                                    @if($reservation->ride->user_id == Auth::user()->id)
                                        <a href="{{ url('/') }}/admin/carpool-messages/ride/{{ $reservation->ride_id }}/sender/{{ $reservation->passenger_user_id }}/" class=" tiny">
                                            {{ __('carpool.get-in-touch-with-passenger') }}
                                        </a>
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    </div> <!-- end grid -->
                @endif
            </div>
        @endif
    @endif


</div>
@endif
