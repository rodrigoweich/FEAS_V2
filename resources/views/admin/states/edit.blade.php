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
                    Editar estado existente
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.states.update', $state) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $state->name }}" autofocus>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="uf">UF</label>
                                <input type="text" class="form-control" id="uf" name="uf" value="{{ $state->uf }}" autofocus>
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
                            <a class="btn btn-detail" href="{{ route('admin.states.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-detail">Aplicar mudanças</button>
                        </span>
                    </form>

                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection