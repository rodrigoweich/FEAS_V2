@extends('layouts.app')

@section('extra-header')
<link href="{{ config('global.type_asset')('vendor/css/home-timeline.css') }}" rel="stylesheet">
@endsection

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
@can('home-timeline')
<div class="container" id="procces_timeline">
    <h1>Linha do tempo de processos</h1>
    <div class="flex-parent">
        <div class="input-flex-container">
            <input type="radio" name="timeline-dot" data-description="1" checked>
            <div class="dot-info" data-description="1">
                <span class="year">1</span>
                <span class="label">Processo estágio - 1</span>
            </div>
            <input type="radio" name="timeline-dot" data-description="2">
            <div class="dot-info" data-description="2">
                <span class="year">2</span>
                <span class="label">Processo estágio - 2</span>
            </div>
            <input type="radio" name="timeline-dot" data-description="3">
            <div class="dot-info" data-description="3">
                <span class="year">3</span>
                <span class="label">Processo estágio - 3</span>
            </div>
            <input type="radio" name="timeline-dot" data-description="4">
            <div class="dot-info" data-description="4">
                <span class="year">4</span>
                <span class="label">Processo estágio - 4</span>
            </div>
            <input type="radio" name="timeline-dot" data-description="5">
            <div class="dot-info" data-description="5">
                <span class="year">5</span>
                <span class="label">Processo estágio - 5</span>
            </div>
            <div id="timeline-descriptions-wrapper">
                <p data-description="1">
                    <span class="row d-flex justify-content-center mb-2 text-center" style="font-size: 16px !important">
                        @if($processes_stage_one === 0)
                            Desculpe, este estágio não contém nenhum processo. =/
                        @else
                            O primeiro estágio contém {{ $processes_stage_one }} @if($processes_stage_one === 1) processo @else processos @endif em andamento<br>
                            Último processo aberto em nome de {{ $customer->find($process->customers_id)->name }} {{ $customer->find($process->customers_id)->surname }}
                        @endif
                    </span>
                    @if($processes_stage_one !== 0)
                    <span class="row d-flex justify-content-center mt-2">
                        <a href="{{ route('default.process_stage_one.index') }}"><button class="btn btn-detail">Visualizar @if($processes_stage_one === 1) processo @else processos @endif</button></a>
                    </span>
                    @endif
                </p>
                <p data-description="2">
                    <span class="row d-flex justify-content-center mb-2 text-center" style="font-size: 16px !important">
                        @if($processes_stage_two === 0)
                            Desculpe, este estágio não contém nenhum processo. =/
                        @else
                            O segundo estágio contém {{ $processes_stage_two }} @if($processes_stage_two === 1) processo @else processos @endif em andamento<br>
                            Último processo nesse estágio está em nome de {{ $customer->find($process->where('stage', 1)->get()->last()->customers_id)->name }} {{ $customer->find($process->where('stage', 1)->get()->last()->customers_id)->surname }}
                        @endif
                    </span>
                    @if($processes_stage_two !== 0)
                    <span class="row d-flex justify-content-center mt-2">
                        <a href="{{ route('default.process_stage_two.index') }}"><button class="btn btn-detail">Visualizar processos</button></a>
                    </span>
                    @endif
                </p>
                <p data-description="3">
                    <span class="row d-flex justify-content-center mb-2 text-center" style="font-size: 16px !important">
                        @if($processes_stage_three === 0)
                            Desculpe, este estágio não contém nenhum processo. =/
                        @else
                            O terceiro estágio contém {{ $processes_stage_three }} @if($processes_stage_three === 1) processo @else processos @endif em andamento<br>
                            Último processo nesse estágio está em nome de {{ $customer->find($process->where('stage', 2)->get()->last()->customers_id)->name }} {{ $customer->find($process->where('stage', 2)->get()->last()->customers_id)->surname }}
                        @endif
                    </span>
                    @if($processes_stage_three !== 0)
                    <span class="row d-flex justify-content-center mt-2">
                        <a href="{{ route('default.process_stage_three.index') }}"><button class="btn btn-detail">Visualizar processos</button></a>
                    </span>
                    @endif
                </p>
                <p data-description="4">
                    <span class="row d-flex justify-content-center mb-2 text-center" style="font-size: 16px !important">
                        @if($processes_stage_four === 0)
                            Desculpe, este estágio não contém nenhum processo. =/
                        @else
                            O quarto estágio contém {{ $processes_stage_four }} @if($processes_stage_four === 1) processo @else processos @endif em andamento<br>
                            Último processo nesse estágio está em nome de {{ $customer->find($process->where('stage', 3)->get()->last()->customers_id)->name }} {{ $customer->find($process->where('stage', 3)->get()->last()->customers_id)->surname }}
                        @endif
                    </span>
                    @if($processes_stage_four !== 0)
                    <span class="row d-flex justify-content-center mt-2">
                        <a href="{{ route('default.process_stage_four.index') }}"><button class="btn btn-detail">Visualizar processos</button></a>
                    </span>
                    @endif
                </p>
                <p data-description="5">
                    <span class="row d-flex justify-content-center mb-2 text-center" style="font-size: 16px !important">
                        @if($processes_stage_five === 0)
                            Desculpe, este estágio não contém nenhum processo. =/
                        @else
                            O quarto estágio contém {{ $processes_stage_five }} @if($processes_stage_five === 1) processo @else processos @endif em andamento<br>
                            Último processo nesse estágio está em nome de {{ $customer->find($process->where('stage', 4)->get()->last()->customers_id)->name }} {{ $customer->find($process->where('stage', 4)->get()->last()->customers_id)->surname }}
                        @endif
                    </span>
                    @if($processes_stage_five !== 0)
                    <span class="row d-flex justify-content-center mt-2">
                        <a href="{{ route('default.process_stage_five.index') }}"><button class="btn btn-detail">Visualizar processos</button></a>
                    </span>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
@endcan

<div class="container" id="shortcut_buttons">
    <div class="row justify-content-center">
        <div class="row row-cols-3 row-cols-md-6 col-md-12 text-center">
            <!-- USUÁRIOS -->
            @can('list-users')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('admin.users.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-users fa-lg"></i>
                                <p class="card-text">
                                    Usuários
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /USUÁRIOS -->
            <!-- FUNÇÕES -->
            @can('list-roles')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('admin.roles.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-tags fa-lg"></i>
                                <p class="card-text">
                                    Funções
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /FUNÇÕES -->
            <!-- CIDADES -->
            @can('list-cities')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('admin.cities.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-city fa-lg"></i>
                                <p class="card-text">
                                    Cidades
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /CIDADES -->
            <!-- ESTADOS -->
            @can('list-states')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('admin.states.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-flag fa-lg"></i>
                                <p class="card-text">
                                    Estados
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /ESTADOS -->
            <!-- NOTICIAS -->
            @can('list-states')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('admin.notices.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-bullhorn fa-lg"></i>
                                <p class="card-text">
                                    Notícias
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /NOTICIAS -->
            <!-- RELATÓRIOS -->
            @can('free-access-for-reports')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('reports.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-chart-pie fa-lg"></i>
                                <p class="card-text">
                                Relatórios
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /RELATÓRIOS -->
            <!-- PROCESSO ESTÁGIO 1 -->
            @can('list-process-stage-one')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('default.process_stage_one.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-microchip fa-lg"></i>
                                <p class="card-text">
                                Processo estágio - 1
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /PROCESSO ESTÁGIO 1 -->
            <!-- PROCESSO ESTÁGIO 2 -->
            @can('list-process-stage-two')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('default.process_stage_two.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-microchip fa-lg"></i>
                                <p class="card-text">
                                Processo estágio - 2
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /PROCESSO ESTÁGIO 2 -->
            <!-- PROCESSO ESTÁGIO 3 -->
            @can('list-process-stage-three')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('default.process_stage_three.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-microchip fa-lg"></i>
                                <p class="card-text">
                                Processo estágio - 3
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /PROCESSO ESTÁGIO 3 -->
            <!-- PROCESSO ESTÁGIO 4 -->
            @can('list-process-stage-four')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('default.process_stage_four.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-microchip fa-lg"></i>
                                <p class="card-text">
                                Processo estágio - 4
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /PROCESSO ESTÁGIO 4 -->
            <!-- PROCESSO ESTÁGIO 5 -->
            @can('list-process-stage-five')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('default.process_stage_five.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-microchip fa-lg"></i>
                                <p class="card-text">
                                Processo estágio - 5
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /PROCESSO ESTÁGIO 5 -->
            <!-- CABOS -->
            @can('list-cables')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('default.cables.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-minus fa-lg"></i>
                                <p class="card-text">
                                Cabos
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /CABOS -->
            <!-- CAIXAS -->
            @can('list-service_boxes')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('default.boxes.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-bookmark fa-lg"></i>
                                <p class="card-text">
                                Caixas
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /CAIXAS -->
            <!-- HISTÓRICO DE PROCESSOS -->
            @can('list-process-history')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('default.process_history.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-list fa-lg"></i>
                                <p class="card-text">
                                Histórico de processos
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /HISTÓRICO DE PROCESSOS -->
            <!-- LISTA DE PROCESSOS -->
            @can('list-process-history')
                <div class="col mb-4">
                    <div class="card rounded-05 main-menu-card h-100">
                        <a href="{{ route('default.process_list.index') }}" class="btn">
                            <div class="card-body">
                                <i class="fas fa-list fa-lg"></i>
                                <p class="card-text">
                                Lista de processos
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endcan
            <!-- /LISTA DE PROCESSOS -->
        </div>
    </div>
</div>

<div class="container" id="notices_panel">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Mural de notícias e atualizações</div>
                <div class="card-body">
                    @if($notices->count() === 0)
                        Desculpe, no momento não temos nada para exibir.
                    @else
                        @foreach($notices as $notice)
                        <p class="text-justify"><span class="font-weight-bold">{{ $notice->title }}</span> -> {{ $notice->description }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection