<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Học tiếng Anh cùng Nhân</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @else

    @endif
</head>
<body class="@yield('body-class')">

@include('partials.header')

<main class="mt-4" id="main">
    @yield('content')
</main>

@include('partials.footer')

</body>
</html>
