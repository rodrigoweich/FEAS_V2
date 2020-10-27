@extends('layouts.app')

@section('extra-header')
<link href="{{ asset('vendor/farbtastic/farbtastic.css') }}" rel="stylesheet">
@endsection

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <a class="btn button-without-style btn-sm" href="{{ route('default.cables.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Return to app') }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;Editar cabo existente</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('default.cables.update', $cable) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputname">Nome</label>
                                        <input type="text" class="form-control" id="inputname" name="name" value="{{ $cable->name }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="lat">Cor do cabo</label>
                                        <input class="form-control" type="text" id="color" name="color" value="{{ $cable->color }}" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputsize">Tamanho</label>
                                        <input type="number" min="2" max="6" class="form-control" id="inputsize" name="size" value="{{ $cable->size }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="inputshortcut" name="inputshortcut" @if($cable->dotted == 1) checked @endif>
                                            <label class="custom-control-label" id="labelforshortcut" for="inputshortcut">Pontilhado: Sim/Não</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="dotted_repeat" @if($cable->dotted == 0 )class="not-display" @endif>
                                    <div class="form-row">
                                        <hr class="solid">
                                        <div class="form-group col-md-12">
                                            <label for="inputrepeat">Espaçamento</label>
                                            <input type="number" min="12" max="35" class="form-control" id="inputrepeat" name="repeat" value="{{ $cable->dotted_repeat }}" autofocus>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div id="colorpicker"></div>
                                </div>
                            </div>
                            <div class="col">
                                @if(!config('global.google_maps_key'))
                                <div class="container my-5 alert alert-danger">
                                    <h6 class="m-0 text-justify"><i class="fas fa-exclamation-triangle"></i> Foram encontradas inconsistências na sua chave de acesso do Google Maps API. Por favor, verifique a sua chave e tente novamente.</h6>
                                </div>
                                @else
                                <div id="gmap" class="shadow-lg rounded" style="height: 30vh;"></div>
                                @endif
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
                            <a class="btn btn-detail" href="{{ route('default.cables.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-detail">Salvar alterações</button>
                        </span>
                    </form>

                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="{{ asset('vendor/farbtastic/farbtastic.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#colorpicker').farbtastic('#color');
    });
</script>
<script type='text/javascript'>
    $('#inputshortcut').ready(function () {
        return checkStatus();
    });
    $('#inputshortcut').click(function () {
        return checkStatus();
    });

    function checkStatus() {
        if ($('#inputshortcut').is(":checked")) {
            $('#labelforshortcut').html('Pontilhado: sim');
        } else {
            $('#labelforshortcut').html('Pontilhado: não');
        }
    }
</script>
<script type='text/javascript'>
    $('#inputshortcut').click(function () {
        if ($(this).is(':checked')) {
            $("#dotted_repeat").removeClass('not-display');
        } else {
            $("#dotted_repeat").addClass('not-display');
        }
    });
</script>

@if(config('global.google_maps_key'))
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('global.google_maps_key') }}&callback=initMap" async defer></script>
@endif

<script>
    var gmap;
    var lineSize = 4;
    var lineColor = '#FF0000';
    var lineDotted = false;
    var lineRepeat = 20;
    var line;
    
    function initMap() {
        gmap = new google.maps.Map(document.getElementById('gmap'), {
            center: {lat: -25.714640, lng: -53.770253},
            mapTypeId: "satellite",
            zoom: 17,
            zoomControl: false,
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
            },
            gestureHandling: 'none'
        });
        createLine(lineSize, lineColor, lineDotted, lineRepeat, lineRepeat);
    };

    function createLine(size, color, dotted, repeat) {
        
        var lineCoordinates = [
          {lat: -25.714019, lng: -53.770141},
          {lat: -25.714594, lng: -53.770807},
          {lat: -25.715437, lng: -53.769833}
        ];
        
        if (dotted == true) {
            var lineSymbol = {
                path: 'M 0,-1 0,1',
                strokeOpacity: 1,
                scale: size
            };

            line = new google.maps.Polyline({
                path: lineCoordinates,
                strokeColor: color,
                strokeOpacity: 0,
                icons: [{
                    icon: lineSymbol,
                    offset: '0',
                    repeat: repeat + 'px'
                }]
            });
        } else {
            line = new google.maps.Polyline({
                path: lineCoordinates,
                geodesic: true,
                strokeColor: color,
                strokeOpacity: 1.0,
                strokeWeight: size
            });
        }
        addLine();
    }

    $('#inputsize').click(function () {
        lineSize = $('#inputsize').val();
        removeLine();
        createLine(lineSize, lineColor, lineDotted, lineRepeat, lineRepeat);
    })

    $('#inputrepeat').click(function () {
        lineRepeat = $('#inputrepeat').val();
        removeLine();
        createLine(lineSize, lineColor, lineDotted, lineRepeat, lineRepeat);
    })

    $('#colorpicker').mousemove(function () {
        lineColor = $("#color").val();
        removeLine();
        createLine(lineSize, lineColor, lineDotted, lineRepeat);
    })

    $('#labelforshortcut').click(function () {
        if(lineDotted == false) {
            lineDotted = true;
            removeLine();
            createLine(lineSize, lineColor, lineDotted, lineRepeat);
        } else if(lineDotted == true) {
            lineDotted = false;
            removeLine();
            createLine(lineSize, lineColor, lineDotted, lineRepeat);
        }
    })

    function addLine() {
        line.setMap(gmap);
    }
    function removeLine() {
        line.setMap(null);
    }
</script>
@endsection