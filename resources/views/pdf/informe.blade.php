<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <title>Informe de Célula</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header, footer {
            text-align: center;
            padding: 20px;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        main {
            flex: 1;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .table-title {
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 18px;
        }
        img {
            border: 1px solid #ddd;
            padding: 5px;
            background-color: #f4f4f4;
        }
        .data-section {
            margin-bottom: 20px;
        }
        footer {
            background-color: #f4f4f4;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>Informe de Célula</h1>
    </header>
    <main>
        <section class="data-section">
            <table>
                <tr>
                    <th colspan="2" class="table-title">Datos de Célula</th>
                </tr>
                <tr>
                    <td><strong>Nombre:</strong> {{ $report->name_celula }}</td>
                    

                    <td rowspan="5"><img src="data:image/png;base64, {{ base64_encode(file_get_contents(public_path($report->photo))) }}" width="200" alt="logo" /></td>
                </tr>
                <tr>
                    <td><strong>Número:</strong> {{ $report->celula->number }}</td>
                </tr>
                <tr>
                    <td><strong>Líder:</strong> {{ $report->lider }}</td>
                </tr>
                <tr>
                    <td><strong>Dirección:</strong> {{ $report->address }}</td>
                </tr>
                <tr>
                    <td><strong>Fecha:</strong> {{ $report->datetime }}</td>
                </tr>
            </table>
        </section>

        <section class="data-section">
            <table>
                <tr>
                    <th colspan="2" class="table-title">Asistencia</th>
                </tr>
                @php $num = 1; @endphp
                @if ($report->asistencia)
                    @foreach ($report->asistencia as $asistencia)
                        <tr>
                            <td style="width: 10%">{{ $num }}</td>
                            <td>{{ $asistencia->name }} {{ $asistencia->lastname }}</td>
                        </tr>
                        @php $num++; @endphp
                    @endforeach
                @endif
            </table>
        </section>

        <section class="data-section">
            <table>
                <tr>
                    <th colspan="2" class="table-title">Visita</th>
                </tr>
                @php $num = 1; @endphp
                @if ($report->visita)
                    @foreach ($report->visita as $visita)
                        <tr>
                            <td style="width: 10%">{{ $num }}</td>
                            <td>{{ $visita->name }} {{ $visita->lastname }}</td>
                        </tr>
                        @php $num++; @endphp
                    @endforeach
                @endif
            </table>
        </section>
    </main>
    {{--<footer>
        <p>&copy; {{ date('Y') }} Informe de Célula.</p>
    </footer>--}}
</body>

</html>
