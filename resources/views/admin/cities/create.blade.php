@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2-bootstrap4.css') }}" rel="stylesheet">
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
            <a onclick="showAlertSave()" class="list-group-item list-group-item-action bg-light">Salvar nova cidade<span class="float-right"><i class="fas fa-map-marked"></i></span></a>
            <a href="{{ route('admin.cities.index') }}" class="list-group-item list-group-item-action bg-light text-danger">Cancelar e voltar<span class="float-right"><i class="far fa-hand-point-left"></i></span></a>
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
                <h5 class="modal-title">Informação da cidade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('admin.cities.store') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputname">Nome</label>
                                    <input type="text" class="form-control" id="inputname" name="name" value="{{ old('name') }}" autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="state">Estado</label>
                                    <select name="state" class="form-control selectTwo" style="width: 100%">
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ __($state->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="lat">Latitude</label>
                                    <input type="text" class="form-control" id="lat" name="lat" readonly>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="lng">Longitude</label>
                                    <input type="text" class="form-control" id="lng" name="lng" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="zoom">Zoom</label>
                                    <input type="number" min="0" max="30" class="form-control" id="zoom" name="zoom" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="inputshortcut" name="inputshortcut">
                                        <label class="custom-control-label" id="labelforshortcut" for="inputshortcut">Essa cidade será um atalho?</label>
                                    </div>
                                    <code class="float-left">Função para auxiliar os usuários do sistema.</code>
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
                        <a class="btn btn-danger" href="{{ route('admin.cities.index') }}" role="button">Cancelar e voltar</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar essa janela</button>
                        <button type="submit" class="btn btn-success">Salvar cidade</button>
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

<script type='text/javascript'>
    $(".selectTwo").select2({
        theme: "bootstrap4"
    });

var gmap;
var insertedBuildings = false;

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

    const controlDiv = document.createElement("div");
    createMenuButtonOnMap(controlDiv, gmap);
    gmap.controls[google.maps.ControlPosition.TOP_LEFT].push(controlDiv);

    gmap.addListener('click', function(event) {
        createNewPoint(event.latLng);
    });

    gmap.addListener('zoom_changed', function() {
        $("#zoom").val(gmap.getZoom()).attr('value', gmap.getZoom());
    });

};

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

function createNewPoint(position) {
    if (insertedBuildings == false) {
        marker = new google.maps.Marker({
            position: position,
            map: gmap,
            animation: google.maps.Animation.DROP,
        });
        insertedBuildings = true;
        $("#lat").val(marker.getPosition().lat()).attr('value', marker.getPosition().lat());
        $("#lng").val(marker.getPosition().lng()).attr('value', marker.getPosition().lng());
        $("#zoom").val(gmap.getZoom()).attr('value', gmap.getZoom());
    } else {
        clearMarkers();
        createNewPoint(position);
    }
};

function clearMarkers() {
    marker.setMap(null);
    marker = null;
    insertedBuildings = false;
};

</script>
@endsection