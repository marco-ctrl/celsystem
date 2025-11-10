<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe Celulas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            text-align: center;
            padding: 20px;
            border-bottom: 2px solid #ccc;
            margin-bottom: 20px;
        }
        header h4, header h5 {
            margin: 5px 0;
        }
        main {
            width: 100%;
            padding: 0 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
        .footer {
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            padding: 10px 0;
            border-top: 2px solid #ccc;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <header>
        <h4>Reporte de Células</h4>
        <h5>Del: {{ $date['inicio'] }} al {{ $date['final'] }}</h5>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Célula</th>
                    <th>Líder</th>
                    <th>Fecha y Hora</th>
                    <th>Asistencia</th>
                    <th>Visitas</th>
                    <th>Ofrenda (Bs.)</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                @if ($reports)
                    @foreach ($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->name_celula }}</td>
                            <td>{{ $report->celula->lider->name }} {{ $report->celula->lider->lastname }}</td>
                            <td>{{ $report->datetime }}</td>
                            <td>{{ $report->assistant_amount }}</td>
                            <td>{{ $report->visit_amount }}</td>
                            <td>{{ number_format($report->offering, 2) }}</td>
                            <td>{{ $report->address }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </main>
    <div class="footer">
        {{--Página {{ $page }} de {{ $total_pages }}--}}
    </div>
</body>
</html>