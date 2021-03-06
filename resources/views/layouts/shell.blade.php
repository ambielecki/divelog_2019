<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'DiveLogRepeat')</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<link rel='icon' href='/images/favicon.ico'>--}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/main.css') }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    {{-- For page specific css --}}
    @stack('head_scripts')
</head>

<body class="blue lighten-5">
    @yield('layout')
    <script src="{{ mix('/js/vendor.js') }}"></script>
    <script src="{{ mix('/js/main.js') }}"></script>
    @stack('body_scripts')
</body>
</html>
