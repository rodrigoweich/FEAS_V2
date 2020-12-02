@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-notify-3.1.3/bootstrap-notify.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2-bootstrap4.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('vendor/js/gmaps.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/jquery.mask.js') }}"></script>
<script src="{{ asset('js/select2-pt-BR.js') }}"></scrip
@endsection

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('fcontent')
@if(!config('global.google_maps_key'))
<div class="container my-5 alert alert-danger">
    <h6 class="m-0 text-justify"><i class="fas fa-exclamation-triangle"></i> Foram encontradas inconsistências na sua chave de acesso do Google Maps API. Por favor, verifique a sua chave e tente novamente.</h6>
</div>
@else
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="list-group list-group-flush">
            <div id="divider">
                <a id="navbarDropdown" class="nav-link dropdown-toggle list-group-item list-group-item-action bg-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="float-right"><i class="fas fa-map"></i></span> <span id="mapTypesDpMenu">Padrão + Satélite</span> <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'roadmap', 'Padrão')">
                        Padrão
                    </a>
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'satellite', 'Satélite')">
                        Satélite
                    </a>
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'terrain', 'Padrão + Terreno')">
                        Padrão + Terreno
                    </a>
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'hybrid', 'Padrão + Satélite')">
                        Padrão + Satélite
                    </a>
                </div>
            </div>
            <div id="divider">
                <a id="navbarDropdown" class="nav-link dropdown-toggle list-group-item list-group-item-action bg-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="float-right"><i id="figureType" class="fas fa-home"></i></span> <span id="mapTypesDpMenu">Opções de ícones</span> <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" onclick="changeFigureType('fas fa-home')">
                        Casa<span class="float-right"><i class="fas fa-home"></i></span>
                    </a>
                    <a class="dropdown-item" onclick="changeFigureType('fas fa-hotel')">
                        Hotel<span class="float-right"><i class="fas fa-hotel"></i></span>
                    </a>
                    <a class="dropdown-item" onclick="changeFigureType('fas fa-building')">
                        Construção<span class="float-right"><i class="fas fa-building"></i></span>
                    </a>
                    <a class="dropdown-item" onclick="changeFigureType('fas fa-hospital')">
                        Hospital<span class="float-right"><i class="fas fa-hospital"></i></span>
                    </a>
                    <a class="dropdown-item" onclick="changeFigureType('fas fa-store')">
                        Loja<span class="float-right"><i class="fas fa-store"></i></span>
                    </a>
                    <a class="dropdown-item" onclick="changeFigureType('fas fa-warehouse')">
                        Armazém<span class="float-right"><i class="fas fa-warehouse"></i></span>
                    </a>
                    <a class="dropdown-item" onclick="changeFigureType('fas fa-church')">
                        Igreja<span class="float-right"><i class="fas fa-church"></i></span>
                    </a>
                    <a class="dropdown-item" onclick="changeFigureType('fas fa-graduation-cap')">
                        Centro educacional<span class="float-right"><i class="fas fa-graduation-cap"></i></span>
                    </a>
                    <a class="dropdown-item" onclick="changeFigureType('fas fa-industry')">
                        Industria<span class="float-right"><i class="fas fa-industry"></i></span>
                    </a>
                </div>
            </div>
            <a onclick="createChangeCustomerPointFunction()" class="list-group-item list-group-item-action bg-light">Editar localização<span class="float-right"><i class="far fa-edit"></i></span></a>
            <a onclick="showAlertSave()" class="list-group-item list-group-item-action bg-light">Salvar mudanças<span class="float-right"><i class="fas fa-map-marked"></i></span></a>
            <a href="{{ route('default.process_stage_one.index') }}" class="list-group-item list-group-item-action bg-light text-danger">Cancelar e voltar<span class="float-right"><i class="far fa-hand-point-left"></i></span></a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid" id="gmap">
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
@endif

<div class="modal fade" tabindex="-1" role="dialog" id="alertSave">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informação do processo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="thisForm" action="{{ route('default.process_stage_one.update', $response) }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" id="route" name="route">
                    <input type="hidden" id="cable_id" name="cable_id">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputname">Nome</label>
                                    <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->customer()->get()->first()->name }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="phone">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $response->customer()->get()->first()->phone }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contract_number">Número do contrato</label>
                                    <input type="number" class="form-control" id="contract_number" name="contract_number" min="0" max="2147483647" value="{{ $response->customer()->get()->first()->contract_number }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="number">Número do endereço</label>
                                    <input type="number" class="form-control" id="number" name="number" value="{{ $response->address()->get()->first()->number }}" min="0" max="2147483647">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_description">Descrição do endereço</label>
                                    <input type="text" class="form-control" id="end_description" name="end_description" value="{{ $response->address()->get()->first()->end_description }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="complement">Complemento do endereço</label>
                                    <input type="text" class="form-control" id="complement" name="complement" value="{{ $response->address()->get()->first()->complement }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="city">Cidade</label>
                                    <select name="city" id="city" class="form-control selectTwo" style="width: 100%">
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" @if($response->address()->get()->first()->cities_id == $city->id) selected @endif>{{ __($city->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="lat" name="lat" value="{{ $response->customer()->get()->first()->m_lat }}" readonly>
                            <input type="hidden" class="form-control" id="lng" name="lng" value="{{ $response->customer()->get()->first()->m_lng }}" readonly>
                            <input type="hidden" min="0" max="30" class="form-control" id="zoom" name="zoom" value="{{ $response->customer()->get()->first()->m_zoom }}" readonly>
                            <input type="hidden" class="form-control" id="icon" name="icon" value="{{ $response->customer()->get()->first()->m_icon }}" readonly>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <span class="float-right">
                        <a class="btn btn-danger" href="{{ route('default.process_stage_one.index') }}" role="button">Cancelar e voltar</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar essa janela</button>
                        <button type="submit" class="btn btn-success">Salvar mudanças</button>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
@if(config('global.google_maps_key'))
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('global.google_maps_key') }}&callback=initMap" async defer></script>
@endif

<script type="text/javascript"> $(".selectTwo").select2({ theme: "bootstrap4", "language": "pt-BR" }); </script>

<script type='text/javascript'>
// FUNÇÃO QUE VAI SELECIONAR A FONTE QUE REPRESENTA O CLIENTE
function selectCustomerMarker() {
    createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, selectCustomerIconPath("{{ $response->customer()->get()->first()->m_icon }}"));
    gmap.setCenter({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}});
    gmap.setZoom({{ $response->customer()->get()->first()->m_zoom }});
};

// FUNÇÃO PRINCIPAL, RODA AS CONFIGURAÇÕES PARA CRIAR O MAPA NA TELA DO USUÁRIO
function initMap() {
    gmap = new google.maps.Map(document.getElementById('gmap'), {
        center: {lat: -25.721822, lng: -53.765546},
        mapTypeId: "hybrid",
        zoom: 15,
        zoomControl: true,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false,
        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            mapTypeIds: [
                'roadmap',
                'terrain',
                'satellite',
                'hybrid'
            ]
        }
    });

    selectCustomerMarker();

    const controlDiv = document.createElement("div");
    createMenuButtonOnMap(controlDiv, gmap);
    gmap.controls[google.maps.ControlPosition.TOP_LEFT].push(controlDiv);
};

@if($errors->any())
showAlertSave();
@endif
</script>

<script type="text/javascript">
// VALIDAÇÕES E MÁSCARAS
$("#phone").mask('(00) 00000-0000');

$("#thisForm").submit(function() {
  $("#phone").unmask();
});
</script>
@endsection