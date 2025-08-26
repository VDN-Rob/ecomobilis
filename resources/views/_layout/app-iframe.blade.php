<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="{{ asset('css/app.css?v=13') }}" rel="stylesheet">

</head>
<body id="body" class="website" data-locale="{{ Config::get('app.locale') }}">

<div class="container">
    @yield('content')
</div>

</body>
</html>
