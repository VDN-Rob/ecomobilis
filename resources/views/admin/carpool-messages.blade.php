@extends('_layout.app')
@section('content')

    <!--  block with search -->
    @include('admin._includes.sub-navigation')

    <!--  block with live wire component -->
    @livewire('show-messages', ['currentPartnerUserId' => $currentPartnerUserId, 'currentCarRideId' => $currentCarRideId])

@endsection
