@extends('_layout.app')
@section('content')

    <!--  block with search -->
    @include('admin._includes.sub-navigation')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>{{ __('carpool.group-overview-title') }}</h1>
            </div>
            <div class="col-desk-12 ">
                <a href="{{ url('/') }}/admin/carpool-groups/add" class="button"> {{ __('carpool.add-a-group-btn') }}</a>
            </div>
        </div> <!--  grid -->
    </div>

    <div class="block">
        <div class="grid stackable grid-with-row-margin">
            @foreach($groups as $group)
                <div class="col-desk-4">
                    <strong>{{ $group->title }}</strong><br>
                    @if($group->is_archived == 1) <div class="tiny"><span class="heroicon heroicon-archive"></span> {{ __('carpool.group-is-archived') }}</div> @endif
                    @if($group->rides_are_private == 1) <div class="grey tiny"><span class="heroicon heroicon-lock-closed"></span> {{ __('carpool.rides-are-private') }}</div> @endif
                </div>
                <div class="col-desk-3">
                    <strong>{{ $group->location->city }}</strong><br>
                    <div class="tiny">{{ $group->location->street }}</div>
                </div>
                <div class="col-desk-2">
                    <a href="{{ url('/') }}/group/{{ $group->token }}" target="_blank"><span class="heroicon heroicon-external-link"></span> {{ __('carpool.public_url') }}</a><br>
                    <div class="tiny grey">{{ $group->rides->count() }} {{ __('carpool.rides') }}</div>
                </div>
                <div class="col-desk-1">
                    <a href="{{ url('/') }}/admin/carpool-groups/{{ $group->id }}/edit" class="button tiny">{{ __('general.edit') }}</a>
                </div>
                <div class="col-desk-2">

                    <div class="dropdown tiny">
                        <button class="button">{{ __('general.more') }}</button>
                        <div class="dropdown-content">
                            @if($group->rides->count() == 0)
                                <a href="{{ url('/') }}/admin/carpool-groups/{{ $group->id }}/delete" class="">{{ __('general.delete') }}</a>
                            @else
                                <a href="#" class="disabled">{{ __('general.delete') }}</a>
                            @endif
                            @if($group->is_archived == 1)
                                <a href="{{ url('/') }}/admin/carpool-groups/{{ $group->id }}/unarchive" class="">{{ __('general.unarchive') }}</a>
                            @else
                                <a href="{{ url('/') }}/admin/carpool-groups/{{ $group->id }}/archive" class="">{{ __('general.archive') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-desk-3">

                </div>
            @endforeach
        </div> <!--  grid -->
    </div>

@endsection
