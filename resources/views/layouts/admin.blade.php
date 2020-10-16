<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <title>Bookstore Admin</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/brand/favicon.png') }}" type="image/png"/>
    <!-- Fonts -->
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
    />
    <!-- Icons -->
    <link
        rel="stylesheet"
        href="{{ asset('vendor/nucleo/css/nucleo.css') }}"
        type="text/css"
    />
    <link
        rel="stylesheet"
        href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css"
    />
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link
        rel="stylesheet"
        href="{{ asset('css/argon.css?v=1.2.0') }}"
        type="text/css"
    />
</head>
<body>

<x-side-nav></x-side-nav>

<div class="main-content" id="panel">
    <x-top-nav></x-top-nav>

    @hasSection('content')
        @yield('content')
    @endif

</div>

<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>

<!-- Optional JS -->
<script src="{{ asset('vendor/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('vendor/chart.js/dist/Chart.extension.js') }}"></script>

<!-- Argon JS -->
<script src="{{ asset('js/argon.js?v=1.2.0') }}"></script>
</body>
</html>
