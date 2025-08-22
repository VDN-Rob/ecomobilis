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
        @if($ride->is_cancelled == 0)
        <div class="box light-grey-bg">
                {!! Form::model(null, array('method' => 'PUT', 'route' => ['web.carpoolUpdate', $ride->id], 'class' => 'ui form', 'files' => false)) !!}
                    @include('_includes.carpool-add-edit')
                {!! Form::close() !!}
            </div>
        </div> <!-- end box -->
        @else
            <div class="box red">
                Le trajet est annulé.
            </div>
        @endif
    </div>




@if(isset($ride))
    <div class="modal" id="modalCancelRide">
        {!! Form::model(null, array('method' => 'POST', 'route' => ['web.carpoolCancel', $ride->id], 'class' => 'ui form', 'files' => false)) !!}
        <div class="modal-header-content">
            <span class="close js-close-modal"></span>
            <div class="modal-header">
                <h3>{{ __('carpool.modal-ride-cancel-title') }}</h3>
            </div>
            <div class="modal-content ">

                <div class="grid grid-with-row-margin">
                    <div class="col-desk-12">
                        {{ __('carpool.modal-ride-cancel-body') }}<br>
                        <br>
                    </div>
                </div>

                <div class="footer extra-margin-top text-right">
                    <div class="js-close-modal big button">
                        {{ __('carpool.modal-ride-cancel-btn') }}
                    </div>
                    <button class="big red button primary">
                        {{ __('carpool.modal-ride-ok-btn') }}
                    </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endif



<script>
    $( "#openInviteModal" ).click(function() {
        $('.ui.modal').modal('show');
    });
</script>



@endsection
