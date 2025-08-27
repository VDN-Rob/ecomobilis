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
                <h1>{{ __('sharing.title') }}</h1>
            </div>
            <div class="col-desk-8 center-the-column" >
                <h4>{{ __('sharing.intro') }}</h4>
            </div>
        </div>
    </div>

    <!-- top block questionnaire / decision tree -->
    <div class="block">
        <div class="grid">
            <div class="col-desk-12 text-center">
                <h2>{{ __('sharing-decision-tree.title') }}</h2>
            </div>
            <div class="col-desk-12 text-center">
                <div class="box-with-border box extra-box-shadow" style="height: 300px;">
                    @include('web.sharing._include.questionnaire')
                </div>
            </div>
        </div>
    </div>

    <!--  block with live wire component -->
    @livewire('show-sharing-orgs')





@endsection
