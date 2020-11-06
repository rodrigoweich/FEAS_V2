<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEAS - Relatório de clientes</title>
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
                <h3>Relatório de clientes</h3>
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
            Cidade: @if($city === '0') Todas @else {{ $cities->find($city)->name }} @endif<br>
            Identificação do ícone: @if($icon === '0') Indiferente @else {{ $icon }} @endif<br><br>
        </span>
        @if($response->count() !== 0)
        <table width="100%">
            <thead>
                <tr style="background-color: #F1F1F1 !important">
                    <th><b>#</b></th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>Nº contrato</th>
                    <th>Nº endereço</th>
                    <th>Complemento</th>
                    <th>Descrição</th>
                    <th>Ícone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $process)
                <tr>
                    <td>{{ $process->id }}</td>
                    <td>{{ $process->name }} {{ $process->surname }}</td>
                    <td>{{ $process->phone }}</td>
                    <td>{{ $process->contract_number }}</td>
                    <td>{{ $addresses->where('customers_id', $process->id)->first()->number }}</td>
                    <td>{{ $addresses->where('customers_id', $process->id)->first()->complement }}</td>
                    <td>{{ $addresses->where('customers_id', $process->id)->first()->end_description }}</td>
                    <td>{{ $process->m_icon }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <hr>
        <span style="margin-top: 50% !important">Desculpe, essa consulta não encontrou resultados.</span>
        @endif
    </div>

    <script type="text/php">
        $font = $fontMetrics->getFont("Arial", "bold");
        $pdf->page_text(500, 810, "Página {PAGE_NUM}/{PAGE_COUNT}", $font, 10, array(0, 0, 0));
    </script>
</body>
</html>