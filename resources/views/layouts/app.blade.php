<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--csrf token--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Scott Blog')</title>

    {{--styles--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    <div class="container">
        @include('layouts._message')
        @yield('content')
    </div>

    @include('layouts._footer')
</div>


{{--scripts--}}
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
</body>
</html>
