@extends('_layout.app')
@section('content')

    <!-- ERROR AND SUCCESS MESSAGES -->
    @include('_includes.notifications')

    <!-- top block with title -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>{{ $group->title }}</h1>
            </div>
        </div> <!--  grid -->
    </div>

    <!-- top block with first paragraph -->
    {!! Form::model($group, array('method' => 'DELETE', 'route' => ['admin.carpoolGroupsDestroy', ['id' => $group->id]], 'class' => 'ui form', 'files' => false)) !!}

    <div class="block extra-margin-bottom extra-padding-bottom">
        <div class="box light-grey-bg">
            <div class="grid grid-with-row-margin ">

                <div class="col-desk-12">
                    <strong>{{ $group->title }}</strong>
                </div>
                <div class="col-desk-12">
                    <strong>{{ $group->location->city }}</strong><br>
                    <div class="tiny">{{ $group->location->street }}</div>
                </div>
                <div class="col-desk-3">
                    <a href="{{ url('/') }}/group/{{ $group->token }}" target="_blank"><span class="heroicon heroicon-external-link"></span> {{ __('carpool.public_url') }}</a><br>
                </div>
                <div class="col-desk-9">
                    {{ $group->rides->count() }} {{ __('carpool.rides') }}
                </div>

                <div class="col-desk-12 text-right">
                    @if($group->rides->count() == 0)
                        <input type="submit" value="{{ __('general.delete') }}" class="button big red" style="width: 200px">
                    @else
                        <input type="submit" value="{{ __('general.delete') }}" class="button big red disabled" style="width: 200px">
                    @endif
                </div><!-- col-desk-12 -->

            </div> <!--  grid -->
        </div>
    </div>

    {!! Form::close() !!}

@endsection
