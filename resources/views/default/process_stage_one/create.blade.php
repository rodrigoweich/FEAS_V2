@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
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
            <div id="divider">
                <a id="navbarDropdown" class="nav-link dropdown-toggle list-group-item list-group-item-action bg-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="float-right"><i class="fas fa-map-marker"></i></span> <span id="mapTypesDpMenu">Cidade atalho</span> <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @foreach ($shortcuts as $shortcut)
                    <a class="dropdown-item" onclick="changeFeaturedCity({{ $shortcut->m_lat }}, {{ $shortcut->m_lng }}, {{ $shortcut->m_zoom }}, {{ $shortcut->id }})">
                        {{ $shortcut->name }}
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
                        Industria<span class="float-right"><i class="fas fa-industry"></i></span>
                    </a>
                </div>
            </div>
            <a onclick="getMyCurrentPosition();" class="list-group-item list-group-item-action bg-light">Posição atual<span class="float-right"><i class="fas fa-compass"></i></span></a>
            <a onclick="showAlertSave()" class="list-group-item list-group-item-action bg-light">Iniciar processo<span class="float-right"><i class="fas fa-map-marked"></i></span></a>
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

                <form id="thisForm" action="{{ route('default.process_stage_one.store') }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputname">Nome</label>
                                    <input type="text" class="form-control" id="inputname" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="phone">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="(00) 00000-0000" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contract_number">Número de contrato</label>
                                    <input type="number" class="form-control" id="contract_number" name="contract_number" min="0" max="2147483647" value="{{ old('contract_number') }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="number">Número de endereço</label>
                                    <input type="number" class="form-control" id="number" name="number" max="2147483647" value="{{ old('number') }}" min="0">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_description">Descrição de endereço</label>
                                    <input type="text" class="form-control" id="end_description" name="end_description" value="{{ old('end_description') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="complement">Complemento de endereço</label>
                                    <input type="text" class="form-control" id="complement" name="complement" value="{{ old('complement') }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="city">Cidade</label>
                                    <select name="city" id="city" class="form-control selectTwo" style="width: 100%">
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ __($city->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" class="form-control" id="lat" name="lat" value="{{ old('lat') }}" readonly>
                            <input type="hidden" class="form-control" id="lng" name="lng" value="{{ old('lng') }}" readonly>
                            <input type="hidden" min="0" max="30" class="form-control" id="zoom" name="zoom" value="{{ old('zoom') }}" readonly>
                            <input type="hidden" class="form-control" id="icon" name="icon" value="{{ old('icon') }}" readonly>
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
                        <button type="submit" class="btn btn-success">Iniciar processo</button>
                    </span>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="alertDeleteElement">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> OPPSSS!!!!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Você só pode definir um local por viabilidade, para alterar, o ponto indicado terá de ser removido.<br>Deseja remover mesmo assim?</p>

                <span class="float-right">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar e fechar essa janela</button>
                    <button class="btn btn-danger" onclick="clearMarkers();" data-dismiss="modal">Sim, remover</button>
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

<script type="text/javascript"> $(".selectTwo").select2({ theme: "bootstrap4" }); </script>

<script type='text/javascript'>
var iconEvent = "fas fa-home";

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
        if (iconEvent == "fas fa-home") {
            createNewCustomerPointOne(event.latLng, "fas fa-home", selectCustomerIconPath("fas fa-home"));
        } else if (iconEvent == "fas fa-hotel") {
            createNewCustomerPointOne(event.latLng, "fas fa-hotel", selectCustomerIconPath("fas fa-hotel"));
        } else if (iconEvent == "fas fa-building") {
            createNewCustomerPointOne(event.latLng, "fas fa-building", selectCustomerIconPath("fas fa-building"));
        } else if (iconEvent == "fas fa-hospital") {
            createNewCustomerPointOne(event.latLng, "fas fa-hospital", selectCustomerIconPath("fas fa-hospital"));
        } else if (iconEvent == "fas fa-store") {
            createNewCustomerPointOne(event.latLng, "fas fa-store", selectCustomerIconPath("fas fa-store"));
        } else if (iconEvent == "fas fa-warehouse") {
            createNewCustomerPointOne(event.latLng, "fas fa-warehouse", selectCustomerIconPath("fas fa-warehouse"));
        } else if (iconEvent == "fas fa-church") {
            createNewCustomerPointOne(event.latLng, "fas fa-church", selectCustomerIconPath("fas fa-church"));
        } else if (iconEvent == "fas fa-graduation-cap") {
            createNewCustomerPointOne(event.latLng, "fas fa-graduation-cap", selectCustomerIconPath("fas fa-graduation-cap"));
        } else if (iconEvent == "fas fa-industry") {
            createNewCustomerPointOne(event.latLng, "fas fa-industry", selectCustomerIconPath("fas fa-industry"));
        }
    });
};

function changeFeaturedCity(lat, lng, zoom, id) {
    gmap.setCenter({lat, lng});
    gmap.setZoom(zoom);
    $('.selectTwo').val(id);
    $('.selectTwo').trigger('change');
};

function handleLocationError(browserHasGeolocation, infoWindowMyPos, pos) {
    infoWindowMyPos.setPosition(pos);
    infoWindowMyPos.setContent(browserHasGeolocation ?
                            'Error: The Geolocation service failed.' :
                            'Error: Your browser doesn\'t support geolocation.');
    infoWindowMyPos.open(gmap);
}

function getMyCurrentPosition() {
    infoWindowMyPos = new google.maps.InfoWindow;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            infoWindowMyPos.setPosition(pos);
            infoWindowMyPos.setContent('Você está aqui!');
            infoWindowMyPos.open(gmap);
            gmap.setCenter(pos);
            gmap.setZoom(20);
        }, function() {
            handleLocationError(true, infoWindowMyPos, gmap.getCenter());
        });
    } else {
        handleLocationError(false, infoWindowMyPos, gmap.getCenter());
    }
}

////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////

function changeMapType(target, mapType, htmlText) {
    gmap.setMapTypeId(mapType);
    $("#"+target).html(htmlText);
};

@if($errors->any())
    $('.selectTwo').val({{ old('city') }});
    $('.selectTwo').trigger('change');
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