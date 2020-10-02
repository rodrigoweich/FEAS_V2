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
                    Editar notícia existente
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.notices.update', $data) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputtitle">Título</label>
                                <input type="text" class="form-control" id="inputtitle" name="title" value="{{ $data->title }}" autofocus required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="textareadescription">Descrição</label>
                                <textarea class="form-control" id="textareadescription" rows="5" name="description" autofocus>{{ $data->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="inputfeatured" name="featured" @if($data->featured == 1) checked @endif>
                                    <label class="custom-control-label" id="inputfeaturedlabel" for="inputfeatured">Deseja tornar essa notícia importante?</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="inputstatus" name="active" @if($data->active == 1) checked @endif>
                                    <label class="custom-control-label" id="inputstatuslabel" for="inputstatus">Ela está ativa?</label>
                                </div>
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
                            <a class="btn btn-detail" href="{{ route('admin.notices.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="Cancelar e voltar"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-detail">Aplicar mudanças</button>
                        </span>
                    </form>

                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection