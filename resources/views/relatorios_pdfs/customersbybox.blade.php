<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEAS - Relatório de clientes por caixas</title>
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
                <h3>Relatório de clientes por caixas</h3>
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
            <br>Informações sobre a caixa<br><br>Caixa: {{ $box->name }}<br>
            Cidade: {{ $city->find($box->cities_id)->name }}<br>
            Quantidade: {{ $box->amount }}<br>
            Ocupadas: {{ $box->busy }}<br>
            Livres: {{ $box->amount - $box->busy }}<br>
            Latitude: {{ $box->m_lat }}<br>
            Longitude: {{ $box->m_lng }}<br>
            Descrição: {{ $box->description }}<br><br>
        </span>
        @if($response->count() !== 0)
        <table width="100%">
            <thead>
                <tr style="background-color: #F1F1F1 !important">
                    <th><b>#</b></th>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Contrato N°</th>
                    <th>End.</th>
                    <th>N° end.</th>
                    <th>Complemento end.</th>
                    <th>Cidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $process)
                <tr>
                    <td>{{ $process->id }}</td>
                    <td>{{ $process->name }} {{ $process->surname }}</td>
                    <td>{{ $process->phone }}</td>
                    <td>{{ $process->contract_number }}</td>
                    <td>{{ $process->end_description }}</td>
                    <td>{{ $process->number }}</td>
                    <td>{{ $process->complement }}</td>
                    <td>{{ $city->find($process->cities_id)->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <hr>
        <span style="margin-top: 50% !important">Desculpe, essa consulta não encontrou resultados.</span>
        @endif
    </div>

</body>