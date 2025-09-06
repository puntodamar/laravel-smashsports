<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Optional but handy for forms/AJAX (even with Sanctum) --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Apply system dark mode immediately to avoid FOUC --}}
    <script>
        (function () {
            const appearance = '{{ $appearance ?? "system" }}';
            if (appearance === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/png" href="{{asset('favicon-96x96.png')}}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{asset('favicon.svg')}}" />
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('apple-touch-icon.png')}}" />
    <link rel="manifest" href="{{asset('site.webmanifest')}}" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- JS-only build: include app.js and (since we keep CSS separate) app.css --}}
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @inertiaHead
</head>
<body class="font-sans antialiased">
    @inertia
</body>
</html>
