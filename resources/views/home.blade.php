@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block-wide headerpic-container">
        <div class=" headerpic" style="background-image: url(https://admin.ecomobilis.be/storage/{{ $page->cover_image }});">
            <div class="block">
                <div class="headerpic-text-block">
                    <div class="grid grid-with-row-margin stackable">
                        <div class="col-desk-5   col-tab-6 col-tab-shift-0   extra-margin-top text-left">
                            <h1>{{ $page->title }}</h1>
                            @if(!empty($page->intro))
                                {{ $page->intro }}</h4>
                            @endif
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
                {!! __('public-homepage.traffic-subtitle')  !!}
            </div>
            <div class="col-desk-3">
                <iframe src="https://telraam.net/fr/network-embed-segment-data/sem" width="100%" height="700px" border="0" frameborder="0"  style="border:0"></iframe>
            </div>
            <div class="col-desk-9">
                <div class="center-next-to-photo">
                    <iframe src="https://telraam.net/fr/network-embed/sem" width="100%" height="700px" border="1" frameborder="0" allowfullscreen=""></iframe>
                </div>
            </div>

        </div> <!-- end grid -->
    </div> <!-- end block -->


    <div class="block">
            @include('_includes.page_blocks')
    </div> <!-- end block -->


@endsection
