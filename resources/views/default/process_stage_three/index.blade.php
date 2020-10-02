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
                            <span class="align-middle">&nbsp;&nbsp;Processo estágio - 3</span>
                        </div>
                        <div class="col-8 text-right">
                            <form action="{{ route('default.boxes.search') }}" method="post">
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="text" name="dataToSearch" class="form-control panel-border" placeholder="{{ __('Filter') }}">
                                    <div class="input-group-append">
                                        <button class="btn panel-border" type="submit" data-toggle="tooltip" data-placement="top" title="{{ __('Search') }}"><i class="fas fa-search"></i></button>
                                        <a class="btn panel-border" href="{{ route('default.process_stage_three.index') }}" role="button" data-toggle="tooltip" data-placement="top" title="{{ __('Clear and return') }}"><i class="fas fa-undo-alt"></i></a>
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
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover table-borderless text-center" style="height: 100px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Ícone</th>
                                    <th>Cidade</th>
                                    <th>Iniciado por</th>
                                    <th>Iniciado em</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($response as $data)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $data->id }}</td>
                                    <td class="align-middle">{{ $customer->find($data->customers_id)->name }}</td>
                                    <td class="align-middle"><i class="{{ $customer->find($data->customers_id)->m_icon }}"></i></td>
                                    <td class="align-middle">{{ $city->find($address->find($data->customers_id)->cities_id)->name }}</td>
                                    <td class="align-middle">{{ $user->find($data->users_id)->name }}</td>
                                    <td class="align-middle">{{ $data->created_at }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex align-content-center">
                                            @can('update-process-stage-three')
                                            <a href="{{ route('default.process_stage_three.edit', $data->id) }}"><button type="button" class="button-without-style mr-1"><i class="fas text-dark fa-edit"></i></button></a>
                                            @endcan
                                            @can('previous-process-stage-three')
                                            <a href="{{ route('default.process.previous_stage', $data->id) }}"><button type="button" class="button-without-style mr-1"><i class="fas text-danger fa-arrow-left"></i></button></a>
                                            @endcan
                                            @can('next-process-stage-three')
                                                @if($data->responsible_id !== null)
                                                <a href="{{ route('default.process.next_stage', $data->id) }}"><button type="button" class="button-without-style mr-1"><i class="fas text-success fa-arrow-right"></i></button></a>
                                                @endif
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