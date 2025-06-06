@extends('_layout.app')
@section('extraSeoTitle', __('public-general.seo-title-blog'))
@section('content')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>Blog</h1>
            </div>
        </div> <!--  grid -->
    </div>


    <div class="block">
        <div class="grid  stackable">

            @foreach ($blogs as $blog)
                <div class="col-desk-6">
                    <div class="box blog-post-box">
                        <a class="blog-post" href="{{ url('/') }}/blog/{{ $blog->slug }}">
                            <div class="blog-image">
                                @if (isset($blog->cover_image))
                                    <img src="https://admin.ecomobilis.be/storage/{{ $blog->cover_image }}" style="margin:0 auto;">
                                @endif
                            </div>
                            <div class="title">
                                <h2>{{ $blog->title }}</h2>
                                <h4>{{ $blog->topic }}</h4>
                            </div>
                            <div class="intro ">
                                {{ $blog->intro }}
                            </div>
                            <div class="meta">
                                <div class="tiny">
                                    @if (App::getLocale() == 'fr') Rédigé par @endif
                                    {{ $blog->user->firstname }} {{ $blog->user->lastname }}
                                    {{ $blog->date_posted->format(' j F Y') }}
                                </div>
                            </div>
                        </a>
                    </div> <!-- end box -->
                </div>
            @endforeach

        </div> <!--  grid -->
    </div>



@endsection
