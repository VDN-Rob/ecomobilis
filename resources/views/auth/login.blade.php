@extends('_layout.app')

@section('content')


<div class="content">

    <div class="block block-narrow">

        <div class="ui grid grid-with-row-margin">

            <div class="col-desk-12 text-center">
                <h3>{{ __('auth.login') }}</h3>
            </div>

            <div class="col-desk-12 text-center">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="warning">:message</div>')) !!}
                @endif
            </div>
        </div>
    </div>

    <div class="block block-narrow">

            <div class="box light-grey-bg">

                <div class="ui grid grid-with-row-margin">

                <div class="col-desk-12">

                    <form method="POST" action="{{ route('login', app()->getLocale()) }}" class="ui form">
                        @csrf
                        <div class="grid ">


                            <div class="col-desk-12 ">
                                <div class="field special-placeholder">
                                    <label>E-mail</label>
                                    <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  placeholder="Email" value="{{ old('email') }}" required>
                                </div>
                            </div>


                            <div class="col-desk-12">
                                <div class="field special-placeholder">

                                    <label>{{ __('auth.your-password') }}</label>
                                    <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('auth.your-password') }}" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                 </div>
                            </div>


                            <div class="col-desk-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('auth.remember-me') }}
                                    </label>
                                </div>
                            </div>

                                <div class="col-desk-12 text-right">
                                    {!! Form::hidden('device',  app('request')->input('device') ) !!}

                                    <a class="tiny" href="{{ route('password.request', App::getLocale()) }}">{{ __('auth.forgot-password') }}</a>
                                    &nbsp; &nbsp;
                                    <button type="submit" class="big primary button">
                                        {{ __('auth.login') }}
                                    </button>


                                </div>
                        </div>
                    </form>

                </div> <!-- end box -->

        </div> <!-- end grid -->
</div> <!-- end content -->
@endsection
