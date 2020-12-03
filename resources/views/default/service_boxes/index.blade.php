@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('vendor/bootstrap-notify-3.1.3/bootstrap-notify.js') }}"></script>
@endsection

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @if(Session::has('message'))
        <script type='text/javascript'>
            $.notify({
                message: "{{Session::get('message')}}"
            }, {
                type: "danger"
            });
        </script>
        @endif

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <a class="btn button-without-style btn-sm" href="{{ route('home') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Return to app') }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;Caixas de atendimento</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('default.boxes.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="Pesquise por nome, descrição ou cidade">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('default.boxes.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fas fa-undo-alt"></i></a>
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
                    <div class="row">
                        <div class="col text-right">
                        @can('create-service_boxes')
                            <a class="btn btn-detail btn-sm" href="{{ route('default.boxes.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="Criar uma nova">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center" style="height: 100px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Quantidade</th>
                                    <th>Ocupadas</th>
                                    <th>Disponíveis</th>
                                    <th>Cidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $data->id }}</td>
                                    <td class="align-middle">{{ $data->sb_name }}</td>
                                    <td class="align-middle">{{ $data->description }}</td>
                                    <td class="align-middle">{{ $data->amount }}</td>
                                    <td class="align-middle">{{ $data->busy }}</td>
                                    <td class="align-middle">@if($data->amount - $data->busy < 0)<span class="text-danger">{{ $data->amount - $data->busy }}</span>@elseif($data->amount - $data->busy > 0)<span class="text-success">{{ $data->amount - $data->busy }}</span>@else{{ $data->amount - $data->busy }}@endif</td>
                                    <td class="align-middle">{{ $data->ct_name }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                            <button type="button" class="button-without-style mr-1 get-customers-data" this-box-id="{{ $data->id }}" data-toggle="tooltip" data-placement="top" title="Ver clientes vinculados a essa caixa"><i class="fas text-dark fa-eye fa-lg"></i></button>
                                        @can('update-service_boxes')
                                            <a href="{{ route('default.boxes.edit', $data->id) }}"><button type="button" class="button-without-style mr-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas text-dark fa-edit fa-lg"></i></button></a>
                                        @endcan
                                        @can('delete-service_boxes')
                                        <form id="dataIds_{{ $data->id }}" action="{{ route('default.boxes.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="button-without-style ml-1 testec" data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas text-dark fa-trash fa-lg"></i></button>
                                        </form>
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
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vínculos por caixa</h5>
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
    $('.testec').on('click', function(e) {
        if(!confirm("Deseja mesmo deletar?"))
        {
            return false;
        }
    });
</script>

<script type='text/javascript'>
$('.get-customers-data').on('click', function() {
    var id = $(this).attr('this-box-id');
    $.ajax({
        type: "get",
        url: "{{ route('default.boxes.customers') }}",
        data: { id: id },
        success: function(data) {
            if(data.length > 0) {
                $("#customersTable>thead").append('<tr><th>#</th><th>Nome</th><th>Telefone</th><th>Contrato Nº</th><th>LAT</th><th>LNG</th></tr>');
                for(i=0; i<data.length; i++){
                    linha = montarLinha(data[i]);
                    $('#customersTable>tbody').append(linha);
                }
                $("#finishProcess").modal('show');
            } else {
                $("#customersTable>thead tr").remove();
                $('#tex').append("<span>Sentimos muito, mas essa caixa ainda não tem clientes vinculados.</span>");
                $("#finishProcess").modal('show');
            }
        },
        error: function(data) {
            console.log(data);
        }
    })
});

function montarLinha(p){
    var linha = "<tr>"+
                    "<td>"+ p.id + "</td>"+
                    "<td>"+ p.name + "</td>"+
                    "<td>"+ p.phone + "</td>"+
                    "<td>"+ p.contract_number + "</td>"+
                    "<td>"+ p.m_lat + "</td>"+
                    "<td>"+ p.m_lng + "</td>"+
                "</tr>";
    return linha;
}

$("#finishProcess").on('hidden.bs.modal', function () {
    $("#customersTable>thead tr").remove();
    $("#customersTable>tbody tr").remove();
    $("#tex span").remove();
});
</script>
@endsection