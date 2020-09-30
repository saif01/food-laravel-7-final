<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.icon')
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('all-assets/common/bootstrap-4.5/css/bootstrap.min.css') }}">

    <style>
        .container, .row {
            height: 100%;
            min-height: 100%;
        }

        html, body {
            height: 100%;
        }

    </style>

    @yield('page-css')


</head>
<body>
    <div class="container">

        @yield('content')

    </div>
    {{-- <script src="{{ asset('all-assets/common/bootstrap-4.5/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/popper.min.js') }}"></script>
    <script src="{{ asset('all-assets/common/bootstrap-4.5/js/bootstrap.min.js') }}"></script> --}}

    @yield('page-js')
</body>
</html>
