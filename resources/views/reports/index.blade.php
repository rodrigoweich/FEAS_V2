@extends('layouts.app')

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

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Painel de relatórios disponíveis - viabilidade</h6>
        <div class="media text-muted pt-3">
            <svg class="bd-placeholder-img mr-2 rounded" width="64" height="32" xmlns="http://www.w3.org/2000/svg"
                preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32">
                <title>Relatório de cabos</title>
                <rect width="100%" height="100%" fill="#6D48E5" /><text x="50%" y="50%" fill="#fff" text-anchor="middle"
                    dy=".3em">{{ $cables }}</text>
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
                    dy=".3em">{{ $boxes }}</text>
            </svg>
            <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">@caixas</strong>
                    <a href="#" onclick="$('#selectBoxesConfig').modal('show');">Escolher opções</a>
                </div>
                <span class="d-block">nome, cidade, splittagem, vagas ocupadas, vagas disponíveis, número de clientes vinculados</span>
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
@endsection

@section('extra-scripts')
<script type='text/javascript'>
function setHrefBoxesReport() {
    $("#link-to-boxes-report").attr('href', "{{ route('reports.boxes_report') }}?city=" + $("#city").val());
};
</script>
@endsection