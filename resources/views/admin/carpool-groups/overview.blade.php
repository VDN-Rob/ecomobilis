@extends('_layout.app')
@section('content')

    <!--  block with search -->
    @include('admin._includes.sub-navigation')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1> {{ __('carpool.group-overview-title') }}</h1>
            </div>
            <div class="col-desk-12 ">
                <a href="{{ url('/') }}/admin/carpool-groups/add" class="button"> {{ __('carpool.add-a-group-btn') }}</a>
            </div>
        </div> <!--  grid -->
    </div>

    <div class="block">
        <div class="grid stackable grid-with-row-margin">
            @foreach($groups as $group)
                <div class="col-desk-3">
                    <strong>{{ $group->title }}</strong>
                </div>
                <div class="col-desk-3">
                    <strong>{{ $group->location->city }}</strong><br>
                    <div class="tiny">{{ $group->location->street }}</div>
                </div>
                <div class="col-desk-3">
                    <a href="{{ url('/') }}/group/{{ $group->token }}" target="_blank">{{ __('carpool.public_url') }}</a>
                </div>
                <div class="col-desk-3">
                    <a href="{{ url('/') }}/admin/carpool-groups/{{ $group->id }}/edit" class="button tiny">{{ __('general.edit') }}</a>
                </div>
            @endforeach
        </div> <!--  grid -->
    </div>

@endsection
