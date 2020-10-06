@extends('layouts.app')

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
                            <span class="align-middle">&nbsp;&nbsp;Clientes</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('default.customers.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="Pesquise por nome, telefone, número de contrato e cidade">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('default.customers.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fas fa-undo-alt"></i></a>
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
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center" style="height: 100px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Ícone</th>
                                    <th>Telefone</th>
                                    <th>Contrato</th>
                                    <th>Cidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $data->customer_id }}</td>
                                    <td class="align-middle">{{ $data->customer_name }} {{ $data->customer_surname }}</td>
                                    <td class="align-middle">
                                        <i class="{{ $data->customer_icon }} fa-lg"></i>
                                    </td>
                                    <td class="align-middle">{{ $data->customer_phone }}</td>
                                    <td class="align-middle">{{ $data->customer_contract }}</td>
                                    <td class="align-middle">{{ $data->city_name }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                            @can('show-customers')
                                                <a href="{{ route('default.customers.show', $data->customer_id) }}" data-toggle="tooltip" data-placement="top" title="Visualizar"><button type="button" class="button-without-style mr-1"><i class="fas text-dark fa-eye fa-lg"></i></button></a>
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