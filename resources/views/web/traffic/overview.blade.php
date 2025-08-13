@extends('_layout.app')
@section('extraSeoTitle', __('public-general.seo-title-blog'))
@section('content')

    <style>
        figcaption {
            display: none;
        }
    </style>

    <!-- top block with first - paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 text-center">
                <h1>{{ __('traffic.title') }}</h1>
            </div>
        </div>

        <div class="col-desk-12">
            <div class="box box-with-border">
                <iframe src="https://telraam.net/en/network-embed/sem" width="100%" height="700px" border="1" frameborder="0" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>

    @include('_includes.traffic-volume-modes')


@endsection
