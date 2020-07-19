@extends('layouts.app')

@section('extra-header')
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
<link href="{{ config('global.type_asset')('vendor/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
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
                <div class="card-header">{{ __('Create a new') }}</div>

                <div class="card-body">

                    <form action="{{ route('admin.users.store') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputname">{{ __('Name') }}</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ old('name') }}" autofocus>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputemail">{{ __('E-Mail') }}</label>
                                <input type="email" class="form-control" id="inputemail" name="email" value="{{ old('email') }}" placeholder="{{ __('Unique and cannot be changed') }}" autofocus>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputpassword">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="inputPasswd" autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('Show password') }}" onclick="mostrarPassword()"><i class="fas fa-eye"></i></button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('Generate password') }}" onclick="gerarPassword()"><i class="fas fa-key"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="rules[]">{{ __('Roles') }}:</label>
                                <select name="rules[]" class="mselectRules form-control" multiple="true">
                                    @foreach($rules as $rule)
                                        <option value="{{ $rule->id }}">{{ __($rule->name) }}</option>
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
                            <a class="btn btn-danger" href="{{ route('admin.users.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Cancel and return') }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
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