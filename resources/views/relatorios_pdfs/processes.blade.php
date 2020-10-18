<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEAS - Relatório de processos</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        body {
            font-family: Verdana, Arial, Helvetica, sans-serif !important;
            font-size: 12px;
        }

        th, td {
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>

    <table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <td width="20%" style="text-align: left !important">
                <img src="{{ public_path('img/system/feas-logo.png') }}" style="width: 100px">
            </td>
            <td width="50%" style="font-size: 16px !important; text-align: center !important;">
                <h3>Relatório de processos</h3>
            </td>
            <td width="30%" style="text-align: right !important">
                <b>Rline Telecom LTDA</b><br>
                Rua Cinco - Área Industrial<br>
                CNPJ: 13.500.755/0001-05<br>
                46 3555-8000 / Matriz<br>
                suporte@rline.com.br<br>
            </td>
        </tr>
    </table>

    <div id="middle" style="text-align: center !important">
    <hr>
        <span style="font-size: 12px">
            <a value="{{date_default_timezone_set('America/Sao_Paulo')}}"></a>
            Este relatório foi gerado dia {{ date('d/m/Y') }} às {{ date('H:i:s') }} por {{ Auth::user()->name }}
        </span>
    <hr>
    </div>

    <div class="container" style="text-align: left !important;">
        @if($response->count() !== 0)
        <table width="100%">
            <thead>
                <tr style="background-color: #F1F1F1 !important">
                    @if($option_id === 'true')
                    <th><b>#</b></th>
                    @endif
                    @if($option_customer === 'true')
                    <th>Cliente</th>
                    @endif
                    @if($option_icon === 'true')
                    <th>Representação</th>
                    @endif
                    @if($option_city === 'true')
                    <th>Cidade</th>
                    @endif
                    @if($option_started_by === 'true')
                    <th>Iniciado por</th>
                    @endif
                    @if($option_started_in === 'true')
                    <th>Iniciado em</th>
                    @endif
                    @if($option_tech === 'true')
                    <th>Técnico</th>
                    @endif
                    @if($option_stage === 'true')
                    <th>Etapa</th>
                    @endif
                    @if($option_meters_ap === 'true')
                    <th>Distância aproximada</th>
                    @endif
                    @if($option_meters_real === 'true')
                    <th>Distância real</th>
                    @endif
                    @if($options_difference_meters === 'true')
                    <th>Diferença de distância</th>
                    @endif
                    @if($option_cable === 'true')
                    <th>Cabo utilizado</th>
                    @endif
                    @if($option_finished_by === 'true')
                    <th>Finalizado por</th>
                    @endif
                    @if($option_notifications === 'true')
                    <th>Notificações</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $process)
                <tr>
                    @if($option_id === 'true')
                    <td>{{ $process->id }}</td>
                    @endif

                    @if($option_customer === 'true')
                    <td>{{ $customer->find($process->customers_id)->name }} {{ $customer->find($process->customers_id)->surname }}</td>
                    @endif

                    @if($option_icon === 'true')
                        @if($customer->find($process->customers_id)->m_icon === "fas fa-home")
                        <td>Casa</td>
                        @elseif($customer->find($process->customers_id)->m_icon === "fas fa-hotel")
                        <td>Hotel</td>
                        @elseif($customer->find($process->customers_id)->m_icon === "fas fa-building")
                        <td>Construção</td>
                        @elseif($customer->find($process->customers_id)->m_icon === "fas fa-hospital")
                        <td>Hospital</td>
                        @elseif($customer->find($process->customers_id)->m_icon === "fas fa-store")
                        <td>Loja</td>
                        @elseif($customer->find($process->customers_id)->m_icon === "fas fa-warehouse")
                        <td>Armazém</td>
                        @elseif($customer->find($process->customers_id)->m_icon === "fas fa-church")
                        <td>Igreja</td>
                        @elseif($customer->find($process->customers_id)->m_icon === "fas fa-graduation-cap")
                        <td>Centro educacional</td>
                        @elseif($customer->find($process->customers_id)->m_icon === "fas fa-industry")
                        <td>Indústria</td>
                        @else
                        <td>Não definido</td>
                        @endif
                    @endif

                    @if($option_city === 'true')
                    <td>{{ $city->find($address->find($process->customers_id)->cities_id)->name }}</td>
                    @endif

                    @if($option_started_by === 'true')
                    <td>{{ $user->find($process->users_id)->name }}</td>
                    @endif

                    @if($option_started_in === 'true')
                    <td>{{ $process->created_at }}</td>
                    @endif

                    @if($option_tech === 'true')
                        @if($process->responsible_id !== null)
                        <td>{{ $user->find($process->responsible_id)->name }}</td>
                        @else
                        <td>Indefinido</td>
                        @endif
                    @endif
                    
                    @if($option_stage === 'true')
                    @if($process->stage === 0)
                    <td>Comercial</td>
                    @elseif($process->stage === 1)
                    <td>Viabilidade</td>
                    @elseif($process->stage === 2)
                    <td>Operacional</td>
                    @elseif($process->stage === 3)
                    <td>Técnico</td>
                    @elseif($process->stage === 4)
                    <td>SAC</td>
                    @elseif($process->stage === 5)
                    <td>Finalizado</td>
                    @else
                    <td>Indefinido</td>
                    @endif
                    @endif
                    
                    @if($option_meters_ap === 'true')
                        @if($process->meters !== null)
                        <td>{{ $process->meters }} metros</td>
                        @else
                        <td>Indefinido</td>
                        @endif
                    @endif
                    
                    @if($option_meters_real === 'true')
                        @if($process->real_meters !== null)
                        <td>{{ $process->real_meters }} metros</td>
                        @else
                        <td>Indefinido</td>
                        @endif
                    @endif
                    
                    @if($options_difference_meters === 'true')
                        @if($process->real_meters !== null && $process->meters !== null)
                            @if($process->real_meters - $process->meters < 0)
                            <td>{{ abs($process->real_meters - $process->meters) }} metros a menos</td>
                            @else
                            <td>{{ $process->real_meters - $process->meters }} metros a mais</td>
                            @endif
                        @else
                        <td>Indefinido</td>
                        @endif
                    @endif
                    
                    @if($option_cable === 'true')
                        @if($process->cables_id !== null)
                        <td>{{ $cables->find($process->cables_id)->name }}</td>
                        @else
                        <td>Indefinido</td>
                        @endif
                    @endif
                    
                    @if($option_finished_by === 'true')
                        @if($process->users_id_finished !== null)
                        <td>{{ $user->find($process->users_id_finished)->name }}</td>
                        @else
                        <td>Indefinido</td>
                        @endif
                    @endif
                    
                    @if($option_notifications === 'true')
                        @if($process->notified !== null)
                        <td>{{ $process->notified }}</td>
                        @else
                        <td>Indefinido</td>
                        @endif
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <span style="margin-top: 50% !important">Desculpe, essa consulta não encontrou resultados.</span>
        @endif
    </div>

</body>