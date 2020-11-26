@extends('layouts.app')

@section('extra-header')
<script src="{{ config('global.type_asset')('js/select2.js') }}"></script>
<link href="{{ config('global.type_asset')('css/select2.css') }}" rel="stylesheet">
@endsection

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        @if(Storage::disk('public')->exists($user->avatar))
        <span><img id="prevImg" src="{{ config('global.type_asset')('/storage/'.Auth::user()->avatar) }}" alt="Avatar" class="avatar-image shadow-lg" style="width: 130px; height: 130px"></span>
        @else
        <span><img id="prevImg" src="{{ config('global.type_asset')('img/users/avatar.png') }}" alt="Avatar" class="avatar-image shadow-lg" style="width: 130px; height: 130px"></span>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header text-center">Perfil de {{ $user->name }}</div>

                <div class="card-body">

                    <form action="{{ route('users.profile.update', $user) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputname">Nome</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $user->name }}" autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputemail">E-Mail</label>
                                <input type="email" class="form-control" id="inputemail" name="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputpassword">Senha atual</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="currentPw" id="currentPw" autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('Show password') }}" onclick="showPassword('currentPw')"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputpassword">Nova senha</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="newPw" id="newPw" autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('Generate password') }}" onclick="gerarPassword()"><i class="fas fa-key"></i></button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('Show password') }}" onclick="showPassword('newPw')"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputpassword">Confirmação nova senha</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="confirmNewPw" id="confirmNewPw" autofocus>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" data-toggle="tooltip" data-placement="top" title="{{ __('Show password') }}" onclick="showPassword('confirmNewPw')"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imgInp" name="avatar_image" lang="{{ str_replace('_', '-', app()->getLocale()) }}" accept="image/*">
                                    <label class="custom-file-label" for="imgInp" id="imgLInp">Escolher foto de perfil</label>
                                </div>
                            </div>
                        </div>
                        @if($user->roles()->count() >= 1)
                        <div class="form-row">
                            <div class="form-group col-md-12 text-justify">
                                <span>Suas funções:</span><br/>
                                <ol> @foreach(auth()->user()->roles as $role) <li> <strong>{{ $role->name }}</strong> </li> <ol class="row"> @foreach($role->rules as $rule) <li class="list-item col-6"> {{ $rule->display_name }} </li> @endforeach </ol> @endforeach </ol>
                            </div>
                        </div>
                        @endif

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
                            <a class="btn btn-danger" href="{{ route('home') }}" role="button" data-toggle="tooltip"
                            data-placement="top" title="Cancelar e voltar"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-primary">Atualizar perfil</button>
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
    function showPassword(inputId) {
        if($('#'+inputId).is("input:text")) {
            $('#'+inputId).attr('type', 'password');
        } else if($('#'+inputId).is('input:password')) {
            $('#'+inputId).attr('type', 'text');
        };
    };

    function mostrarPassword() {
        if($("#inputPasswd").is("input:text")) {
            $("#inputPasswd").attr("type", "password");
        } else if($("#inputPasswd").is("input:password")) {
            $("#inputPasswd").attr("type", "text");
        }
    };
    function gerarPassword() {
        var password_gen = Math.random().toString(36).slice(-10);
        document.getElementById("newPw").value = password_gen;
        document.getElementById("confirmNewPw").value = password_gen;
    };
</script>

<script type='text/javascript'>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
        $('img#prevImg').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
$("#imgInp").change(function() {
    readURL(this);
    var file = $(this)[0].files[0]
    if (file){
        $('#imgLInp').html(file.name);
    }
});

$("#buttonPassword").click(function(){
    $('#showPasswordModal').modal('show');
})
</script>
@endsection