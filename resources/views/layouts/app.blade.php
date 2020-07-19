<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ config('global.type_asset')('/img/system/favicon.ico') }}" type="image/x-icon"/>

    <!-- Scripts -->
    <script src="{{ config('global.type_asset')('js/jquery.js') }}"></script>
    <script src="{{ config('global.type_asset')('js/bootstrap.js') }}"></script>
    <script src="{{ config('global.type_asset')('js/fontawesome.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ config('global.type_asset')('css/style.css') }}" rel="stylesheet">
    <link href="{{ config('global.type_asset')('css/fontawesome.css') }}" rel="stylesheet">
    @hasSection('extra-header')
        @yield('extra-header')
    @endif
</head>
<body class="bg-background">
    <div id="app">
        @hasSection ('navbar')
            @yield('navbar')
        @endif
        <main>
            @hasSection('fcontent')
                @yield('fcontent')
            @endif
            @hasSection ('content')
            <div class="py-4">
                @yield('content')
            </div>
            @endif
        </main>
    </div>
    @hasSection ('extra-scripts')
    @yield('extra-scripts')
    @endif
</body>
</html>
