@extends('_layout.app')
@section('content')

    <!-- top block with first paragraph -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 ">
                <h1>FAQ</h1>
            </div>
        </div> <!--  grid -->
    </div>

    <div class="block">
        <div class="col-desk-12 accordion">
            @foreach($faq as $item)
                <details>
                    <summary class="faq-title">{{ $item->question }} <div class="label grey text-right tiny">{{ $item->category }}</div></summary>
                    <div class="faq-content">{!! nl2br($item->answer) !!}</div>
                </details>
            @endforeach
        </div>
    </div>

@endsection
