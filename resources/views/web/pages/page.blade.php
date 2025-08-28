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
        <div class="grid stackable">
            <div class="col-desk-12 text-center">
                <h1>{{ $page->title }}</h1>
            </div>
            @if(!empty($page->intro))
                <div class="col-desk-8 center-the-column" >
                    <h4>{{ $page->intro }}</h4>
                </div>
            @endif
        </div>
    </div>

    <div class="block block-narrow  center">
        <div class="grid centered stackable">
            <div class="col-desk-10 center-the-column text-center">
                <div class="blog-image text-center" >
                    @if (isset($page->cover_image))
                        <img src="https://admin.ecomobilis.be/storage/{{ $page->cover_image }}" style="margin:0 auto;">
                    @endif
                </div>
            </div>
        </div>
    </div> <!-- end block -->

    <div class=" block block-narrow  center">
        <div class="ui grid centered stackable">
            <div class="col-desk-10 center-the-column">
                 {!! $page->body !!}
            </div>
        </div> <!-- end grid -->
    </div> <!-- end block -->

    <div class=" block block-narrow  center">
        <div class="ui grid centered stackable">
            <div class="col-desk-10 center-the-column">
                {!! $page->body !!}
            </div>
        </div> <!-- end grid -->
    </div> <!-- end block -->

    @include('_includes.page_blocks')


@endsection
