@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-notify-3.1.3/bootstrap-notify.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2-bootstrap4.css') }}" rel="stylesheet">
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
            <a onclick="showAlertSave()" class="list-group-item list-group-item-action bg-light">Salvar informações<span class="float-right"><i class="fas fa-map-marked"></i></span></a>
            <a href="{{ route('default.process_stage_two.index') }}" class="list-group-item list-group-item-action bg-light text-danger">Cancelar e voltar<span class="float-right"><i class="far fa-hand-point-left"></i></span></a>
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

                <form id="thisForm" action="{{ route('default.process_stage_two.update', $response) }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
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
                                    <input type="number" class="form-control" id="contract_number" name="contract_number" min="0" value="{{ $response->customer()->get()->first()->contract_number }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="number">Número de endereço</label>
                                    <input type="number" class="form-control" id="number" name="number" value="{{ $response->address()->get()->first()->number }}" min="0">
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
                                <div class="form-group col-md-3">
                                    <label for="zoom">Zoom</label>
                                    <input type="number" min="0" max="30" class="form-control" id="zoom" name="zoom" value="{{ $response->customer()->get()->first()->m_zoom }}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="icon">Nome do ícone</label>
                                    <input type="text" min="0" max="30" class="form-control" id="icon" name="icon" value="{{ $response->customer()->get()->first()->m_icon }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="box">ID Caixa</label>
                                    <input type="text" min="0" max="30" class="form-control" id="box" name="box" readonly>
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
                        <a class="btn btn-danger" href="{{ route('default.process_stage_two.index') }}" role="button">Cancelar e voltar</a>
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
var gmap;
var iconEvent = 0;
var insertedBuildings = false;
var marker;
var infoWindowMyPos;
var boxesVet = [];
let poly;

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

    @foreach($boxes as $box)
    loadServiceBoxes({lat: {{ $box->m_lat }}, lng: {{ $box->m_lng }}}, {{ $box->amount - $box->busy }}, {{ $box->id }});
    @endforeach

    gmap.setCenter({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}});
    gmap.setZoom(18);
    //gmap.setZoom({{ $response->customer()->get()->first()->m_zoom }});
    iconEvent = '{{ $response->customer()->get()->first()->m_icon }}';
    if (iconEvent == "fas fa-home") {
        createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, "fas fa-home", "M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z");
    } else if (iconEvent == "fas fa-hotel") {
        createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, "fas fa-hotel", "M560 64c8.84 0 16-7.16 16-16V16c0-8.84-7.16-16-16-16H16C7.16 0 0 7.16 0 16v32c0 8.84 7.16 16 16 16h15.98v384H16c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h240v-80c0-8.8 7.2-16 16-16h32c8.8 0 16 7.2 16 16v80h240c8.84 0 16-7.16 16-16v-32c0-8.84-7.16-16-16-16h-16V64h16zm-304 44.8c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4zm0 96c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4zm-128-96c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4zM179.2 256h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4c0 6.4-6.4 12.8-12.8 12.8zM192 384c0-53.02 42.98-96 96-96s96 42.98 96 96H192zm256-140.8c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4zm0-96c0 6.4-6.4 12.8-12.8 12.8h-38.4c-6.4 0-12.8-6.4-12.8-12.8v-38.4c0-6.4 6.4-12.8 12.8-12.8h38.4c6.4 0 12.8 6.4 12.8 12.8v38.4z");
    } else if (iconEvent == "fas fa-building") {
        createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, "fas fa-building", "M436 480h-20V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v456H12c-6.627 0-12 5.373-12 12v20h448v-20c0-6.627-5.373-12-12-12zM128 76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76zm0 96c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40zm52 148h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40c0 6.627-5.373 12-12 12zm76 160h-64v-84c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v84zm64-172c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12v-40c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40zm0-96c0 6.627-5.373 12-12 12h-40c-6.627 0-12-5.373-12-12V76c0-6.627 5.373-12 12-12h40c6.627 0 12 5.373 12 12v40z");
    } else if (iconEvent == "fas fa-hospital") {
        createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, "fas fa-hospital", "M448 492v20H0v-20c0-6.627 5.373-12 12-12h20V120c0-13.255 10.745-24 24-24h88V24c0-13.255 10.745-24 24-24h112c13.255 0 24 10.745 24 24v72h88c13.255 0 24 10.745 24 24v360h20c6.627 0 12 5.373 12 12zM308 192h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm-168 64h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12zm104 128h-40c-6.627 0-12 5.373-12 12v84h64v-84c0-6.627-5.373-12-12-12zm64-96h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zm-116 12c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40zM182 96h26v26a6 6 0 0 0 6 6h20a6 6 0 0 0 6-6V96h26a6 6 0 0 0 6-6V70a6 6 0 0 0-6-6h-26V38a6 6 0 0 0-6-6h-20a6 6 0 0 0-6 6v26h-26a6 6 0 0 0-6 6v20a6 6 0 0 0 6 6z");
    } else if (iconEvent == "fas fa-store") {
        createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, "fas fa-store", "M602 118.6L537.1 15C531.3 5.7 521 0 510 0H106C95 0 84.7 5.7 78.9 15L14 118.6c-33.5 53.5-3.8 127.9 58.8 136.4 4.5.6 9.1.9 13.7.9 29.6 0 55.8-13 73.8-33.1 18 20.1 44.3 33.1 73.8 33.1 29.6 0 55.8-13 73.8-33.1 18 20.1 44.3 33.1 73.8 33.1 29.6 0 55.8-13 73.8-33.1 18.1 20.1 44.3 33.1 73.8 33.1 4.7 0 9.2-.3 13.7-.9 62.8-8.4 92.6-82.8 59-136.4zM529.5 288c-10 0-19.9-1.5-29.5-3.8V384H116v-99.8c-9.6 2.2-19.5 3.8-29.5 3.8-6 0-12.1-.4-18-1.2-5.6-.8-11.1-2.1-16.4-3.6V480c0 17.7 14.3 32 32 32h448c17.7 0 32-14.3 32-32V283.2c-5.4 1.6-10.8 2.9-16.4 3.6-6.1.8-12.1 1.2-18.2 1.2z");
    } else if (iconEvent == "fas fa-warehouse") {
        createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, "fas fa-warehouse", "M504 352H136.4c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0 96H136.1c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8h368c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm0-192H136.6c-4.4 0-8 3.6-8 8l-.1 48c0 4.4 3.6 8 8 8H504c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm106.5-139L338.4 3.7a48.15 48.15 0 0 0-36.9 0L29.5 117C11.7 124.5 0 141.9 0 161.3V504c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V256c0-17.6 14.6-32 32.6-32h382.8c18 0 32.6 14.4 32.6 32v248c0 4.4 3.6 8 8 8h80c4.4 0 8-3.6 8-8V161.3c0-19.4-11.7-36.8-29.5-44.3z");
    } else if (iconEvent == "fas fa-church") {
        createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, "fas fa-church", "M464.46 246.68L352 179.2V128h48c8.84 0 16-7.16 16-16V80c0-8.84-7.16-16-16-16h-48V16c0-8.84-7.16-16-16-16h-32c-8.84 0-16 7.16-16 16v48h-48c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h48v51.2l-112.46 67.48A31.997 31.997 0 0 0 160 274.12V512h96v-96c0-35.35 28.65-64 64-64s64 28.65 64 64v96h96V274.12c0-11.24-5.9-21.66-15.54-27.44zM0 395.96V496c0 8.84 7.16 16 16 16h112V320L19.39 366.54A32.024 32.024 0 0 0 0 395.96zm620.61-29.42L512 320v192h112c8.84 0 16-7.16 16-16V395.96c0-12.8-7.63-24.37-19.39-29.42z");
    } else if (iconEvent == "fas fa-graduation-cap") {
        createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, "fas fa-graduation-cap", "M622.34 153.2L343.4 67.5c-15.2-4.67-31.6-4.67-46.79 0L17.66 153.2c-23.54 7.23-23.54 38.36 0 45.59l48.63 14.94c-10.67 13.19-17.23 29.28-17.88 46.9C38.78 266.15 32 276.11 32 288c0 10.78 5.68 19.85 13.86 25.65L20.33 428.53C18.11 438.52 25.71 448 35.94 448h56.11c10.24 0 17.84-9.48 15.62-19.47L82.14 313.65C90.32 307.85 96 298.78 96 288c0-11.57-6.47-21.25-15.66-26.87.76-15.02 8.44-28.3 20.69-36.72L296.6 284.5c9.06 2.78 26.44 6.25 46.79 0l278.95-85.7c23.55-7.24 23.55-38.36 0-45.6zM352.79 315.09c-28.53 8.76-52.84 3.92-65.59 0l-145.02-44.55L128 384c0 35.35 85.96 64 192 64s192-28.65 192-64l-14.18-113.47-145.03 44.56z");
    } else if (iconEvent == "fas fa-industry") {
        createNewCustomerPoint({lat: {{ $response->customer()->get()->first()->m_lat }}, lng: {{ $response->customer()->get()->first()->m_lng }}}, "fas fa-industry", "M475.115 163.781L336 252.309v-68.28c0-18.916-20.931-30.399-36.885-20.248L160 252.309V56c0-13.255-10.745-24-24-24H24C10.745 32 0 42.745 0 56v400c0 13.255 10.745 24 24 24h464c13.255 0 24-10.745 24-24V184.029c0-18.917-20.931-30.399-36.885-20.248z");
    }
    
    gmap.addListener("click", createNewCableRoute);

    const controlDiv = document.createElement("div");
    createMenuButtonOnMap(controlDiv, gmap);
    gmap.controls[google.maps.ControlPosition.TOP_LEFT].push(controlDiv);
};

function loadServiceBoxes(position, availables, id) {
    var box = new google.maps.Marker({
        position: position,
        map: gmap,
        animation: google.maps.Animation.DROP,
        label: '' + availables,
        icon: {
            path: "M0 512V48C0 21.49 21.49 0 48 0h288c26.51 0 48 21.49 48 48v464L192 400 0 512z",
            fillColor: "#fff",
            fillOpacity: 1,
            strokeWeight: 0,
            scale: 0.05,
            anchor: new google.maps.Point(200,510),
            labelOrigin: new google.maps.Point(205,190)
        }
    });
    boxesVet.push(box);

    box.addListener("click", () => {
        $.each(boxesVet, function(i){
            boxesVet[i].setIcon({
                path: "M0 512V48C0 21.49 21.49 0 48 0h288c26.51 0 48 21.49 48 48v464L192 400 0 512z",
                fillColor: "#fff",
                fillOpacity: 1,
                strokeWeight: 0,
                scale: 0.05,
                anchor: new google.maps.Point(200,510),
                labelOrigin: new google.maps.Point(205,190)
            });
        });
        box.setIcon({
            path: "M0 512V48C0 21.49 21.49 0 48 0h288c26.51 0 48 21.49 48 48v464L192 400 0 512z",
            fillColor: "#32a852",
            fillOpacity: 1,
            strokeWeight: 0,
            scale: 0.08,
            anchor: new google.maps.Point(200,510),
            labelOrigin: new google.maps.Point(205,190)
        });
        $('#box').val(id);
    })
}

function setMapOnAll(map) {
    for (var i = 0; i < boxesVet.length; i++) {
        boxesVet[i].setMap(map);
    }
}

function showMarkers() {
    setMapOnAll(gmap);
}

var pathLine;
var markersLine = [];

function createNewCableRoute(event) {
    pathLine = poly.getPath();
    pathLine.push(event.latLng);
}

function removeItemCableRoute() {
    if(pathLine == null || pathLine.getLength() == 0) {
        return alert('{{ __("There is no value to be removed at this time.") }}');
    } else {
        return pathLine.pop();
    }
}

function createLineOnMap(size, color, dotted, repeat) {
    if (dotted == true) {
        var lineSymbol = {
            path: 'M 0,-1 0,1',
            strokeOpacity: 1,
            scale: size
        };

        poly = new google.maps.Polyline({
            strokeColor: color,
            strokeOpacity: 0,
            icons: [{
                icon: lineSymbol,
                offset: '0',
                repeat: repeat + 'px'
            }]
        });
    } else {
        poly = new google.maps.Polyline({
            geodesic: true,
            strokeColor: color,
            strokeOpacity: 1.0,
            strokeWeight: size
        });
    }
}

function selectCableType(size, color, dotted, repeat) {
    if (poly != null) {
        poly.setMap(null);
        createLineOnMap(size, color, dotted, repeat);
    } else {
        createLineOnMap(size, color, dotted, repeat);
    }
    poly.setMap(gmap);
}

function createNewCustomerPoint(position, iconName, iconPath) {
    marker = new google.maps.Marker({
        position: position,
        map: gmap,
        animation: google.maps.Animation.DROP,
        icon: {
            path: iconPath,
            fillColor: "#fff",
            fillOpacity: 1,
            strokeWeight: 0,
            scale: 0.05,
            anchor: new google.maps.Point(200,510),
            labelOrigin: new google.maps.Point(205,190)
        }
    });
};

function clearMarkers() {
    marker.setMap(null);
    marker = null;
    insertedBuildings = false;
    $('#clearMarker').attr("disabled", true);
    $('#saveMarker').attr("disabled", true);
};

////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////

function createMenuDelRouteOnMap(div, map) {
    const ui = document.createElement("div");
    ui.style.backgroundColor = "#fff";
    ui.style.marginTop = "1vh";
    ui.style.marginLeft = "1vh";
    ui.style.border = "2px solid #fff";
    ui.style.borderRadius = "3px";
    ui.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
    ui.style.cursor = "pointer";
    ui.style.marginBottom = "22px";
    ui.style.textAlign = "center";
    ui.title = "Click to open menu";
    div.appendChild(ui);

    const text = document.createElement("div");
    text.style.color = "rgb(25,25,25)";
    text.style.fontFamily = "Roboto,Arial,sans-serif";
    text.style.fontSize = "16px";
    text.style.lineHeight = "38px";
    text.style.paddingLeft = "5px";
    text.style.paddingRight = "5px";
    text.innerHTML = "{{ __('Delete Last Item Route') }}";
    ui.appendChild(text);

    ui.addEventListener("click", () => {
        removeItemCableRoute();
    });
}

function createMenuButtonOnMap(div, map) {
    const ui = document.createElement("div");
    ui.style.backgroundColor = "#fff";
    ui.style.marginTop = "1vh";
    ui.style.marginLeft = "1vh";
    ui.style.border = "2px solid #fff";
    ui.style.borderRadius = "3px";
    ui.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
    ui.style.cursor = "pointer";
    ui.style.marginBottom = "22px";
    ui.style.textAlign = "center";
    ui.title = "Click to open menu";
    div.appendChild(ui);

    const text = document.createElement("div");
    text.style.color = "rgb(25,25,25)";
    text.style.fontFamily = "Roboto,Arial,sans-serif";
    text.style.fontSize = "16px";
    text.style.lineHeight = "38px";
    text.style.paddingLeft = "5px";
    text.style.paddingRight = "5px";
    text.innerHTML = "Menu";
    ui.appendChild(text);

    ui.addEventListener("click", () => {
        $("#wrapper").toggleClass("toggled");
    });
}

function showAlertSave() {
    $('#alertSave').modal('show')
}

function changeMapType(target, mapType, htmlText) {
    gmap.setMapTypeId(mapType);
    $("#"+target).html(htmlText);
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