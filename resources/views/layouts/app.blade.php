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

        <div class="modal fade" tabindex="-1" role="dialog" id="alertAbout">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-th-large"></i> Sobre o FEAS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img class="img-fluid pb-3 img" src="{{ config('global.type_asset')('img/system/feas-logo.png') }}" alt="Home" style="width: 150px;">
                        <div class="form-note">
                            <p style="font-size: 16px; font-weight: 500; color: #97a6b5;">O seu sistema de viabilidades</p>
                        </div>
                        <h3 style="font-family: 'Montserrat'; font-size: 25px; font-weight: 600; color: #6d48e5; letter-spacing: 0; display: block; margin-bottom: 15px; text-decoration: none;">
                            FEAS
                        </h3>
                        <br>
                        <p style="font-size: 16px; font-weight: 500;">
                            O sistema FEAS foi criado com objetivo de ampliar os resultados e diminuir o
                            tempo de execução de um processo de viabilidade de instalações de internet via fibra óptica.<br/><br/>
                            Desenolvido por Rodrigo Gomes Weich<br/>Contato: (46) 9 9931-6956
                        </p>
                        <div class="row form-bottom text-center">
                            <div class="col">
                                <p class="mt-3 mb-3">v1.0 stable</p>
                            </div>
                            <div class="col">
                                <p class="mt-3 mb-3">&copy; 2020</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>

    </div>
    @hasSection ('extra-scripts')
    @yield('extra-scripts')
    @endif
</body>
</html>
