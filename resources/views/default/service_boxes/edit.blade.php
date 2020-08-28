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
                    <span class="float-right"><i class="fas fa-map"></i></span> <span id="mapTypesDpMenu">Default + Satellite</span> <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'roadmap', 'Default')">
                        {{ __('Default') }}
                    </a>
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'satellite', 'Satellite')">
                        {{ __('Satélite') }}
                    </a>
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'terrain', 'Default + Terrain')">
                        {{ __('Default + Terrain') }}
                    </a>
                    <a class="dropdown-item" onclick="changeMapType('mapTypesDpMenu', 'hybrid', 'Default + Satellite')">
                        {{ __('Default + Satellite') }}
                    </a>
                </div>
            </div>
            <a onclick="showAlertSave()" class="list-group-item list-group-item-action bg-light">{{ __('Save modifications') }}<span class="float-right"><i class="fas fa-map-marked"></i></span></a>
            <a href="{{ route('default.boxes.index') }}" class="list-group-item list-group-item-action bg-light text-danger">{{ __('Cancel and return') }}<span class="float-right"><i class="far fa-hand-point-left"></i></span></a>
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
                <h5 class="modal-title">{{ __('Service box information') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('default.boxes.update', $data) }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputname">{{ __('Name') }}</label>
                                    <input type="text" class="form-control" id="inputname" name="name" value="{{ $data->name }}" autofocus>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="city">{{ __('City') }}</label>
                                    <select name="city" class="form-control selectTwo" style="width: 100%">
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}" @if($city->id == $data->cities_id) selected @endif>{{ __($city->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="lat">Latitude</label>
                                    <input type="text" class="form-control" id="lat" name="lat" value="{{ $data->m_lat }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lng">Longitude</label>
                                    <input type="text" class="form-control" id="lng" name="lng" value="{{ $data->m_lng }}" readonly>
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
                        <a class="btn btn-danger" href="{{ route('default.boxes.index') }}" role="button">{{ __('Cancel and return') }}</a>
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Close this window') }}</button>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="alertDeleteElement">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Service box information') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-justify">
                Você só pode inserir uma posição/construção por viabilidade!
                Para alterar a posição/construção você precisa deletar a posição/construção inserida anteriormente.
                Você realmente deseja prosseguir?
                </p>
                <span class="float-right">
                    <button class="btn btn-danger" onclick="clearMarkers();" data-dismiss="modal">{{ __('Yes, delete') }}</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Cancel and close this window') }}</button>
                </span>
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
var marker;
var infoWindowMyPos;

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

    gmap.setCenter({lat: {{ $data->m_lat }}, lng: {{ $data->m_lng }}});
    gmap.setZoom(14);
    createNewBoxPoint({lat: {{ $data->m_lat }}, lng: {{ $data->m_lng }}});

    appendListenerOnMap();
};

function appendListenerOnMap() {
    gmap.addListener('click', function(event) {
        createNewBoxPoint(event.latLng);
    });
};

function createNewBoxPoint(position) {
    if (insertedBuildings == false) {
        marker = new google.maps.Marker({
            position: position,
            map: gmap,
            animation: google.maps.Animation.DROP,
            icon: {
                path: "M0 512V48C0 21.49 21.49 0 48 0h288c26.51 0 48 21.49 48 48v464L192 400 0 512z",
                fillColor: "#fff",
                fillOpacity: 1,
                strokeWeight: 0,
                scale: 0.03,
                anchor: new google.maps.Point(200,510),
                labelOrigin: new google.maps.Point(205,190)
            }
        });
        insertedBuildings = true;
        $('#clearMarker').removeAttr('disabled');
        $('#saveMarker').removeAttr('disabled');
        $('#lat').val(marker.getPosition().lat());
        $('#lng').val(marker.getPosition().lng());
        if (infoWindowMyPos == true) {
            infoWindowMyPos.close(gmap);
        }
    } else {
        $('#alertDeleteElement').modal('show');
    }
}

function clearMarkers() {
    marker.setMap(null);
    marker = null;
    insertedBuildings = false;
    $('#clearMarker').attr("disabled", true);
    $('#saveMarker').attr("disabled", true);
};

function showAlertSave() {
    $('#alertSave').modal('show')
};

function changeMapType(target, mapType, htmlText) {
    gmap.setMapTypeId(mapType);
    $("#"+target).html(htmlText);
};
</script>
@endsection