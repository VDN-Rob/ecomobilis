@if($rideReservationSent)
    <div class="box box-with-border box-ride-confirm-reject extra-box-shadow">
        <div class="grid">
            <div class="col-desk-12 text-center">
                @if($rideReservationSent->is_accepted == 0 && $rideReservationSent->rejected == 0 && $rideReservationSent->ride->user_id == Auth::user()->id)
                        {!! Form::model(null, array('method' => 'POST', 'route' => ['admin.carpoolReservationConfirmRejectStore', $rideReservationSent->id], 'class' => 'ui form', 'files' => false)) !!}
                            <input class="button big" name="submit" type="submit" value="{{ __('carpool.reject-btn') }}" style="width: 200px; display: inline-block">
                            <input class="button big bg-white" name="submit" type="submit" value="{{ __('carpool.confirm-btn') }}"  style="width: 200px; display: inline-block">
                        {!! Form::close() !!}
                @else
                    @if($rideReservationSent->is_accepted == 1) <span class="green"><span class="heroicon heroicon-check-circle"></span> {{ __('carpool.is-accepted') }} </span> @endif
                    @if($rideReservationSent->is_rejected == 1) <span class="red"><span class="heroicon heroicon-x-circle"></span> {{ __('carpool.is-rejected') }} </span> @endif
                    @if($rideReservationSent->is_accepted == 0 && $rideReservationSent->is_rejected == 0) <span class="heroicon heroicon-archive"></span> {{ __('carpool.is-waiting') }} @endif
                @endif
            </div>
        </div>
    </div>
@else
    @isset($ride)
        @if($ride->user->id !== Auth::user()->id)
            <div class="box box-with-border box-ride-confirm-reject">
                <div class="grid">
                    <div class="col-desk-12 text-center">
                        <a href="{{ url('/') }}/admin/carpool-reservation/ride/{{ $ride->id }}" class="button tiny bg-white">{{ __('carpool.make-reservation-btn') }}</a>
                    </div>
                </div>
            </div>
        @endif
    @endisset
@endif
