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
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.users.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Users') }} <span class="badge badge-pill badge-detail">{{ $users }}</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-tags fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Roles') }} <span class="badge badge-pill badge-detail">{{ $roles }}</span>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-city fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Cities') }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-flag fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('States') }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-bullhorn fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Notices') }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-chart-pie fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Reports') }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-microchip fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Proccess') }} - 1
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-microchip fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Proccess') }} - 2
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-microchip fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Proccess') }} - 3
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-microchip fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Proccess') }} - 4
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-minus fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Cables') }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-bookmark fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Boxes') }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            @endcan
            @can('list-roles')
            <div class="col mb-4">
                <div class="card rounded-05 main-menu-card">
                    <a href="{{ route('admin.roles.index') }}" class="btn">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-list fa-lg"></i></h5>
                            <p class="card-text">
                            {{ __('Process List') }}
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
