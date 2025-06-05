@extends('_layout.app')

@section('content')

    <div class="content ">

        <div class="ui grid block grid-with-row-margin">
            <div class="col-desk-8 center-the-column">


                <div class="box">

                    <h2 class="title-header">{{ __('auth.reset-your-mail-title) }}</h2>

                    <form method="POST" action="{{ route('password.update') }}" class="ui form">
                        @csrf
                        <div class="ui ">

                            <input type="hidden" name="token" value="{{ $requiredToken }}">

                            <div class="col-desk-12">
                                <div class="field special-placeholder">
                                    <label for="email" class="">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-desk-12">
                                <div class="field special-placeholder">
                                    <label for="password" class="">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-desk-12">
                                <div class="field special-placeholder">
                                    <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>


                           <div class="footer text-right">
                               <div class="col-desk-12">
                                    <div class=" wide column">
                                        <button type="submit" class="primary big button">
                                            {{ __('auth.reset-password') }}
                                        </button>
                                    </div>
                               </div>
                            </div>

                        </div> <!-- ui grid -->

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
