<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEAS - Relatório de cidades</title>

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
                <h3>Relatório de cidades</h3>
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
                    <th><b>#</b></th>
                    <th><b>Nome</b></th>
                    <th><b>Latitude</b></th>
                    <th><b>Longitude</b></th>
                    <th><b>Zoom</b></th>
                    <th><b>Estado</b></th>
                    <th><b>Atalho?</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($response as $city)
                <tr>
                    <td style="border-bottom: 1px solid #ddd !important;">{{ $city->id }}</td>
                    <td style="border-bottom: 1px solid #ddd !important;">{{ $city->name }}</td>
                    <td style="border-bottom: 1px solid #ddd !important;">{{ $city->m_lat }}</td>
                    <td style="border-bottom: 1px solid #ddd !important;">{{ $city->m_lng }}</td>
                    <td style="border-bottom: 1px solid #ddd !important;">{{ $city->m_zoom }}</td>
                    <td style="border-bottom: 1px solid #ddd !important;">{{ $city->states()->get()->first()->name }}</td>
                    <td style="border-bottom: 1px solid #ddd !important;">
                        @if($city->shortcut === 1)
                        Sim
                        @else
                        Não
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <span style="margin-top: 50% !important">Desculpe, essa consulta não encontrou resultados.</span>
        @endif
    </div>

    <script type="text/php">
        $font = $fontMetrics->getFont("Arial", "bold");
        $pdf->page_text(500, 810, "Página {PAGE_NUM}/{PAGE_COUNT}", $font, 10, array(0, 0, 0));
    </script>
</body>
</html>