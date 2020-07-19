@extends('layouts.app')

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

                    <a class="btn button-without-style btn-sm" href="{{ route('home') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Return to app') }}">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <span class="align-middle">&nbsp;&nbsp;{{ __('Roles') }}</span>
                    @can('create-roles')
                    <span class="float-right ml-2">
                        <a class="btn btn-success btn-sm" href="{{ route('admin.roles.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Create a new') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                    </span>
                    @endcan
                    <span class="float-right">
                        <form action="{{ route('admin.roles.search') }}" method="post">
                            @csrf
                            <div class="input-group input-group-sm">
                                <input type="text" name="dataToSearch" class="form-control" placeholder="{{ __('Filter') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" data-toggle="tooltip" data-placement="top" title="{{ __('Search') }}"><i class="fas fa-search"></i></button>
                                    <a class="btn btn-outline-secondary" href="{{ route('admin.roles.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Clear and return') }}"><i class="fas fa-undo-alt"></i></a>
                                </div>
                            </div>
                        </form>
                    </span>
                    <div id="divider" class="mb-5"></div>
                    
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Rules') }}</th>
                                    <th>{{ __('Users') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td scope="row">{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @if ($role->rules()->count() > 1)
                                            {{ __($role->rules()->get()->pluck('display_name')->min()) }} {{ __('and') }} {{ $role->rules()->count()-1 }} {{ __('more') }}
                                        @elseif ($role->rules()->count() < 1)
                                            <span class="badge badge-danger"><i class="fas fa-exclamation-circle"></i> {{ __('No rules') }}</span>
                                        @else
                                            {{ __(implode(', ', $role->rules()->get()->pluck('display_name')->toArray())) }}
                                        @endif
                                    </td>
                                    <td>{{ $role->users()->where('role_id', $role->id)->count() }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                    @can('update-roles')
                                        @if(!($role->unalterable === 1))
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"><button type="button" class="button-without-style mr-1"><i class="fas text-dark fa-edit"></i></button></a>
                                        @endif
                                    @endcan
                                    @can('delete-roles')
                                        @if(!($role->unalterable === 1))
                                            @if($role->users()->where('role_id', $role->id)->count() === 0)
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="button-without-style ml-1"><i class="fas text-dark fa-trash"></i></button>
                                            </form>
                                            @endif
                                        @endif
                                    @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                
                    <div id="divider" class="mb-5"></div>

                    <div class="d-flex justify-content-center">
                        {{ $roles->links() }}
                        
                    </div>
                    <span class="d-flex justify-content-center">
                     {{ __('Showing') }} {{ $roles->count() }} {{ __('of') }} {{ $roles->total() }} {{ __('results') }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection