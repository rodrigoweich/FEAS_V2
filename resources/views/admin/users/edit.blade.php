@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
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
                            <a class="btn button-without-style btn-sm" href="{{ route('admin.users.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Voltar a página de usuários">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;Editar usuário existente</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">

                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputname">Nome</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $user->name }}" autofocus>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputemail">E-Mail</label>
                                <input type="email" class="form-control" id="inputemail" name="email" value="{{ $user->email }}" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputpassword">Senha</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="inputPasswd" autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top" title="Mostrar senha" onclick="mostrarPassword()"><i class="fas fa-eye"></i></button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top" title="Gerar senha randômica" onclick="gerarPassword()"><i class="fas fa-key"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rules[]">Função:</label>
                                <select name="rules[]" class="mselectRules form-control" multiple="true">
                                    @foreach($rules as $rule)
                                        <option value="{{ $rule->id }}" @if($user->roles->pluck('id')->contains($rule->id)) selected @endif>{{ __($rule->name) }}</option>
                                    @endforeach
                                </select>
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
                            <a class="btn btn-detail" href="{{ route('admin.users.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-detail">Aplicar mudanças</button>
                        </span>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script type='text/javascript'>
    function mostrarPassword() {
        if($("#inputPasswd").is("input:text")) {
            $("#inputPasswd").attr("type", "password");
        } else if($("#inputPasswd").is("input:password")) {
            $("#inputPasswd").attr("type", "text");
        }
    };
    function gerarPassword() {
        return document.getElementById("inputPasswd").value = Math.random().toString(36).slice(-10);
    }
</script>
<script type='text/javascript'>
    $(".mselectRules").select2();
</script>
@endsection