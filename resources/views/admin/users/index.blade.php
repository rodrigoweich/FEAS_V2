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
                    <div class="row">
                        <div class="col-4">
                            <a class="btn button-without-style btn-sm" href="{{ route('home') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Return to app') }}">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                            <span class="align-middle">&nbsp;&nbsp;{{ __('Users') }}</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('admin.users.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="{{ __('Filter') }}">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="{{ __('Search') }}"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('admin.users.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Clear and return') }}"><i class="fas fa-undo-alt"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-right">
                        @can('create-users')
                            <a class="btn btn-success btn-sm" href="{{ route('admin.users.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Create a new') }}">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center" style="height: 100px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('E-Mail') }}</th>
                                    <th>{{ __('Role') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $user->id }}</td>
                                    <td class="align-middle">
                                        @if(Storage::disk('public')->exists($user->avatar))
                                            <img id="prevImg" src="{{ config('global.type_asset')('/storage/'.$user->avatar) }}" alt="Avatar" class="avatar-image">
                                        @else
                                            <img id="prevImg" src="{{ config('global.type_asset')('img/users/avatar.png') }}" alt="Avatar" class="avatar-image">
                                        @endif
                                    </td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">
                                        @if ($user->roles()->count() > 1)
                                            {{ __($user->roles()->get()->pluck('name')->min()) }} {{ __('and') }} {{ $user->roles()->count()-1 }} {{ __('more') }}
                                        @elseif ($user->roles()->count() < 1)
                                            <span class="badge badge-danger"><i class="fas fa-exclamation-circle"></i> {{ __('No role') }}</span>
                                        @else
                                            {{ __(implode(', ', $user->roles()->get()->pluck('name')->toArray())) }}
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @can('update-users')
                                            @if(!($user->unalterable === 1))
                                                <button type="button" class="btn button-without-style">
                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="d-inline">
                                                        <i class="fas text-dark fa-edit"></i>
                                                    </a>
                                                </button>
                                            @endif
                                        @endcan

                                        @can('delete-users')
                                            @if(!($user->unalterable === 1))
                                                <button type="button" class="btn button-without-style" onclick="event.preventDefault(); document.getElementById('form-delete-user').submit()">
                                                    <i class="fas text-dark fa-trash"></i>
                                                </button>
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" id="form-delete-user">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            @endif
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                        
                    </div>
                    <span class="d-flex justify-content-center">
                        {{ __('Showing') }} {{ $users->count() }} {{ __('of') }} {{ $users->total() }} {{ __('results') }}
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection



