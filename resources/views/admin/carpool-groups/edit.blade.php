@extends('_layout.app')
@section('content')

    <!-- ERROR AND SUCCESS MESSAGES -->
    @include('_includes.notifications')

    <!-- top block with title -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1> {{ __('carpool.group-edit-title') }}</h1>
            </div>
        </div> <!--  grid -->
    </div>

    <!-- top block with first paragraph -->
    {!! Form::model($group, array('method' => 'PUT', 'route' => ['admin.carpoolGroupsUpdate', ['id' => $group->id]], 'class' => 'ui form', 'files' => false)) !!}

    <div class="block extra-margin-bottom extra-padding-bottom">
        <div class="box light-grey-bg">
            <div class="grid grid-with-row-margin ">

                @include('admin.carpool-groups.includes.add-edit')

                <div class="col-desk-12 text-right">
                    <input type="submit" value="{{ __('general.save') }}" class="button big" style="width: 200px">
                </div><!-- col-desk-12 -->

            </div> <!--  grid -->
        </div>
    </div>

    {!! Form::close() !!}

@endsection
