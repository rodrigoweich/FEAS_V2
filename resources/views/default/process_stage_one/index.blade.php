@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('vendor/bootstrap-notify-3.1.3/bootstrap-notify.js') }}"></script>
<script src="{{ asset('vendor/js/np_controller.js') }}"></script>
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
                            <a class="btn button-without-style btn-sm" href="{{ route('home') }}" role="button" data-toggle="tooltip" data-placement="top" title="Retornar ao app">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;Processo estágio - 1</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('default.process_stage_one.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="Pesquise por cliente, usuário, cidade ou data (AAAA-MM-DD)">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('default.process_stage_one.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fas fa-undo-alt"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    @can('create-process-stage-one')
                    <div class="row">
                        <div class="col text-right">
                            <a id="create-button" class="btn btn-detail btn-sm" href="{{ route('default.process_stage_one.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="Iniciar um novo processo">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    @endcan
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center" style="height: 100px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Icone</th>
                                    <th>Cidade</th>
                                    <th>Iniciado por</th>
                                    <th>Iniciado em</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $data->id }}</td>
                                    <td class="align-middle">{{ $customer->find($data->customers_id)->name }} {{ $customer->find($data->customers_id)->surname }}</td>
                                    <td class="align-middle"><i class="{{ $customer->find($data->customers_id)->m_icon }} fa-lg"></i></td>
                                    <td class="align-middle">{{ $city->find($address->find($data->customers_id)->cities_id)->name }}</td>
                                    <td class="align-middle">{{ $user->find($data->users_id)->name }}</td>
                                    <td class="align-middle">{{ $data->created_at }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                            <button type="button" class="button-without-style mr-1 get-backed-process-data" this-process-id="{{ $data->id }}" data-toggle="tooltip" data-placement="top" title="Log"><i class="fas text-dark fa-file-alt fa-lg"></i></button>
                                            @can('update-process-stage-one')
                                            <a id="edit-button" href="{{ route('default.process_stage_one.edit', $data->id) }}"><button type="button" class="button-without-style mr-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas text-dark fa-edit fa-lg"></i></button></a>
                                            @endcan
                                            @can('next-process-stage-one')
                                            <a href="{{ route('default.process.next_stage', $data->id) }}"><button type="button" class="button-without-style mr-1" data-toggle="tooltip" data-placement="top" title="Avançar"><i class="fas text-success fa-arrow-right fa-lg"></i></button></a>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        {{ $response->onEachSide(1)->links() }}
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="align-middle">Mostrando {{ $response->count() }} de {{ $response->total() }} resultados</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="finishProcess">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Logs do processo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="tex">
                <table class="table table-ordered table-hover" id="customersTable">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type='text/javascript'>
$("#create-button").click(function(event) {
    @if($hasCities === false)
        event.stopPropagation();
        event.preventDefault();
        $.notify({
            message: "Você só pode iniciar um processo se houver ao menos uma cidade cadastrada no sistema. @can('list-cities')<a href='{{ route('admin.cities.create') }}'>Clique aqui</a> para cadastrar uma. @else Por favor, contate o seu administrador. @endcan"
        }, {
            type: "danger"
        });
    @endif
});

//#########################################//
$('.get-backed-process-data').on('click', function() {
    var id = $(this).attr('this-process-id');
    $.ajax({
        type: "get",
        url: "{{ route('default.process.log') }}",
        data: { id: id },
        success: function(data) {
            if(data.length > 0) {
                $("#customersTable>thead").append('<tr><th>#</th><th>Motivo</th><th>Anterior</th><th>Atual</th><th>Em</th><th>Por</th></tr>');
                for(i=0; i<data.length; i++){
                    linha = montarLinha(data[i]);
                    $('#customersTable>tbody').append(linha);
                }
                $("#finishProcess").modal('show');
            } else {
                $("#customersTable>thead tr").remove();
                $('#tex').append("<span>Sentimos muito, mas esse processo ainda não contém logs.</span>");
                $("#finishProcess").modal('show');
            }
        },
        error: function(data) {
            console.log(data);
        }
    })
});

$("#finishProcess").on('hidden.bs.modal', function () {
    $("#customersTable>thead tr").remove();
    $("#customersTable>tbody tr").remove();
    $("#tex span").remove();
});
</script>
@endsection