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

    <!-- Styles -->
    <link href="{{ config('global.type_asset')('css/style.css') }}" rel="stylesheet">
    <link href="{{ config('global.type_asset')('css/fontawesome.css') }}" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .checkbox {
            font-weight: 400;
        }
        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-bottom p {
            color: #97a6b5;
        }

        .logo {
            font-family: 'Montserrat';
            font-size: 25px;
            font-weight: 600;
            color: #6d48e5;
            letter-spacing: 0;
            display: block;
            margin-bottom: 15px;
            text-decoration: none;
        }
        .form-note p {
            font-size: 12px;
            font-weight: 500;
            color: #97a6b5;
        }
        .button-style {
            background-color: #6D48E5;
            border-color: #6D48E5;
            color: #FFFFFF;
            font-size: 15px;
            margin: 5px 0px 5px 0px;
        }
        .img {
            width: 150px;
        }
    </style>

</head>
<body class="text-center">
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        <img class="img-fluid pb-3 img" src="{{ config('global.type_asset')('img/system/feas-logo.png') }}" alt="Home">
        @csrf
        <div class="form-note">
            <p>{{ __('Entrar') }}</p>
        </div>
        <h1><span class="logo">feas</span></h1>
        <div class="form-label-group">
            <input id="email" type="email" class="form-control" name="email" required autocomplete="email"
                placeholder="E-mail" autofocus>
            <div class="border-top my-3"></div>
            <input id="password" type="password" class="form-control" name="password" required
                autocomplete="current-password" placeholder="{{ __('Password') }}">
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <strong>{{ $error }}</strong>
            </div>
            @endforeach
        </div>
        <button class="btn btn-lg btn-block button-style" type="submit">Entrar</button>
        @if (Route::has('register'))
        <p>{{ __('No have account?') }} <a href="{{ route('register') }}">Registrar-se</a></p>
        @endif
        <div class="row form-bottom">
            <div class="col">
                <p class="mt-3 mb-3">v1.0</p>
            </div>
            <div class="col">
                <p class="mt-3 mb-3">&copy; 2020</p>
            </div>
        </div>
    </form>
</body>
</html>
