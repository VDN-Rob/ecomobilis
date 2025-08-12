@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block-wide headerpic-container">
        <div class=" headerpic" style="background-image: url(/images/header/header-image-v2.png);">
            <div class="block">
                <div class="headerpic-text-block">
                    <div class="grid grid-with-row-margin stackable">
                        <div class="col-desk-5   col-tab-6 col-tab-shift-0   extra-margin-top text-left">
                            <h1>Consectetur adipiscing elit</h1>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor<br>
                            incididunt ut labore et dolore magna aliqua.<br>
                        </div>
                    </div> <!-- grid -->
                </div>
            </div>

        </div> <!-- headerpic -->
    </div>

    <!--  block with search -->
    @include('_includes.carpool-search')

    <!--  block with traffic: map, list,... -->
    <div class="block extra-margin-top">
        <div class="grid grid-with-row-margin stackable">
            <div class="col-desk-12 text-center">
                <h2>{{ __('public-homepage.traffic-title') }}</h2>
                {{ __('public-homepage.traffic-subtitle') }}
            </div>
            <div class="col-desk-3">
                @include('_includes.traffic-volume-overview')
            </div>
            <div class="col-desk-9">
                <div class="center-next-to-photo">
                    <iframe src="https://telraam.net/en/network-embed/sem" width="100%" height="700px" border="1" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>

            @include('_includes.traffic-volume-modes')

        </div> <!-- end grid -->
    </div> <!-- end block -->

    <div class="block">
        <div class="grid grid-with-row-margin stackable center-vertical-and-horizontal">
            <div class="col-desk-7">
                <div class="center-next-to-photo">
                    <h2>
                        Lorem ipsum dolor sit amet?
                    </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt
                        in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <br>
                    <a href="#">Exercitation ullamco laboris nisi ut aliquip</a></p>
                </div>
            </div>
            <div class="col-desk-5  text-center">
                <img src="{{ url('/') }}/images/photos/egor-myznik-5fuL1om_sc8-unsplash.jpg" class="size-90 rounded" style="margin-top:10px; margin-left: 15%;">
            </div>
        </div>
    </div>


@endsection
