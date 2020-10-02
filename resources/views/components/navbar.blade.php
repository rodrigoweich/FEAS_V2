<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-detail text-uppercase" href="{{ route('home') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrar-se</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if(Storage::disk('public')->exists(Auth::user()->avatar))
                            <span class="float-left mr-2"><img id="prevImg" src="{{ config('global.type_asset')('/storage/'.Auth::user()->avatar) }}" alt="Avatar" class="avatar-image"></span>
                            @else
                            <span class="float-left mr-2"><img id="prevImg" src="{{ config('global.type_asset')('img/users/avatar.png') }}" alt="Avatar" class="avatar-image"></span>
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @can('list-users')
                            <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                Usuários<span class="float-right"><i class="fas fa-users"></i></span>
                            </a>
                            @endcan
                            @can('list-roles')
                            <a class="dropdown-item" href="{{ route('admin.roles.index') }}">
                                Funções<span class="float-right"><i class="fas fa-tags"></i></span>
                            </a>
                            @endcan
                            @can('list-cities')
                            <a class="dropdown-item" href="{{ route('admin.cities.index') }}">
                                Cidades<span class="float-right"><i class="fas fa-city"></i></span>
                            </a>
                            @endcan
                            @can('list-states')
                            <a class="dropdown-item" href="{{ route('admin.states.index') }}">
                                Estados<span class="float-right"><i class="fas fa-flag"></i></span>
                            </a>
                            @endcan
                            @can('list-notices')
                            <a class="dropdown-item" href="{{ route('admin.notices.index') }}">
                                Notícias<span class="float-right"><i class="fas fa-bullhorn"></i></span>
                            </a>
                            @endcan
                            @can('free-access-for-reports')
                            <a class="dropdown-item" href="{{ route('reports.index') }}">
                                Relatórios<span class="float-right"><i class="fas fa-chart-pie"></i></span>
                            </a>
                            @endcan
                            @can('list-process-stage-one')
                            <a class="dropdown-item" href="{{ route('default.process_stage_one.index') }}">
                                Processo - 1<span class="float-right"><i class="fas fa-microchip"></i></span>
                            </a>
                            @endcan
                            @can('list-process-stage-two')
                            <a class="dropdown-item" href="{{ route('default.process_stage_two.index') }}">
                                Processo - 2<span class="float-right"><i class="fas fa-microchip"></i></span>
                            </a>
                            @endcan
                            @can('list-process-stage-three')
                            <a class="dropdown-item" href="{{ route('default.process_stage_three.index') }}">
                                Processo - 3<span class="float-right"><i class="fas fa-microchip"></i></span>
                            </a>
                            @endcan
                            @can('list-process-stage-four')
                            <a class="dropdown-item" href="{{ route('default.process_stage_four.index') }}">
                                Processo - 4<span class="float-right"><i class="fas fa-microchip"></i></span>
                            </a>
                            @endcan
                            @can('list-process-stage-five')
                            <a class="dropdown-item" href="{{ route('default.process_stage_five.index') }}">
                                Processo - 5<span class="float-right"><i class="fas fa-microchip"></i></span>
                            </a>
                            @endcan
                            @can('list-cables')
                            <a class="dropdown-item" href="{{ route('default.cables.index') }}">
                                Cabos<span class="float-right"><i class="fas fa-minus"></i></span>
                            </a>
                            @endcan
                            @can('list-service_boxes')
                            <a class="dropdown-item" href="{{ route('default.boxes.index') }}">
                                Caixas<span class="float-right"><i class="fas fa-bookmark"></i></span>
                            </a>
                            @endcan
                            @can('list-process-history')
                            <a class="dropdown-item" href="{{ route('default.process_history.index') }}">
                                Histórico p.<span class="float-right"><i class="fas fa-list"></i></span>
                            </a>
                            @endcan
                            @can('list-general-process')
                            <a class="dropdown-item" href="{{ route('default.process_list.index') }}">
                                Lista p.<span class="float-right"><i class="fas fa-list"></i></span>
                            </a>
                            @endcan
                            @can('list-customers')
                            <a class="dropdown-item" href="{{ route('default.customers.index') }}">
                                Clientes<span class="float-right"><i class="fas fa-user-friends"></i></span>
                            </a>
                            @endcan
                            <a class="dropdown-item" href="#" onclick="$('#alertDeleteElement').modal('show');">
                                Sobre<span class="float-right"><i class="fas fa-th-large"></i></span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('users.profile', Auth::user()->id) }}">
                                Meu perfil<span class="float-right"><i class="fas fa-user-circle"></i></span>
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                Sair<span class="float-right"><i class="fas fa-sign-out-alt"></i></span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" tabindex="-1" role="dialog" id="alertDeleteElement">
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
                    O sistema FEAS é um sistema criado com objetivo de ampliar os resultados e diminuir o
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