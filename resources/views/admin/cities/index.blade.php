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

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <a class="btn button-without-style btn-sm" href="{{ route('home') }}" role="button" data-toggle="tooltip" data-placement="top" title="Retonar ao app">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;Cidades</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('admin.cities.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control" placeholder="Pesquise por nome ou estado">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fas fa-search"></i></button>
                                        <a class="btn btn-outline-secondary" href="{{ route('admin.cities.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fas fa-undo-alt"></i></a>
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
                        @can('create-roles')
                            <a class="btn btn-detail btn-sm" href="{{ route('admin.cities.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="Criar nova cidade">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Estado</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Zoom</th>
                                    <th>Atalho</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row">{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $state->find($data->states_id)->name }}</td>
                                    <td>{{ $data->m_lat }}</td>
                                    <td>{{ $data->m_lng }}</td>
                                    <td>{{ $data->m_zoom }}</td>
                                    <td>
                                        @if($data->shortcut === 1)
                                        <i class="fas text-success fa-check fa-lg"></i>
                                        @else
                                        <i class="fas text-danger fa-times fa-lg"></i>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                        @can('update-cities')
                                            <a href="{{ route('admin.cities.edit', $data->id) }}"><button type="button" class="button-without-style mr-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas text-dark fa-edit fa-lg"></i></button></a>
                                            
                                        @endcan
                                        @can('delete-cities')
                                        <form id="dataIds_{{ $data->id }}" action="{{ route('admin.cities.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button id="del-perm" type="submit" class="button-without-style ml-1" data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas text-dark fa-trash fa-lg"></i></button>
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
@endsection

@section('extra-scripts')
<script type='text/javascript'>
@foreach($hasProcesses as $key => $h)
    $("#dataIds_" + {{ $key }}).click(function(e) {
        if({{ $h }} != 0) {
            e.preventDefault();
            e.stopPropagation();
            $.notify({
                message: "Você não pode deletar esta cidade pois existem processos vinculados a ela."
            }, {
                type: "danger"
            });
        } else {
            if(confirm("Deseja mesmo deletar?")) {} else {
                return false;
            }
        }
    });
@endforeach
</script>
@endsection