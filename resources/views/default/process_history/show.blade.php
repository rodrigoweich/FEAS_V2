@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-notify-3.1.3/bootstrap-notify.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2-bootstrap4.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('vendor/js/gmaps.js') }}"></script>
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
            <a onclick="showAlertSave()" class="list-group-item list-group-item-action bg-light">Visualizar informações<span class="float-right"><i class="fas fa-map-marked"></i></span></a>
            <a href="{{ route('default.process_history.index') }}" class="list-group-item list-group-item-action bg-light text-danger">Voltar<span class="float-right"><i class="far fa-hand-point-left"></i></span></a>
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

                <form action="{{ route('default.process_stage_one.update', $response) }}" method="post">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" id="route" name="route">
                    <input type="hidden" id="cable_id" name="cable_id">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputname">Nome</label>
                                    <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->name }}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="phone">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $response->phone }}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contract_number">Número do contrato</label>
                                    <input type="number" class="form-control" id="contract_number" name="contract_number" min="0" value="{{ $response->contract_number }}" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="number">Número do endereço</label>
                                    <input type="number" class="form-control" id="number" name="number" value="{{ $response->address()->get()->first()->number }}" min="0" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_description">Descrição do endereço</label>
                                    <input type="text" class="form-control" id="end_description" name="end_description" value="{{ $response->address()->get()->first()->end_description }}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="complement">Complemento do endereço</label>
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
                            <input type="hidden" class="form-control" id="lat" name="lat" value="{{ $response->m_lat }}" readonly>
                            <input type="hidden" class="form-control" id="lng" name="lng" value="{{ $response->m_lng }}" readonly>
                            <input type="hidden" min="0" max="30" class="form-control" id="zoom" name="zoom" value="{{ $response->m_zoom }}" readonly>
                            <input type="hidden" class="form-control" id="icon" name="icon" value="{{ $response->m_icon }}" readonly>
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar essa janela</button>
                        <a class="btn btn-success" href="{{ route('default.process_history.index') }}" role="button">Voltar</a>
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
@endsection

@section('extra-scripts')
@if(config('global.google_maps_key'))
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('global.google_maps_key') }}&callback=initMap" async defer></script>
@endif

<script type="text/javascript"> $(".selectTwo").select2({ theme: "bootstrap4" }); </script>

<script type='text/javascript'>
// FUNÇÃO QUE VAI SELECIONAR A FONTE QUE REPRESENTA O CLIENTE
function selectCustomerMarker() {
    createNewCustomerPoint({lat: {{ $response->m_lat }}, lng: {{ $response->m_lng }}}, selectCustomerIconPath("{{ $response->m_icon }}"));
    gmap.setCenter({lat: {{ $response->m_lat }}, lng: {{ $response->m_lng }}});
    gmap.setZoom({{ $response->m_zoom }});
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
@endsection