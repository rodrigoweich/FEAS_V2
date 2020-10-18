@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-notify-3.1.3/bootstrap-notify.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2-bootstrap4.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('vendor/js/gmaps.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/jquery.mask.js') }}"></script>
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
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'roadmap', 'Default')">
                        Padrão
                    </a>
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'satellite', 'Satellite')">
                        Satélite
                    </a>
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'terrain', 'Default + Terrain')">
                        Padrão + Terreno
                    </a>
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'hybrid', 'Default + Satellite')">
                        Padrão + Satélite
                    </a>
                </div>
            </div>
            <a onclick="$('#showPhotos').modal('show');" class="list-group-item list-group-item-action bg-light">Fotos <span class="badge badge-primary">{{ count($photos) }}</span> <span class="float-right"><i class="fas fa-images"></i></span></a>
            <a onclick="$('#alertSave').modal('show');" class="list-group-item list-group-item-action bg-light">Finalizar processo<span class="float-right"><i class="fas fa-map-marked"></i></span></a>
            <a href="{{ route('default.process_stage_five.index') }}" class="list-group-item list-group-item-action bg-light text-danger">Cancelar e voltar<span class="float-right"><i class="far fa-hand-point-left"></i></span></a>
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

                <form id="thisForm" action="{{ route('default.process_stage_four.update', $response) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" id="route" name="route">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputname">Nome</label>
                                    <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->customer()->get()->first()->name }}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="surname">Sobrenome</label>
                                    <input type="text" class="form-control" id="surname" name="surname" value="{{ $response->customer()->get()->first()->surname }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="phone">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $response->customer()->get()->first()->phone }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="contract_number">Número de contrato</label>
                                    <input type="number" class="form-control" id="contract_number" name="contract_number" min="0" value="{{ $response->customer()->get()->first()->contract_number }}" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="number">Número de endereço</label>
                                    <input type="number" class="form-control" id="number" name="number" value="{{ $response->address()->get()->first()->number }}" min="0" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_description">Descrição de endereço</label>
                                    <input type="text" class="form-control" id="end_description" name="end_description" value="{{ $response->address()->get()->first()->end_description }}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="complement">Complemento de endereço</label>
                                    <input type="text" class="form-control" id="complement" name="complement" value="{{ $response->address()->get()->first()->complement }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="city">Cidade</label>
                                    <select name="city" id="city" class="form-control selectTwo" style="width: 100%" disabled>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" @if($response->address()->get()->first()->cities_id == $city->id) selected @endif>{{ __($city->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="lat">Latitude</label>
                                    <input type="text" class="form-control" id="lat" name="lat" value="{{ $response->customer()->get()->first()->m_lat }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="lng">Longitude</label>
                                    <input type="text" class="form-control" id="lng" name="lng" value="{{ $response->customer()->get()->first()->m_lng }}" readonly>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="zoom">Zoom</label>
                                    <input type="number" min="0" max="30" class="form-control" id="zoom" name="zoom" value="{{ $response->customer()->get()->first()->m_zoom }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="icon">Nome do ícone</label>
                                    <input type="text" class="form-control" id="icon" name="icon" value="{{ $response->customer()->get()->first()->m_icon }}" readonly>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="box">ID caixa</label>
                                    <input type="text" class="form-control" id="box" name="box" value="{{ $response->customer()->get()->first()->service_boxes_id }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="distance">Distância ap.</label>
                                    <input type="number" class="form-control" id="distance" name="distance" value="{{ $response->meters }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="real_meters">Distância real</label>
                                    <input type="number" class="form-control" id="real_meters" name="real_meters" value="{{ $response->real_meters }}" readonly>
                                </div>
                            </div>
                            <fieldset class="form-group" disabled>
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0">Qual o nível de dificuldade ao realizar esse processo?</legend>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="note" id="gridRadios1" value="1" @if($response->difficulty == 1) checked @endif>
                                            <label class="form-check-label" for="gridRadios1">
                                                Fácil
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="note" id="gridRadios2" value="2" @if($response->difficulty == 2) checked @endif>
                                            <label class="form-check-label" for="gridRadios2">
                                                Normal
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="note" id="gridRadios3" value="3" @if($response->difficulty == 3) checked @endif>
                                            <label class="form-check-label" for="gridRadios3">
                                                Difícil
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="comments">Comentários</label>
                                    <textarea class="form-control" id="comments" rows="3" name="comments" readonly>{{ $response->comments }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="custom-file">
                                        <label for="photos">Foi encontrado um total de {{ count($photos) }} fotos para esse processo.</label>
                                        <a onclick="$('#alertSave').modal('hide'); $('#showPhotos').modal('show');" class="text-primary">Clique aqui para visualizar.</a>
                                    </div>
                                </div>
                            </div>
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
                        <a class="btn btn-danger" href="{{ route('default.process_stage_five.index') }}" role="button">Cencelar e voltar</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar essa janela</button>
                        <button type="button" class="btn btn-success" onclick="$('#finishProcess').modal('show');">Finalizar</button>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="showPhotos">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informação do processo - Fotos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            @if(empty($photos))
                Desculpe, esse processo não possui fotos vinculadas.
            @else
                <div class="text-center">
                    @foreach($photos as $photo)
                        <img class="figure-img rounded" style="max-width: 100%; max-height: 100%" src="/process_photos/{{ $photo }}">
                    @endforeach
                </div>
            @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="finishProcess">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informação do processo - Finalização</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    O processo só pode ser finalizado depois de atualizado nos demais sistemas (UNM, Geogrid, entre outros).<br><br>
                    Todos os processos são verificados depois da finalização para comprovar se realmente foram devidamente finalizados.<br><br>
                    Se você se certificou que tudo foi finalizado corretamente, você realmente deseja finalizar esse processo?<br><br>
                    @can('delete-process-stage-five')
                        <a class="btn btn-danger mb-2" href="{{ route('default.process_stage_five.index') }}" role="button">Não! deixar em espera</a>
                        <form action="{{ route('default.process.finish', $response->id) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-success">Sim! Finalizar processo</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
@if(config('global.google_maps_key'))
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('global.google_maps_key') }}&callback=initMap" async defer></script>
@endif

<script type="text/javascript"> $(".selectTwo").select2({ theme: "bootstrap4" }); </script>

<script type='text/javascript'>
// FUNÇÃO QUE VAI SELECIONAR A FONTE QUE REPRESENTA O CLIENTE
function selectCustomerMarker() {
    createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, selectCustomerIconPath("{{ $response->customer()->get()->first()->m_icon }}"));
    gmap.setCenter({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}});
    gmap.setZoom({{ $response->customer()->get()->first()->m_zoom }});
};

// CARREGA AS CAIXAS DE ATENDIMENTO NO MAPA
function loadBoxesOnMap() {
    loadServiceBoxes({lat: {{ $selectedBox->m_lat }}, lng: {{ $selectedBox->m_lng }}}, {{ $selectedBox->amount - $selectedBox->busy }}, {{ $selectedBox->id }}, '#32a852', 0.08);
};

// CARREGA A ROTA DO CABO FEITA PELO TÉCNICO NO PROCESSO PASSADO
function loadLineRoute() {
    var routeVar = "{{ $response->route }}";
    routeVar = routeVar.replace(/&quot;/g,'"');
    routeVar = JSON.parse(routeVar);
    $.each(routeVar["i"], function(i) {
        loadCableRoute(new google.maps.LatLng(routeVar["i"][i]));
    });
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
    loadBoxesOnMap();
    selectCableType({{ $cable->id }}, {{ $cable->size }}, '{{ $cable->color }}', {{ $cable->dotted }}, {{ $cable->dotted_repeat }});
    loadLineRoute();

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