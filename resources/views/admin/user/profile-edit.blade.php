@extends('_layout.app')
@section('content')

<!-- ERROR AND SUCCESS MESSAGES -->
@include('_includes.notifications')

    <!-- top block with header -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>{{ $user->firstname }} {{ $user->lastname }}</h1>
            </div>
        </div> <!--  grid -->
    </div>

    <!-- top block with first paragraph -->
    {!! Form::model(null, array('method' => 'PUT', 'route' => ['admin.profileUpdate'], 'class' => 'ui form', 'files' => false)) !!}

        <div class="block extra-margin-bottom extra-padding-bottom">
            <div class="grid stackable grid-with-row-margin ">

                <div class="col-desk-6 ">
                    <div class="field special-placeholder">
                        <label>{{ __('user.first-name') }}</label>
                        <input id="firstname" type="text" class="{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname"  placeholder="firstname" value="{{ $user->firstname }}" required>
                    </div>
                </div>

                <div class="col-desk-6">
                    <div class="field special-placeholder">
                        <label>{{ __('user.last-name') }}</label>
                        <input id="lastname" type="text" class="{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname"  placeholder="lastname" value="{{ $user->lastname }}" required>
                    </div>
                </div>

                <div class="col-desk-6 ">
                    <div class="field special-placeholder">
                        <label>{{ __('user.gender') }}</label>
                        <select name="gender" id="gender">
                            <option value="" @if($user->gender !== 'F' && $user->gender !== 'M' && $user->gender !== 'X') selected @endif>-</option>
                            <option value="F" @if($user->gender == 'F') selected @endif>F</option>
                            <option value="M" @if($user->gender == 'M') selected @endif>M</option>
                            <option value="X" @if($user->gender == 'X') selected @endif>X</option>
                        </select>
                    </div>
                </div>

                <div class="col-desk-6 ">
                    <div class="field special-placeholder">
                        <label>{{ __('user.email') }}</label>
                        <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  placeholder="email" value="{{ $user->email }}" required>
                    </div>
                </div>

                <div class="col-desk-6 ">
                    <div class="field special-placeholder">
                        <label>{{ __('user.birth-date') }} <span class="grey tiny">{{ __('user.birth-date-min') }}</span></label>
                        <input id="birth_date" type="date" class="{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" name="birth_date" max="{{ $minDate }}" placeholder="" value="{{ $user->birth_date }}" required>
                    </div>
                </div>

                <div class="col-desk-6 ">
                    <div class="field special-placeholder">
                        <label>{{ __('user.phone-number') }}  <span class="grey tiny">{{ __('user.only-internal-use') }}</span></label>
                        <input id="phone_number" type="text" class="{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number"  placeholder="" value="{{ $user->phone_number }}" required>
                    </div>
                </div>

                <div class="col-desk-12 ">
                    <div class="field special-placeholder">
                        <label>{{ __('user.bio') }}</label>
                        <textarea id="bio" name="bio" placeholder="" rows="5" cols="33">{{ $user->bio }}</textarea>
                    </div>
                </div>

                <hr>

                @if(!isset($user->car))
                    <div class="col-desk-12 text-right"><div class="tiny button js-add-car-btn">+ {{ __('carpool.add-car-btn') }}</div></div>

                @endif

                {{-- ----------------------------------------------------------------------- --}}
                {{-- --------------------------------- CAR --------------------------------- --}}
                {{-- ----------------------------------------------------------------------- --}}

                <div class="col-desk-12 js-user-car-block"    @if(!isset($user->car)) style="display:none" @endif>
                    <div class="box box-with-border">
                        <div class="grid stackable grid-with-row-margin">
                            <div class="col-desk-12">
                                <strong>{{ __('carpool.car') }}</strong>
                            </div>


                            <div class="col-desk-6 ">
                                <div class="field special-placeholder">
                                    <label>{{ __('carpool.brand') }}</label>
                                    <input id="brand" type="text" class="{{ $errors->has('brand') ? ' is-invalid' : '' }}" name="brand" placeholder="" value="{{ $user?->car?->brand }}">
                                </div>
                            </div>

                            <div class="col-desk-6 ">
                                <div class="field special-placeholder">
                                    <label>{{ __('carpool.car_type') }}</label>
                                    <select name="car_type_id" id="car_type_id">
                                        @foreach($carTypes as $type)
                                            <option value="{{ $type->id }}" @if($user?->car?->car_type_id == $type->id) selected @endif>{{ $type->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-desk-6">
                                <label>{{ __('carpool.price_per_km') }}. <span class="tiny grey">{{ __('carpool.price_per_km_note') }}</span></label>
                                <div class="field special-placeholder">
                                    @if(isset($user->car))
                                        <input type="number" id="price_per_km_per_seat" name="price_per_km_per_seat" step="0.01"
                                               value="{{ $user?->car?->price_per_km_per_seat }}" lang="nl" style="width:90%"/> <span class="grey">€</span>
                                    @else
                                        <input type="number" id="price_per_km_per_seat" name="price_per_km_per_seat" step="0.01" value="0.10" lang="nl" style="width:90%"/> <span class="grey">€</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-desk-6 ">
                                <div class="field special-placeholder">
                                    <label>{{ __('carpool.luggage') }}</label>
                                    <select name="default_luggage_id" id="default_luggage_id">
                                        @foreach($carLuggages as $luggage)
                                            <option value="{{ $luggage->id }}" @if($user?->car?->default_luggage_id == $luggage->id) selected @endif >{{ $luggage->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-desk-6 ">
                                <div class="field special-placeholder">
                                    <label>{{ __('carpool.seats_available') }}</label>
                                    <select name="default_seats_available" id="default_seats_available">
                                        <option value="1" @if($user?->car?->default_seats_available == 1) selected @endif>1 siège</option>
                                        <option value="2" @if($user?->car?->default_seats_available == 2) selected @endif>2 sièges</option>
                                        <option value="3" @if($user?->car?->default_seats_available == 3) selected @endif>3 sièges</option>
                                        <option value="4" @if($user?->car?->default_seats_available == 4) selected @endif>4 sièges</option>
                                        <option value="5" @if($user?->car?->default_seats_available == 5) selected @endif>5 sièges</option>
                                        <option value="6" @if($user?->car?->default_seats_available == 6) selected @endif>6 sièges</option>
                                        <option value="7" @if($user?->car?->default_seats_available == 7) selected @endif>7 sièges</option>
                                        <option value="8" @if($user?->car?->default_seats_available == 8) selected @endif>8 sièges</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-desk-6 ">
                                <div class="field special-placeholder">
                                    <label>{{ __('carpool.description') }}</label>
                                    <input id="description" type="text" class="{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"  placeholder="" value="{{ $user?->car?->description }}">
                                </div>
                            </div>

                            <div class="col-desk-6 ">
                                <div class="field special-placeholder">
                                    <input class="form-check-input" type="checkbox" name="is_isofix_present" id="is_isofix_present" @if($user?->car?->is_isofix_present == 1) checked @endif >
                                    <label>{{ __('carpool.is_isofix_present') }}</label>
                                </div>
                            </div>

                            <div class="col-desk-6 ">
                                <div class="field special-placeholder">
                                    <input class="form-check-input" type="checkbox" name="is_smoking_allowed" id="is_smoking_allowed" @if($user?->car?->is_smoking_allowed == 1) checked @endif >
                                    <label>{{ __('carpool.is_smoking_allowed') }}</label>
                                </div>
                            </div>

                        </div> <!-- grid -->
                    </div> <!-- box -->
                </div> <!-- col-desk-12 -->

                <div class="col-desk-6 text-left">
                    <a href="{{ route('admin.profileDestroy', []) }}" class="tiny">{{ __('user.delete-account') }}</a>
                </div>
                <div class="col-desk-6 text-right">
                        <input type="submit" value="{{ __('general.save') }}"  class="button big" style="width: 200px">
                </div><!-- col-desk-12 -->

            </div> <!--  grid -->


        </div>

    {!! Form::close() !!}


    <script>
        $('.js-add-car-btn').click(function() {
            $('.js-add-car-btn').hide();
            $('.js-user-car-block').show();
        });

    </script>

@endsection
