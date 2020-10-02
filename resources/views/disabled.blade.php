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
        .form-note {
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
        #message {
            color: #6D48E5;
        }
    </style>

</head>
<body class="text-center">
    <div class="form-signin" method="POST" action="{{ route('login') }}">
        <img class="img-fluid pb-3 img" src="{{ config('global.type_asset')('img/system/feas-logo.png') }}" alt="Home">
        <div class="form-note">
            <h5>Ops!!!</h5>
        </div>
        <h1><span class="logo">Desculpe...</span></h1>
        <h5 id="message">Este processo não pode ser editado novamente porque já passou por este estágio.</h5>
        <button class="btn btn-lg btn-block button-style" type="submit" onclick="window.history.back();">Retornar</button>
    </div>
</body>
</html>
