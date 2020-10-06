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
                            <span class="align-middle">&nbsp;&nbsp;Usuários</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('admin.users.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="Pesquise por nome ou e-mail">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisar"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('admin.users.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fas fa-undo-alt"></i></a>
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
                    @can('create-users')
                    <div class="row">
                        <div class="col text-right">
                            <a class="btn btn-detail btn-sm" href="{{ route('admin.users.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="Criar um novo">
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
                                    <th></th>
                                    <th>Nome</th>
                                    <th>E-Mail</th>
                                    <th>Função</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $user->id }}</td>
                                    <td class="align-middle">
                                        @if(Storage::disk('public')->exists($user->avatar))
                                            <img id="prevImg" src="{{ config('global.type_asset')('/storage/'.$user->avatar) }}" alt="Avatar" class="avatar-image">
                                        @else
                                            <img id="prevImg" src="{{ config('global.type_asset')('img/users/avatar.png') }}" alt="Avatar" class="avatar-image">
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">
                                        @if ($user->roles()->count() > 1)
                                            <span data-toggle="tooltip" data-placement="top" title="{{ __(implode(', ', $user->roles()->get()->pluck('name')->toArray())) }}">{{ __($user->roles()->get()->pluck('name')->min()) }} e {{ $user->roles()->count()-1 }} outras</span>
                                        @elseif ($user->roles()->count() < 1)
                                            <i class="fas text-danger fa-times fa-lg"></i>
                                        @else
                                            <span data-toggle="tooltip" data-placement="top" title="{{ __(implode(', ', $user->roles()->get()->pluck('name')->toArray())) }}">{{ __(implode(', ', $user->roles()->get()->pluck('name')->toArray())) }}</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                            @can('update-users')
                                                @if(!($user->unalterable === 1))
                                                <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="button-without-style mr-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas text-dark fa-edit fa-lg"></i></button></a>
                                                @endif
                                            @endcan
                                            @can('delete-users')
                                                @if(!($user->unalterable === 1))
                                                    <form id="dataIds_{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
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
                                {{ $users->onEachSide(1)->links() }}
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="align-middle">Mostrando {{ $users->count() }} de {{ $users->total() }} resultados</span>
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
                message: "Você não pode deletar este usuário pois existem processos vinculados a ele."
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