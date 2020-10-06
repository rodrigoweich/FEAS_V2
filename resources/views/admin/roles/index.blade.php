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
                            <a class="btn button-without-style btn-sm" href="{{ route('home') }}" role="button" data-toggle="tooltip" data-placement="top" title="Retornar ao app">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;Funções</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('admin.roles.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control" placeholder="Pesquise por nome">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fas fa-search"></i></button>
                                        <a class="btn btn-outline-secondary" href="{{ route('admin.roles.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fas fa-undo-alt"></i></a>
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
                            <a class="btn btn-detail btn-sm" href="{{ route('admin.roles.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="Criar uma nova função">
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
                                    <th>Autorizações</th>
                                    <th>Vínculos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td scope="row">{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if ($role->rules()->count() > 1)
                                            <span data-toggle="tooltip" data-placement="top" title="{{ __(implode(', ', $role->rules()->get()->pluck('display_name')->toArray())) }}">{{ __($role->rules()->get()->pluck('display_name')->min()) }} e {{ $role->rules()->count()-1 }} outras</span>
                                        @elseif ($role->rules()->count() < 1)
                                            <i class="fas text-danger fa-times fa-lg"></i>
                                        @else
                                            <span data-toggle="tooltip" data-placement="top" title="{{ __(implode(', ', $role->rules()->get()->pluck('display_name')->toArray())) }}">{{ __(implode(', ', $role->rules()->get()->pluck('display_name')->toArray())) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($role->users()->where('role_id', $role->id)->count() === 0)
                                            <i class="fas text-danger fa-times fa-lg"></i>
                                        @else
                                            {{ $role->users()->where('role_id', $role->id)->count() }}
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                        @can('update-roles')
                                            @if(!($role->unalterable === 1))
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"><button type="button" class="button-without-style mr-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas text-dark fa-edit fa-lg"></i></button></a>
                                            @endif
                                        @endcan
                                        @can('delete-roles')
                                            @if(!($role->unalterable === 1))
                                                <form id="dataIds_{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="button-without-style ml-1" data-toggle="tooltip" data-placement="top" title="Deletar"><i class="fas text-dark fa-trash fa-lg"></i></button>
                                                </form>
                                            @endif
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
                                {{ $roles->onEachSide(1)->links() }}
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="align-middle">Mostrando {{ $roles->count() }} de {{ $roles->total() }} resultados</span>
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
                message: "Você não pode deletar esta função pois existem usuários vinculados a ela."
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