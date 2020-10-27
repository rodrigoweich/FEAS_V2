@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2-bootstrap4.css') }}" rel="stylesheet">
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    input[type=checkbox] {
        width: 20px; height: 20px;
    }
</style>
@endsection

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
<main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-detail rounded shadow-sm">
        <img class="mr-3" src="{{ config('global.type_asset')('img/system/feas-logo.png') }}" alt="" width="48" height="48">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Relatórios</h6>
            <small>FEAS 2020 @ Todos os direitos reservados</small>
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Painel de relatórios disponíveis - processos</h6>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de caixas</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $processes }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@processos</strong>
                    <a href="#" onclick="$('#selectProcessConfig').modal('show');">Escolher opções</a>
                </div>
                <span class="d-block">opções disponíveis para seleção</span>
            </div>
        </div>
        <div class="border-bottom border-gray" id="chart2" style="height: 300px;"></div>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de clientes por caixas</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $boxes->count() }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@clientes por caixas</strong>
                    <a href="#" onclick="$('#selectCustomersByBoxConfig').modal('show');">Escolher opções</a>
                </div>
                <span class="d-block">cliente, telefone, nº de contrato, endereço, nº de endereço, complemento, cidade</span>
            </div>
        </div>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de metragem de cabos</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em"></text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@metragem de cabos</strong>
                    <a href="#" onclick="$('#selectFootageComparasionConfig').modal('show');">Escolher opções</a>
                </div>
                <span class="d-block">cliente, cidade, técnico, metragem aproximado, metragem real, diferença de metragem (MA - MR)</span>
            </div>
        </div>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de ocupação</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em"></text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@ocupação/cidade</strong>
                    <a href="{{ route('reports.occupation_report') }}">Gerar relatório</a>
                </div>
                <span class="d-block">Cidade, qtd caixas, qtd portas, ocupadas, livres, ocupação(%)</span>
            </div>
        </div>
        <div class="border-bottom border-gray" id="chart" style="height: 300px;"></div>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de clientes</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $customers->count() }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@clientes</strong>
                    <a href="#" onclick="$('#selectCustomersConfig').modal('show');">Escolher opções</a>
                </div>
                <span class="d-block">nome, telefone, n° de contrato, nº de endereço, complemento, descrição, ícone de representação</span>
            </div>
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Painel de relatórios disponíveis - viabilidade</h6>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de cabos</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $cables->count() }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@cabos</strong>
                    <a href="{{ route('reports.cables_report') }}">Gerar relatório</a>
                </div>
                <span class="d-block">nome, cor hex., pontilhado, tamanho</span>
            </div>
        </div>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de caixas</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $boxes->count() }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@caixas</strong>
                    <a href="#" onclick="$('#selectBoxesConfig').modal('show');">Escolher opções</a>
                </div>
                <span class="d-block">nome, cidade, splittagem, vagas ocupadas, vagas disponíveis, n° de clientes vinculados</span>
            </div>
        </div>
    <div id="chart3" style="height: 300px;"></div>
    </div>
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Painel de relatórios disponíveis - administração</h6>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de usuários</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $users }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@usuários</strong>
                    <a href="{{ route('reports.user_report') }}">Gerar relatório</a>
                </div>
                <span class="d-block">nome, e-mail, função</span>
            </div>
        </div>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de funções</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $roles }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@funções</strong>
                    <a href="{{ route('reports.role_report') }}">Gerar relatório</a>
                </div>
                <span class="d-block">nome, alterável?, regras</span>
            </div>
        </div>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de regras</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $rules }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@regras</strong>
                    <a href="{{ route('reports.rule_report') }}">Gerar relatório</a>
                </div>
                <span class="d-block">nome, nome gerencia</span>
            </div>
        </div>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de cidades</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $cities }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@cidades</strong>
                    <a href="{{ route('reports.cities_report') }}">Gerar relatório</a>
                </div>
                <span class="d-block">nome, latitude, longitude, zoom, estado, atalho?</span>
            </div>
        </div>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de estados</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $states }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@estados</strong>
                    <a href="{{ route('reports.states_report') }}">Gerar relatório</a>
                </div>
                <span class="d-block">nome, uf</span>
            </div>
        </div>
    </div>


</main>

<div class="modal fade" tabindex="-1" role="dialog" id="selectBoxesConfig">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Opções de relatório - Caixas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center container">
                    <div class="row">
                        <label for="city">Cidade</label>
                        <select name="city" id="city" class="form-control selectTwo" style="width: 100%">
                            <option value="0">Todas</option>
                        @foreach($all_cities as $city)
                            <option value="{{ $city->id }}">{{ __($city->name) }}</option>
                        @endforeach
                        </select>
                    </div>
                
                    <span class="float-right mt-3">
                        <a id="link-to-boxes-report" onclick="setHrefBoxesReport()"><button class="btn btn-success">Gerar relatório</button></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="selectProcessConfig">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Opções de relatório - Processos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col">
                        <label for="stage">Estágio</label>
                        <select name="stage" id="stage" class="form-control selectTwo" style="width: 100%">
                            <option value="all">Todos</option>
                            <option value="0">Estágio 1 - Comercial</option>
                            <option value="1">Estágio 2 - Viabilidade</option>
                            <option value="2">Estágio 3 - Operacional</option>
                            <option value="3">Estágio 4 - Técnico</option>
                            <option value="4">Estágio 5 - SAC</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="stage">Exibir finalizados</label>
                        <select name="with-trashed" id="with-trashed" class="form-control" style="width: 100%">
                            <option value="yes">Sim</option>
                            <option value="no">Não</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="daterange">Período</label>
                        <input class="form-control" type="text" id="daterange" name="daterange" />
                    </div>
                    <div class="col">
                        <label for="stage">Orientação</label>
                        <select name="page_mode" id="page_mode" class="form-control" style="width: 100%">
                            <option value="portrait">Retrato</option>
                            <option value="landscape">Panorama</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="col-sm-3">Opções de informações do relatório</th>
                                    <th class="col-sm-1 text-center">Selecione</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_id" name="option_id" checked>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cliente</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_customer" name="option_customer" checked>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Representação de ícone</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_icon" name="option_icon" checked>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cidade</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_city" name="option_city" checked>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Iniciado por</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_started_by" name="option_started_by" checked>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Iniciado em</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_started_in" name="option_started_in" checked>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Técnico responsável</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_tech" name="option_tech">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Estágio do processo</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_stage" name="option_stage">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Metragem aproximada</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_meters_ap" name="option_meters_ap">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Metragem real</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_meters_real" name="option_meters_real">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Diferença metragem</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="options_difference_meters" name="options_difference_meters">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Cabo utilizado</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_cable" name="option_cable">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Finalizado por</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_finished_by" name="option_finished_by">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Notificações enviadas</td>
                                    <td class="text-center">
                                        <input type="checkbox" id="option_notifications" name="option_notifications">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <span class="float-right mt-3">
                    <a id="link-to-process-report" onclick="setHrefProcessReport()"><button class="btn btn-success">Gerar relatório</button></a>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="selectCustomersByBoxConfig">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Opções de relatório - Clientes por caixa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row mt-2">
                    <div class="col">
                        <label for="cpc_box">Escolha a caixa</label>
                        <select name="cpc_box" id="cpc_box" class="mselectBoxes" style="width: 100%">
                        @foreach($boxes as $b)
                            <option value="{{ $b->id }}">{{ __($b->id) }} # [{{ $all_cities->find($b->cities_id)->name }}] {{ __($b->name) }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <span class="float-right mt-3">
                    <a id="link-to-customers-by-box-report" onclick="setHrefCustomersByBoxesReport()"><button class="btn btn-success">Gerar relatório</button></a>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="selectFootageComparasionConfig">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Opções de relatório - metragem de cabos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col">
                        <label for="city">Cidade</label>
                        <select name="cdm_city" id="cdm_city" class="form-control mselectBoxes" style="width: 100%">
                            <option value="0">Todas</option>
                        @foreach($all_cities as $city)
                            <option value="{{ $city->id }}">{{ __($city->name) }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="daterange_cdm">Período</label>
                        <input class="form-control" type="text" id="daterange_cdm" name="daterange" />
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="cdm_technician">Técnico</label>
                        <select name="cdm_technician" id="cdm_technician" class="form-control mselectBoxes" style="width: 100%">
                        <option value="0">Todos</option>
                        @foreach($technicians as $tech)
                            <option value="{{ $tech->id }}">{{ __($tech->name) }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="cdm_cable">Cabo</label>
                        <select name="cdm_cable" id="cdm_cable" class="form-control mselectBoxes" style="width: 100%">
                        <option value="0">Todos</option>
                        @foreach($cables as $cable)
                            <option value="{{ $cable->id }}">{{ $cable->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <span class="float-right mt-3">
                    <a id="link-to-footage-comparasion-report" onclick="setHrefFootageComparasionReport()"><button class="btn btn-success">Gerar relatório</button></a>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="selectCustomersConfig">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Opções de relatório - clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col">
                        <label for="scc_city">Cidade</label>
                        <select name="scc_city" id="scc_city" class="form-control mselectBoxes" style="width: 100%">
                            <option value="0">Todas</option>
                        @foreach($all_cities as $city)
                            <option value="{{ $city->id }}">{{ __($city->name) }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label for="scc_icon">Representação de ícone</label>
                        <select name="scc_icon" id="scc_icon" class="form-control mselectBoxes" style="width: 100%">
                        <option value="0">Todos</option>
                        <option value="fas fa-home">Casa</option>
                        <option value="fas fa-hotel">Hotel</option>
                        <option value="fas fa-building">Construção</option>
                        <option value="fas fa-hospital">Hospital</option>
                        <option value="fas fa-store">Loja</option>
                        <option value="fas fa-warehouse">Armazém</option>
                        <option value="fas fa-church">Igreja</option>
                        <option value="fas fa-graduation-cap">Centro educacional</option>
                        <option value="fas fa-industry">Industria</option>
                        </select>
                    </div>
                </div>

                <span class="float-right mt-3">
                    <a id="link-to-customers-report" onclick="setHrefCustomersReport()"><button class="btn btn-success">Gerar relatório</button></a>
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type='text/javascript'>
    $(".mselectBoxes").select2({
        theme: "bootstrap4"
    });
</script>

<script type='text/javascript'>
function setHrefBoxesReport() {
    $("#link-to-boxes-report").attr('href', "{{ route('reports.boxes_report') }}?city=" + $("#city").val());
};
function setHrefCustomersByBoxesReport() {
    $("#link-to-customers-by-box-report").attr('href', "{{ route('reports.customers_by_box_report') }}?box_id=" + $("#cpc_box").val());
};
function setHrefFootageComparasionReport() {
    var link =
        "?city=" + $("#cdm_city").val()
        + "&date=" + $("#daterange_cdm").val()
        + "&tech=" + $("#cdm_technician").val()
        + "&cable=" + $("#cdm_cable").val();
    $("#link-to-footage-comparasion-report").attr('href', "{{ route('reports.footage_comparasion_report') }}" + link);
};
function setHrefCustomersReport() {
    var link =
        "?city=" + $("#scc_city").val()
        + "&icon=" + $("#scc_icon").val();
    $("#link-to-customers-report").attr('href', "{{ route('reports.customers_report') }}" + link);
};
function setHrefProcessReport() {
    var link =
        "?stage=" + $("#stage").val()
        + "&date=" + $("#daterange").val()
        + "&option_id=" + $("#option_id").is(":checked")
        + "&option_customer=" + $("#option_customer").is(":checked")
        + "&option_icon=" + $("#option_icon").is(":checked")
        + "&option_city=" + $("#option_city").is(":checked")
        + "&option_started_by=" + $("#option_started_by").is(":checked")
        + "&option_started_in=" + $("#option_started_in").is(":checked")
        + "&option_tech=" + $("#option_tech").is(":checked")
        + "&option_stage=" + $("#option_stage").is(":checked")
        + "&option_meters_ap=" + $("#option_meters_ap").is(":checked")
        + "&option_meters_real=" + $("#option_meters_real").is(":checked")
        + "&option_cable=" + $("#option_cable").is(":checked")
        + "&option_finished_by=" + $("#option_finished_by").is(":checked")
        + "&option_notifications=" + $("#option_notifications").is(":checked")
        + "&options_difference_meters=" + $("#options_difference_meters").is(":checked")
        + "&trash=" + $("#with-trashed").val()
        + "&page_mode=" + $("#page_mode").val();

    $("#link-to-process-report").attr('href', "{{ route('reports.processes_report') }}" + link);
};
</script>

<script type='text/javascript'>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left',
    locale: {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Limpar",
            "fromLabel": "De",
            "toLabel": "Até",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sáb"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 0
        }
  });
});
</script>

<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
<script>
    const chart = new Chartisan({
        el: '#chart2',
        url: "@chart('processchart')",
        hooks: new ChartisanHooks()
            .legend(!1)
            .tooltip()
            .colors(['#B6A4F2', '#6D48E5', '#967CEC'])
            .axis(!1)
            .options({ textStyle: { fontFamily: "Quicksan" } })
            .datasets([
                {type: "pie"},
            ]),
    });
    const chart2 = new Chartisan({
        el: '#chart',
        url: "@chart('occupationchart')",
        hooks: new ChartisanHooks()
            .legend()
            .tooltip()
            .colors(['#B6A4F2', '#6D48E5', '#967CEC'])
            .axis()
            .options({ textStyle: { fontFamily: "Quicksan" } })
            .datasets(['bar'])
    });
    const chart3 = new Chartisan({
        el: '#chart3',
        url: "@chart('boxesbycitychart')",
        hooks: new ChartisanHooks()
            .tooltip()
            .axis(false)
            .colors(['#B6A4F2', '#6D48E5', '#967CEC'])
            .title('Caixas por cidade')
            .options({ textStyle: { fontFamily: "Quicksan" } })
            .datasets(['pie'])
    });
</script>
@endsection
