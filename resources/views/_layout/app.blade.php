<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta Data -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Meta Data for CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=DM+Mono:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" sizes="any" />
    <link rel="icon" href="/icon.svg" type="image/svg+xml" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/manifest.webmanifest" />

    <!-- 1. libraries -->
    <!-- autocomplete -->
    <script src="https://unpkg.com/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/@tarekraafat/autocomplete.js@10.2.9/dist/css/autoComplete.01.css">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- 2. custom -->
    <script defer data-domain="ecomobilis.be" src="https://plausible.io/js/script.js"></script>

    <!-- css via laravel mix  -->
    <link href="{{ asset('css/app.css?v=13') }}" rel="stylesheet">

    <!-- Scripts via laravel mix  -->
    <script src="{{ asset('js/main.js?v=7') }}" defer></script>


</head>
<body id="body" class="website {{ Route::current()->getName() }}" data-locale="{{ Config::get('app.locale') }}">

<!-- TOPBAR -->
<header class="header">
    <div class="block">
        <!-- TOPBAR #1 -->
        <nav class="small-top-nav show-on-desktop-only">
            <div class="nav__container">
                <div class="side-head">
                    <ul>
                        @include('_layout.nav-web-top')
                    </ul>
                </div> <!-- side head -->
            </div> <!-- nav container -->
        </nav>
        <!-- TOPBAR #2 BIG -->
        <nav class="main-nav">
            <div class="nav__container">
                <div class="side-head">
                    <div class="brand-logo-svg-container hide-on-mobile-only">
                        <div class="brand-logo-svg small"><a href="{{ url('/') }}" style="background-image: url(/images/common/logo.svg);"></a></div>
                    </div>
                    <ul>
                        @include('_layout.nav-web-main')
                    </ul>
                </div> <!-- side head -->
            </div> <!-- nav container -->
        </nav>
    </div>
</header>


<div class="header-mobile show-on-mobile-only">
    <div class="brand-logo-svg-container">
        <div class="brand-logo-svg small"><a href="{{ url('/') }}" class="" style="background-image: url(/images/common/logo.svg);"></a></div>
    </div>
</div>

<div class="m-menu">
    <button class="mm"></button>
</div>

<!-- ERROR AND SUCCESS MESSAGES -->
@include('_includes.notifications')


<div class="container">
    @yield('content')
</div>

@include('_layout.footer')

</body>
</html>
