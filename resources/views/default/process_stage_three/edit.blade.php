@extends('layouts.app')

@section('extra-header')
<script src="{{ asset('js/select2.js') }}"></script>
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('css/select2-bootstrap4.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('vendor/js/jquery.mask.js') }}"></script>
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
                            <a class="btn button-without-style btn-sm" href="{{ route('default.process_stage_three.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Voltar a página de processos">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;Editar processo existente</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">

                <div class="card-body">
                    <form id="thisForm" action="{{ route('default.process_stage_three.update', $response) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputname">Cliente</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->customer()->get()->first()->name }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputname">Número do endereço</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->address()->get()->first()->number }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="city">Cidade</label>
                                <select name="city" id="city" class="form-control selectTwo" style="width: 100%" disabled>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" @if($response->address()->get()->first()->cities_id == $city->id) selected @endif>{{ __($city->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputname">Descrição do endereço</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->address()->get()->first()->end_description }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputname">Complemento do endereço</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->address()->get()->first()->complement }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="responsible_id">Enviar o processo para o usuário:</label>
                                <select name="responsible_id" class="mselectRules form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                            <a class="btn btn-detail" href="{{ route('default.process_stage_three.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-detail">Enviar processo</button>
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
    $(".mselectRules").select2({
        theme: "bootstrap4"
    });
</script>

<script type="text/javascript">
// VALIDAÇÕES E MÁSCARAS
$("#phone").mask('(00) 00000-0000');

$("#thisForm").submit(function() {
  $("#phone").unmask();
});
</script>
@endsection