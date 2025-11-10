<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Celulas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            text-align: center;
            padding: 20px;
            background-color: #007bff;
            color: white;
            margin-bottom: 20px;
        }

        header h4 {
            margin: 0;
            font-size: 24px;
        }

        main {
            margin: 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table th,
        table td {
            text-align: center;
        }
    </style>
</head>

<body>
    <header>
        <h4>Reporte de Celulas</h4>
    </header>
    <main>
        <table>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Número</th>
                <th>Día</th>
                <th>Hora</th>
                <th>Líder</th>
                <th>Tipo</th>
            </tr>
            @isset($celulas)
                @foreach ($celulas as $celula)
                    @php
                        $num = 1;

                        $day = '';
                        switch ($celula->day) {
                            case '1':
                                $day = 'Lunes';
                                break;

                            case '2':
                                $day = 'Martes';
                                break;

                            case '3':
                                $day = 'Miercoles';
                                break;

                            case '4':
                                $day = 'Jueves';
                                break;

                            case '5':
                                $day = 'Viernes';
                                break;

                            case '6':
                                $day = 'Sabado';
                                break;

                            case '7':
                                $day = 'Domingo';
                                break;

                            default:
                                # code...
                                break;
                        }

                        $tipe = '';
                        switch ($celula->tipe) {
                            case '1':
                                $tipe = 'Varones';
                                break;

                            case '2':
                                $tipe = 'Mujeres';
                                break;

                            case '3':
                                $tipe = 'Niños/PreJuveniles';
                                break;

                            default:
                                # code...
                                break;
                        }
                    @endphp

                    <tr>
                        <td>{{ $num }}</td>
                        <td>{{ $celula->name }}</td>
                        <td>{{ $celula->number }}</td>
                        <td>{{ $day }}</td>
                        <td>{{ $celula->hour }}</td>
                        <td>{{ $celula->lider->name }} {{ $celula->lider->lastname }}</td>
                        <td>{{ $tipe }}</td>
                    </tr>
                    @php
                        $num++;
                    @endphp
                @endforeach
            @endisset
        </table>
    </main>
</body>

</html>
