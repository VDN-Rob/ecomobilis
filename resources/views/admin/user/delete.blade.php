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
    {!! Form::model(null, array('method' => 'DELETE', 'route' => ['admin.profileDestroy'], 'class' => 'ui form', 'files' => false)) !!}

    <div class="block extra-margin-bottom extra-padding-bottom">
        <div class="grid grid-with-row-margin ">

            <div class="box warning" style="width: 100%;">
                <span class="red"><span class="heroicon heroicon-exclamation"></span> {{ __('user.delete-waring') }}</span>
            </div>

            <div class="col-desk-12 text-right">
                <input type="submit" value="{{ __('general.delete') }}"  class="button big warning" style="width: 200px">
            </div><!-- col-desk-12 -->

        </div> <!--  grid -->


    </div>

    {!! Form::close() !!}


@endsection
