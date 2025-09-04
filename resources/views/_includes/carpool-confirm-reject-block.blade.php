@if($rideReservationSent)
    <div class="box box-with-border box-ride-confirm-reject extra-box-shadow text-center">
        @if($rideReservationSent->is_accepted == 0 && $rideReservationSent->rejected == 0 && $rideReservationSent->ride->user_id == Auth::user()->id)
                {!! Form::model(null, array('method' => 'POST', 'route' => ['admin.carpoolReservationConfirmRejectStore', $rideReservationSent->id], 'class' => 'ui form', 'files' => false)) !!}
                    <input class="button big" name="submit" type="submit" value="{{ __('carpool.reject-btn') }}" style="width: 200px; display: inline-block">
                    <input class="button big bg-white" name="submit" type="submit" value="{{ __('carpool.confirm-btn') }}"  style="width: 200px; display: inline-block">
                {!! Form::close() !!}
        @else
            @if($rideReservationSent->is_accepted == 1) <span class="green"><span class="heroicon heroicon-check-circle"></span> {{ __('carpool.is-accepted') }} </span> @endif
            @if($rideReservationSent->is_rejected == 1) <span class="red"><span class="heroicon heroicon-x-circle"></span> {{ __('carpool.is-rejected') }} </span> @endif
            @if($rideReservationSent->is_accepted == 0 && $rideReservationSent->is_rejected == 0) <span class="heroicon heroicon-archive"></span> {{ __('carpool.is-waiting') }} @endif
            @if($rideReservationSent->is_rejected == 0 && $ride->user->id !== Auth::user()->id)
                <a href="#" class="tiny js-open-modal" data-modal="modalCancelRequest">{{ __('carpool.cancel-request-btn') }}</a>
            @endif
        @endif
    </div>
@else
    @isset($ride)
        @if($ride->user->id !== Auth::user()->id)
            <div class="box box-with-border box-ride-confirm-reject text-center">
                  <a href="{{ url('/') }}/admin/carpool-reservation/ride/{{ $ride->id }}" class="button tiny bg-white">{{ __('carpool.make-reservation-btn') }}</a>
            </div>
        @endif
    @endisset
@endif





@if(isset($rideReservationSent))
    <div class="modal" id="modalCancelRequest">
        {!! Form::model(null, array('method' => 'POST', 'route' => ['admin.carpoolReservationCancelStore', $rideReservationSent->id], 'class' => 'ui form', 'files' => false)) !!}
            <div class="modal-header-content">
                <span class="close js-close-modal"></span>
                <div class="modal-header">
                    <h3>{{ __('carpool.modal-ride-request-cancel-title') }}</h3>
                </div>
                <div class="modal-content ">
                    <div class="grid grid-with-row-margin">
                        <div class="col-desk-12">
                            {{ __('carpool.modal-ride-request-cancel-body') }}<br>
                            <br>
                        </div>
                    </div>

                    <div class="footer extra-margin-top text-right">
                        <div class="js-close-modal big button">
                            {{ __('carpool.modal-ride-request-cancel-btn') }}
                        </div>
                        <button class="big red button primary">
                            {{ __('carpool.modal-ride-request-ok-btn') }}
                        </button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endif
