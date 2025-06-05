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
                <h1>{{ $blog->title }}</h1>
            </div>

            <div class="col-desk-12 text-center">
                <h4>{{ $blog->topic }} -
                    Rédigé par {{ $blog->user->firstname }} {{ $blog->user->lastname }}
                    {{ $blog->date_posted->format(' j F Y') }}
                </h4>

            </div>

        </div>
    </div>

    <div class="block block-narrow text-center ">
        <div class="grid">
            <div class="col-desk-10 " style="margin: 0 auto;">
                <div class="intro-text">
                     {{ $blog->intro }}
                </div>
            </div>
        </div> <!-- ui grid -->
    </div>

    <div class=" block block-narrow  center">
        <div class="ui grid centered stackable">
            <div class="col-desk-10 center-the-column text-center">
                <div class="blog-image text-center" >
                    @if (isset($blog->cover_image))
                        <img src="https://ecomobilis-admin.test/storage/{{ $blog->cover_image }}" style="margin:0 auto;">
                    @endif
                </div>
            </div>
        </div>
    </div> <!-- end block -->

    <div class=" block block-narrow  center">
        <div class="ui grid centered stackable">
            <div class="col-desk-10 center-the-column">
                    {!! $blog->body !!}
            </div>
        </div> <!-- end grid -->
    </div> <!-- end block -->



@endsection
