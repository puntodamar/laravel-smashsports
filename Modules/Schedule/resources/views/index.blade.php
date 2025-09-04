<!doctype html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite('resources/js/app.js') {{-- keep the global entry --}}
{{--    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" sizes="any">--}}
{{--    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/svg+xml">--}}
{{--    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.ico') }}">--}}

    <link rel="icon" type="image/png" href="{{asset('favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{asset('favicon.svg')}}" />
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}" />
    <link rel="manifest" href="{{asset('site.webmanifest')}}" />
    @inertiaHead
</head>
<body class="antialiased">
    @inertia
</body>
</html>
