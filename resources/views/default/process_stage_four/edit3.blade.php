@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-notify-3.1.3/bootstrap-notify.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2-bootstrap4.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('vendor/js/gmaps.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/html2canvas.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/js/jquery.mask.js') }}"></script>
<style>
    .gallery img {
        margin-top: 5px;
        max-width: 500px !important;
    }
</style>
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
            <div id="divider">
                <a id="navbarDropdown" class="nav-link dropdown-toggle list-group-item list-group-item-action bg-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="float-right"><i class="fas fa-minus"></i></span> <span id="mapTypesDpMenu">Cabos</span> <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @foreach($cables as $cable)
                    <a class="dropdown-item" onclick="selectCableType({{ $cable->id }}, {{ $cable->size }}, '{{ $cable->color }}', {{ $cable->dotted }}, {{ $cable->dotted_repeat }})">
                        <span style="color: {{ $cable->color }};"><i class="fas fa-square fa-lg"></i></span> <span class="text-uppercase"></span> {{ $cable->name }}
                    </a>
                    @endforeach
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
                        Indústria<span class="float-right"><i class="fas fa-industry"></i></span>
                    </a>
                </div>
            </div>
            <a onclick="createChangeCustomerPointFunction()" class="list-group-item list-group-item-action bg-light">Alterar ponto do cliente<span class="float-right"><i class="far fa-edit"></i></span></a>
            <a onclick="createListenerToTheServiceBox(boxesMarkers, boxesIds)" class="list-group-item list-group-item-action bg-light">Alterar caixa<span class="float-right"><i class="far fa-edit"></i></span></a>
            <a onclick="downloadMap()" class="list-group-item list-group-item-action bg-light">Salvar mapa offline<span class="float-right"><i class="fas fa-download"></i></span></a>
            <a onclick="showAlertSave()" class="list-group-item list-group-item-action bg-light">Salvar informações<span class="float-right"><i class="fas fa-map-marked"></i></span></a>
            <a href="{{ route('default.process_stage_four.index') }}" class="list-group-item list-group-item-action bg-light text-danger">Cancelar e voltar<span class="float-right"><i class="far fa-hand-point-left"></i></span></a>
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
                    <input type="hidden" id="route" name="route" value="{{ old('route') }}">
                    <input type="hidden" id="cable_id" name="cable_id" value="{{ old('cable_id') }}">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputname">Nome</label>
                                    <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->customer()->get()->first()->name }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="surname">Sobrenome</label>
                                    <input type="text" class="form-control" id="surname" name="surname" value="{{ $response->customer()->get()->first()->surname }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="phone">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $response->customer()->get()->first()->phone }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="contract_number">Número de contrato</label>
                                    <input type="number" class="form-control" id="contract_number" name="contract_number" min="0" max="2147483647" value="{{ $response->customer()->get()->first()->contract_number }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="number">Número de endereço</label>
                                    <input type="number" class="form-control" id="number" name="number" value="{{ $response->address()->get()->first()->number }}" min="0" max="2147483647">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_description">Descrição de endereço</label>
                                    <input type="text" class="form-control" id="end_description" name="end_description" value="{{ $response->address()->get()->first()->end_description }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="complement">Complemento de endereço</label>
                                    <input type="text" class="form-control" id="complement" name="complement" value="{{ $response->address()->get()->first()->complement }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="city">Cidade</label>
                                    <select name="city" id="city" class="form-control selectTwo" style="width: 100%">
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" @if($response->address()->get()->first()->cities_id == $city->id) selected @endif>{{ $city->name }}</option>
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
                                    <label for="box">ID Caixa</label>
                                    <input type="text" class="form-control" id="box" name="box" value="{{ $response->customer()->get()->first()->service_boxes_id }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="distance">Distância ap.</label>
                                    <input type="number" class="form-control" id="distance" name="distance" value="{{ old('distance') }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="real_meters">Distância Real</label>
                                    <input type="number" class="form-control" id="real_meters" name="real_meters" value="{{ old('real_meters') }}">
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0">Qual o nível de dificuldade ao realizar esse processo?</legend>
                                    <div class="col-sm-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="note" id="gridRadios1" value="1">
                                            <label class="form-check-label" for="gridRadios1">
                                                Fácil
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="note" id="gridRadios2" value="2" checked>
                                            <label class="form-check-label" for="gridRadios2">
                                                Normal
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="note" id="gridRadios3" value="3">
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
                                    <textarea class="form-control" id="comments" rows="3" name="comments" placeholder="Escreva aqui o seu relato sobre essa instalação." autofocus></textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="photos" name="photos[]" value="{{ old('photos[]') }}" multiple accept="image/*" />
                                        <label class="custom-file-label" for="photos">Enviar fotos do processo</label>
                                    </div>
                                    <span id="count_photos">Nenhuma foto selecionada até o momento.</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group text-center col-md-12">
                                    <div class="gallery"></div>
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
                        <a class="btn btn-danger" href="{{ route('default.process_stage_four.index') }}" role="button">Cancelar e voltar</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar essa janela</button>
                        <button type="submit" class="btn btn-success">Salvar informações</button>
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
    @foreach($boxes as $box)
        @if($box->id === $response->customer()->get()->first()->service_boxes_id)
        loadServiceBoxes({lat: {{ $box->m_lat }}, lng: {{ $box->m_lng }}}, {{ $box->amount - $box->busy }}, {{ $box->id }}, '#32a852', 0.08);
        @else
        loadServiceBoxes({lat: {{ $box->m_lat }}, lng: {{ $box->m_lng }}}, {{ $box->amount - $box->busy }}, {{ $box->id }}, '#FFF', 0.05);
        @endif
    @endforeach
};

// CARREGA OS CABOS PARA UTILIZAÇÃO
function loadCablesOnMap() {
    @foreach($cables as $cable)
        @if ($loop->first)
            selectCableType({{ $cable->id }}, {{ $cable->size }}, '{{ $cable->color }}', {{ $cable->dotted }}, {{ $cable->dotted_repeat }});
        @endif
    @endforeach
};

// CARREGA A ROTA DO CABO FEITA PELO TÉCNICO NO PROCESSO PASSADO
function loadLineRoute() {
    var routeVar = "{{ old('route') }}";
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
    loadCablesOnMap();
    createRoutePolylineFunction();
    @if(old('distance') !== null && !$errors->has('distance'))
        loadLineRoute();
        routeDistance = {{ old('distance') }};
    @endif

    const controlDiv = document.createElement("div");
    const controlDiv2 = document.createElement("div");
    createMenuButtonOnMap(controlDiv, gmap);
    gmap.controls[google.maps.ControlPosition.TOP_LEFT].push(controlDiv);
    createMenuDelRouteOnMap(controlDiv2, gmap);
    gmap.controls[google.maps.ControlPosition.TOP_LEFT].push(controlDiv2);
};

@if($errors->any())
showAlertSave();
@endif

//######################################

function downloadMap() {
    html2canvas(document.querySelector("#gmap"), {useCORS: true, allowTaint: false, ignoreElements: (node) => { return node.nodeName === 'IFRAME'; }}).then(canvas => {

        var link = document.createElement("a");
        document.body.appendChild(link);
        link.download = "{{ $response->created_at }}_{{ $response->customer()->get()->first()->name }}_{{ str_replace(' ', '_', $response->customer()->get()->first()->surname) }}_"+$("#city :selected").text()+"_{{ $response->customer()->get()->first()->phone }}";
        link.href = canvas.toDataURL();
        link.target = '_blank';
        link.click();

    });
}

$("body").on("change", function() {
    var numFiles = $("#photos", this)[0].files.length;
    $('#count_photos').text("Número de fotos selecionadas para esse processo: " + numFiles);
});
</script>

<script type="text/javascript">
// VALIDAÇÕES E MÁSCARAS
$("#phone").mask('(00) 00000-0000');

$("#thisForm").submit(function() {
  $("#phone").unmask();
});

$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr({'src': event.target.result, 'class': 'img-fluid col-md-6'}).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#photos').on('change', function() {
        $(".gallery img").remove();
        imagesPreview(this, 'div.gallery');
    });
});
</script>
@endsection