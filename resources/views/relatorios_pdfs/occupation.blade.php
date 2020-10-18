<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEAS - Relatório de ocupação/cidade</title>
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
                <h3>Relatório de ocupação/cidade</h3>
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
                    <th>Cidade</th>
                    <th>Qtd caixas</th>
                    <th>Qtd Portas</th>
                    <th>Ocupadas</th>
                    <th>Livres</th>
                    <th>Ocupação(%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $process)
                <tr>
                    <td>{{ $city->find($process->cities_id)->name }}</td>
                    <td>{{ $process->b }}</td>
                    <td>{{ $process->ca }}</td>
                    <td>{{ $process->cb }}</td>
                    <td>{{ $process->ca - $process->cb }}</td>
                    <td>{{ number_format(($process->cb * 100) / $process->ca,2) }}%</td>
                </tr>
                @endforeach
                <tr style="background-color: #F1F1F1 !important; font-weight: bold;">
                    <td>Geral</td>
                    <td>{{ $response->sum('b') }}</td>
                    <td>{{ $response->sum('ca') }}</td>
                    <td>{{ $response->sum('cb') }}</td>
                    <td>{{ $response->sum('ca') - $response->sum('cb') }}</td>
                    <td>{{ number_format(($response->sum('cb') * 100) / $response->sum('ca'), 2) }}%</td>
                </tr>
            </tbody>
        </table>
        @else
        <span style="margin-top: 50% !important">Desculpe, essa consulta não encontrou resultados.</span>
        @endif
    </div>

</body>