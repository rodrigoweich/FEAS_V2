@extends('layouts.app')

@section('navbar')
@component('components.navbar')
@endcomponent
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="row row-cols-2 row-cols-md-5 col-md-10 text-center">
            @can('list-users')
            <div class="col mb-4">
                <div class="card h-100 rounded-05">
                    <a href="{{ route('admin.users.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Users') }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card h-100 rounded-05">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-tags fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Roles') }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
        </div>
    
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
