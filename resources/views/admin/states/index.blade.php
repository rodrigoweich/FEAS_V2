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
                            <span class="align-middle">&nbsp;&nbsp;{{ __('States') }}</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('admin.states.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="{{ __('Filter') }}">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="{{ __('Search') }}"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('admin.states.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Clear and return') }}"><i class="fas fa-undo-alt"></i></a>
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
                            <a class="btn btn-detail btn-sm" href="{{ route('admin.states.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Create a new') }}">
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
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('UF') }}</th>
                                    <th>{{ __('Cities') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $data->id }}</td>
                                    <td class="align-middle">{{ $data->name }}</td>
                                    <td class="align-middle">{{ $data->uf }}</td>
                                    <td class="align-middle">{{ $data->cities->where('states_id', $data->id)->count() }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                            @can('update-states')
                                                <a href="{{ route('admin.states.edit', $data->id) }}"><button type="button" class="button-without-style mr-1"><i class="fas text-dark fa-edit"></i></button></a>
                                            @endcan
                                            @can('delete-states')
                                                <form action="{{ route('admin.states.destroy', $data->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="button-without-style ml-1"><i class="fas text-dark fa-trash"></i></button>
                                                </form>
                                            @endcan
                                        </div>
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
                                {{ $response->onEachSide(1)->links() }}
                    </div>
                    <div class="d-flex justify-content-center">
                        <span class="align-middle">{{ __('Showing') }} {{ $response->count() }} {{ __('of') }} {{ $response->total() }} {{ __('results') }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection