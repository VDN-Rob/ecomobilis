@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>{{ __('carpool.edit-a-ride') }}</h1>
                @if(isset($group))
                    <h2>{{ $group->title }}</h2>
                    @if($group->rides_are_private == 1) <span class="grey">{{ __('carpool.rides-are-private') }}</span> @endif
                @endif
            </div>
        </div> <!--  grid -->
    </div>

    <!--  block with form fields -->
    <div class="block">
        <div class="box light-grey-bg">
                {!! Form::model(null, array('method' => 'PUT', 'route' => ['web.carpoolUpdate', $ride->id], 'class' => 'ui form', 'files' => false)) !!}
                    @include('_includes.carpool-add-edit')
                {!! Form::close() !!}
            </div>
        </div> <!-- end box -->
    </div>


@endsection
