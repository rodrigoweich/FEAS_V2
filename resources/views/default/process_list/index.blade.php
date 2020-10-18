@extends('layouts.app')

@section('extra-header')
<link href="{{ asset('vendor/css/process-timeline.css') }}" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>
<style>
</style>
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
                            <span class="align-middle">&nbsp;&nbsp;Lista de processos</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('default.list.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="Pesquise por cliente, usuário que iniciou ou usuário que finalizou (se houver)">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('default.process_list.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fas fa-undo-alt"></i></a>
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
                                    <th>Estágio do processo</th>
                                    <th>Cliente</th>
                                    <th>Iniciado por</th>
                                    <th>Finalizado por</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $data->id }}</td>
                                    <td class="align-middle">
                                        @if($data->stage === 0)
                                        <ul class="timeline" id="timeline" data-toggle="tooltip" data-placement="top" title="Processo em andamento: comercial / Iniciado por: {{ $user->find($data->users_id)->name }}"> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Comercial</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Viabilidade</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Operacional</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Técnico</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Suporte</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Finalizado</h4> </div> </li> </ul>
                                        @elseif($data->stage === 1)
                                        <ul class="timeline" id="timeline"> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Comercial</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Viabilidade</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Operacional</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Técnico</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Suporte</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Finalizado</h4> </div> </li> </ul>
                                        @elseif($data->stage === 2)
                                        <ul class="timeline" id="timeline"> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Comercial</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Viabilidade</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Operacional</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Técnico</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Suporte</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Finalizado</h4> </div> </li> </ul>
                                        @elseif($data->stage === 3)
                                        <ul class="timeline" id="timeline"> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Comercial</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Viabilidade</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Operacional</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Técnico</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Suporte</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Finalizado</h4> </div> </li> </ul>
                                        @elseif($data->stage === 4)
                                        <ul class="timeline" id="timeline"> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Comercial</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Viabilidade</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Operacional</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Técnico</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Suporte</h4> </div> </li> <li class="li"> <div class="timestamp"> </div> <div class="status"> <h4>Finalizado</h4> </div> </li> </ul>
                                        @elseif($data->stage === 5)
                                        <ul class="timeline" id="timeline"> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Comercial</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Viabilidade</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Operacional</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Técnico</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Suporte</h4> </div> </li> <li class="li complete"> <div class="timestamp"> </div> <div class="status"> <h4>Finalizado</h4> </div> </li> </ul>
                                        @else
                                            Informação indefinida
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $customer->find($data->customers_id)->name }} {{ Str::limit($customer->find($data->customers_id)->surname, 15) }}</td>
                                    <td class="align-middle">{{ Str::limit($user->find($data->users_id)->name, 30) }}</td>
                                    <td class="align-middle">
                                        @if($data->users_id_finished === null)
                                            Em andamento
                                        @else
                                            {{ Str::limit($user->find($data->users_id_finished)->name, 30) }}
                                        @endif
                                    </td>
                                    @can('list-general-process')
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                                <a href="{{ route('default.process_list_show.show', $data->id) }}"><button type="button" class="button-without-style mr-1" data-toggle="tooltip" data-placement="top" title="Visualizar cliente"><i class="fas text-dark fa-eye fa-lg"></i></button></a>
                                        </div>
                                    </td>
                                    @endcan
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

<div>

</div>

@endsection

@section('extra-scripts')
<script type='text/javascript'>
    $(".assda").tooltip({
        html:true,
        container: 'body'
    });
</script>
@endsection