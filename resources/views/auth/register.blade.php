@extends('_layout.app')

@section('content')

<!-- ERROR AND SUCCESS MESSAGES -->
@include('_includes.notifications')

    <div class="content">
        <div class="block block-narrow">
            <div class="grid grid-with-row-margin">
                <div class="col-desk-12 text-center">
                    <h3>{{ __('register.title') }}</h3>
                </div>
                <div class="col-desk-12 text-center">
                    {!! __('register.intro')  !!}
                </div>
            </div>
        </div>

        <div class="block block-narrow no-top-padding">
            <div class="box light-grey-bg">
                <div class="grid grid-with-row-margin stackable">

                    <form method="POST" action="{{ route('register', App::getLocale()) }}" class="ui form grid">
                        @csrf

                        <div class="col-desk-6 ">

                            <div class="field special-placeholder">

                                <label for="firstname">{{ __('register.first-name') }}</label>
                                <input id="firstname" type="text"
                                       class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                       name="firstname" placeholder="{{ __('register.first-name') }}"
                                       value="{{ old('firstname') }}"
                                       required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
										  <strong>{{ $errors->first('firstname') }}</strong>
									  </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-desk-6 ">
                            <div class="field special-placeholder">

                                <label for="lastname">{{ __('register.last-name') }}</label>
                                <input id="lastname" type="text"
                                       class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                       name="lastname" placeholder="{{ __('register.last-name') }}"
                                       value="{{ old('lastname') }}"
                                       required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
										  <strong>{{ $errors->first('lastname') }}</strong>
									  </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-desk-12 ">
                            <div class="field special-placeholder">

                                <label for="email">{{ __('register.email') }}</label>
                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" placeholder="{{ __('register.email') }}"
                                       value="@if (!empty($preselector)){{ $preselector->email }}@elseif(!empty($email)){{ $email }}@else{{ old('email') }}@endif"
                                       required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
										  <strong>{{ $errors->first('email') }}</strong>
									  </span>
                                @endif
                            </div>
                        </div>

                        <hr class="address-block">

                        <div class="col-desk-12 ">

                            <div class="field special-placeholder">
                                <label for="password">{{ __('register.password') }}</label>
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       placeholder="{{ __('register.password') }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
											  <strong>{{ $errors->first('password') }}</strong>
										  </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-desk-12 ">
                            <div class="field special-placeholder">
                                <label for="password-confirm">{{ __('register.password-confirmation') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation"
                                       placeholder="{{ __('register.password-confirmation') }}" required>

                            </div>
                        </div>

                        <div class="col-desk-12 ">
                            <div class="field special-placeholder">
                                <div class="field">
                                    <label class="normal">
                                        {{ Form::checkbox('has_agreed_privacy_policy', null,null, array('id'=>'privacy-checkbox', 'required')) }}
                                        {!! __('register.privacy-checkbox') !!}
                                    </label>
                                </div>
                                <div class="field">
                                    <label class="normal">
                                        {{ Form::checkbox('has_agreed_terms', null,null, array('id'=>'termscheckbox', 'required')) }}
                                        {!! __('register.terms-checkbox') !!}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="timezone"  class="" name="timezone"  value="" required>

                        {!! Honeypot::generate('my_name', 'my_time_honeypot') !!}

                        <button id="register-submit-btn" type="submit" class="big button primary">
                            {{ __('register.register') }}
                        </button>

                    </form>
                </div> <!-- end box -->
            </div> <!-- end grid -->
        </div> <!-- end block -->
    </div> <!-- end content -->
@endsection
