<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEAS - Relatório de comparação de metragem</title>
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
                <h3>Relatório de comparação de metragem</h3>
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
        <span style="font-size: 12px;">
            <br>Informações adicionais da pesquisa<br><br>
            Data inicial: {{ $date_begin_request }}<br>
            Data final: {{ $date_end_request }}<br>
            Cidade: @if($city_id === '0') Todas @else {{ $city->find($city_id)->name }} @endif<br>
            Técnico: @if($tecnico === '0') Todos @else {{ $user->find($tecnico)->name }} @endif<br>
            Cabo: @if($cabo === '0') Todos @else {{ $cables->find($cabo)->name }} @endif<br><br>
        </span>
        @if($response->count() !== 0)
        <table width="100%">
            <thead>
                <tr style="background-color: #F1F1F1 !important">
                    <th><b>#</b></th>
                    <th>Cliente</th>
                    <th>Cidade</th>
                    <th>Técnico</th>
                    <th>Metragem ap.</th>
                    <th>Metragem real</th>
                    <th>Diferença (MA - MR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $process)
                <tr>
                    <td>{{ $process->pid }}</td>
                    <td>{{ $customer->find($process->pcid)->name }} {{ $customer->find($process->pcid)->surname }}</td>
                    <td>{{ $process->acid }}</td>
                    <td>{{ $user->find($process->responsible_id)->name }}</td>
                    <td>{{ $process->pmet }} metros</td>
                    <td>{{ $process->prmet }} metros</td>
                    @if($process->prmet - $process->pmet < 0)
                    <td>{{ abs($process->prmet - $process->pmet) }} metros a menos</td>
                    @else
                    <td>{{ $process->prmet - $process->pmet }} metros a mais</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <table width="100%">
            <thead>
                <tr style="background-color: #F1F1F1 !important">
                    <th>Total Metragem ap.</th>
                    <th>Total Metragem real</th>
                    <th>Total Diferença (MA - MR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $response->sum('pmet') }} metros</td>
                    <td>{{ $response->sum('prmet') }} metros</td>
                    @if($process->prmet - $process->pmet < 0)
                    <td>{{ abs($response->sum('prmet') - $response->sum('pmet')) }} metros a menos</td>
                    @else
                    <td>{{ $response->sum('prmet') - $response->sum('pmet') }} metros a mais</td>
                    @endif
                </tr>
            </tbody>
        </table>
        @else
        <hr>
        <span style="margin-top: 50% !important">Desculpe, essa consulta não encontrou resultados.</span>
        @endif
    </div>

</body>