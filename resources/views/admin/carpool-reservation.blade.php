@extends('_layout.app')
@section('content')

    <!-- top block with header -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>{{ __('carpool.reserve-title') }}</h1>
            </div>
        </div> <!--  grid -->
    </div>

    <div class="block">
        <div class="grid grid-with-row-margin stackable">
            <div class="col-desk-8 center-the-column ">
                {{ __('carpool.reserve-intro') }}
                <br><br>
                @include('_includes.carpool-ride-block', ['layout' => 'header', 'showReservations' => 0, 'showConversations' => 0])
                <br><br>
                @if($ride->user_id !== Auth::user()->id)
                    {!! Form::model(null, array('method' => 'POST', 'route' => ['admin.carpoolReservationStore', $ride->id, Auth::user()->id], 'class' => 'ui form', 'files' => false)) !!}

                        <div class="grid grid-with-row-margin">
                            <div class="col-desk-4">
                                <div class="tiny light-grey" style="position: absolute; margin-top: -20px;">Nombre de sièges</div>
                                <div class="field special-placeholder">
                                    <select name="amount" id="amount">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-desk-6">
                                 <input class="button big" name="submit" type="submit" value="{{ __('carpool.reserve-btn') }}" class="primary" style="width:280px; ">
                            </div>
                        </div>
                    {!! Form::close() !!}
                @else
                    <div class="red">Vous ne pouvez pas faire de réservation pour votre propre trajet.</div>
                @endif

            </div>
        </div> <!--  grid -->
    </div>

@endsection
