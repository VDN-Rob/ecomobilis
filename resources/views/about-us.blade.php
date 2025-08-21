@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 text-center">
                <h1>{{ $page->title }}</h1>
            </div>
            @if(!empty($page->intro))
                <div class="col-desk-8 center-the-column" >
                    <h4>{{ $page->intro }}</h4>
                </div>
            @endif
        </div> <!--  grid -->
    </div>


    <div class="block">

        @include('_includes.page_blocks')

    </div> <!-- end block -->

@endsection
