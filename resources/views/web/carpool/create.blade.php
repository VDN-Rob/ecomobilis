@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>{{ __('carpool.add-a-ride') }}</h1>
                @if(isset($group))
                    <h2>{{ $group->title }}</h2>
                @endif
            </div>
        </div> <!--  grid -->
    </div>

    <!--  block with form fields -->
    <div class="block">

        <div class="box light-grey-bg">
            {!! Form::model(null, array('method' => 'POST', 'route' => ['web.carpoolStore'], 'class' => 'ui form', 'files' => false)) !!}
                @include('_includes.carpool-add-edit')
            {!! Form::close() !!}
        </div> <!-- end box -->
    </div>


@endsection
