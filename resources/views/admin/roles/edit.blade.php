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
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-body">

                    Editar função existente
                    <div id="divider" class="mb-5"></div>

                    <form action="{{ route('admin.roles.update', $role) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputname">Nome</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $role->name }}" autofocus>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rules[]">Autorizações:</label>
                                <select name="rules[]" class="mselectRules form-control" multiple="true">
                                    @foreach($rules as $rule)
                                        <option value="{{ $rule->id }}" @if($role->rules->pluck('id')->contains($rule->id)) selected @endif>{{ __($rule->display_name) }}</option>
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
                            <a class="btn btn-danger" href="{{ route('admin.roles.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-primary">Aplicar mudanças</button>
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
    $(".mselectRules").select2();
</script>
@endsection