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
                            <span class="align-middle">&nbsp;&nbsp;{{ __('Cities') }}</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('admin.cities.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control" placeholder="{{ __('Filter') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" data-toggle="tooltip" data-placement="top" title="{{ __('Search') }}"><i class="fas fa-search"></i></button>
                                        <a class="btn btn-outline-secondary" href="{{ route('admin.cities.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Clear and return') }}"><i class="fas fa-undo-alt"></i></a>
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
                        @can('create-roles')
                            <a class="btn btn-detail btn-sm" href="{{ route('admin.cities.create') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Create a new') }}">
                                <i class="fas fa-plus"></i>
                            </a>
                        @endcan
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('State') }}</th>
                                    <th>{{ __('Latitude') }}</th>
                                    <th>{{ __('Longitude') }}</th>
                                    <th>{{ __('Zoom') }}</th>
                                    <th>{{ __('Shortcut') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row">{{ $data->id }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->states()->get()->first()->name }}</td>
                                    <td>{{ $data->m_lat }}</td>
                                    <td>{{ $data->m_lng }}</td>
                                    <td>{{ $data->m_zoom }}</td>
                                    <td>
                                        @if($data->shortcut === 1)
                                        <i class="fas text-success fa-check"></i>
                                        @else
                                        <i class="fas text-danger fa-times"></i>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                        @can('update-cities')
                                            <a href="{{ route('admin.cities.edit', $data->id) }}"><button type="button" class="button-without-style mr-1"><i class="fas text-dark fa-edit"></i></button></a>
                                        @endcan
                                        @can('delete-cities')
                                        <form action="{{ route('admin.cities.destroy', $data->id) }}" method="POST">
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