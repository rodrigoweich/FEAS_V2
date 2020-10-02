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
                    {{ __('Edit existing') }}
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-3">
            <div class="card shadow-sm">

                <div class="card-body">
                    <form action="{{ route('default.process_stage_three.update', $response) }}" method="post">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputname">{{ __('Process client') }}</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->customer()->get()->first()->name }} {{ $response->customer()->get()->first()->surname }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputname">{{ __('Address number') }}</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->address()->get()->first()->number }}" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="city">{{ __('Address city') }}</label>
                                <select name="city" id="city" class="form-control selectTwo" style="width: 100%" disabled>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" @if($response->address()->get()->first()->cities_id == $city->id) selected @endif>{{ __($city->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputname">{{ __('Address description') }}</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->address()->get()->first()->end_description }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputname">{{ __('Address complement') }}</label>
                                <input type="text" class="form-control" id="inputname" name="name" value="{{ $response->address()->get()->first()->complement }}" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="responsible_id">{{ __('Send process to user') }}:</label>
                                <select name="responsible_id" class="mselectRules form-control">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ __($user->name) }}</option>
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
                            <a class="btn btn-detail" href="{{ route('default.process_stage_three.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Cancel and return') }}"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                            <button type="submit" class="btn btn-detail">{{ __('Send') }}</button>
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