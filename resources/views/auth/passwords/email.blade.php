@extends('_layout.app')

@section('content')

<div class="content">

        <div class="block block-narrow">
            <div class="grid grid-with-row-margin">
                <div class="col-desk-12 text-center">
                    <h3>{{ __('auth.reset-your-mail-title') }}</h3>
                </div>

                <div class="col-desk-12 text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div> <!-- end grid -->
        </div> <!-- end block -->

        <div class="block block-narrow">
            <div class="box light-grey-bg">
                <form method="POST" action="{{ route('password.email', App::getLocale()) }}" class="ui form">
                <div class="grid grid-with-row-margin">

                        @csrf
                        <div class="col-desk-12">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ old('email') }}" placeholder="E-mail" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                        </div>
                        <div class="col-desk-12 text-right">
                            <button type="submit" class="ui primary big button">
                                {{ __('auth.send-password-link') }}
                            </button>
                        </div>

                </div> <!-- end grid -->
                </form>
            </div> <!-- end box -->


        </div> <!-- end block -->

</div> <!-- end content -->

@endsection

