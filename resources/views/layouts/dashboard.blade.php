<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
</head>
<body>
<div id="app">
    @include('partials._navbar')
    <main class="py-4">
        <div class="container">
            <div class="columns">
                <div class="column is-3">
                    @include('partials._sidebar')
                </div>
                <div class="column">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@yield('foot')
</body>
</html>
