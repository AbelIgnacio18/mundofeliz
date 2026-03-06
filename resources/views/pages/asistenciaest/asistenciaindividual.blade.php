<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Asistencia</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }


        @page {
            margin: 40px 40px 40px 40px;
            /* arriba derecha abajo izquierda */
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .contenedor {
            width: 100%;
            padding: 5px;
        }

        /* HEADER */

        .header {
            width: 100%;
            border-bottom: 3px solid #c00000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .header-table {
            width: 100%;
        }

        .logo {
            width: 80px;
        }

        .logo img {
            width: 70px;
        }

        .school-info {
            text-align: center;
        }

        .school-info .title {
            font-size: 20px;
            font-weight: bold;
            color: #c00000;
        }

        .school-info .subtitle {
            font-size: 13px;
            margin-top: 3px;
        }

        /* STUDENT INFO */

        .student-box {
            margin-top: 8px;
            border: 1px solid #cfcfcf;
            padding: 6px;
            font-size: 12px;
        }

        .student-box table {
            width: 100%;
        }

        .student-box td {
            padding: 4px;
        }

        /* STATS PANEL */

        .stats {
            margin-top: 10px;
            border: 1px solid #cfcfcf;
        }

        .stats table {
            width: 100%;
            border-collapse: collapse;
        }

        .stats td {
            text-align: center;
            padding: 6px;
            font-size: 12px;
            border-right: 1px solid #ddd;
        }

        .stats td:last-child {
            border-right: none;
        }

        .stats .value {
            font-size: 16px;
            font-weight: bold;
            margin-top: 3px;
        }

        .green {
            color: #1aa053;
        }

        .orange {
            color: #f39c12;
        }

        .red {
            color: #e74c3c;
        }

        /* LEGEND */

        .legend {
            margin-top: 8px;
            font-size: 11px;
        }

        .legend span {
            display: inline-block;
            padding: 3px 8px;
            margin-right: 6px;
            color: white;
            font-weight: bold;
        }

        /* MONTH TITLE */

        .mes-titulo {
            margin-top: 10px;
            font-size: 13px;
            font-weight: bold;
            color: #333;
        }

        /* TABLE */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        th {
            background: #c00000;
            color: white;
            font-size: 11px;
            padding: 4px;
        }

        td {
            border: 1px solid #ccc;
            text-align: center;
            font-size: 9px;
            padding: 1px;
        }

        .weekend {
            background: #ececec;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        /* STATES */

        .asistio {
            background: #1aa053;
            color: white;
            font-weight: bold;
        }

        .tarde {
            background: #f39c12;
            color: white;
            font-weight: bold;
        }

        .falta {
            background: #e74c3c;
            color: white;
            font-weight: bold;
        }

        /* FOOTER */

        .footer {
            margin-top: 40px;
            font-size: 12px;
        }

        .footer table {
            width: 100%;
        }

        .footer td {
            text-align: center;
            padding-top: 30px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
<div class="contenedor">

    <!-- TODO TU REPORTE -->
 <div class="header">

        <table class="header-table">

            <tr>

                <td class="logo">
                    <img src="assets/images/logo.webp">
                </td>

                <td class="school-info">

                    <div class="title">I.E.P. MUNDO FELIZ</div>

                    <div class="subtitle">
                        Reporte de Asistencia Escolar
                    </div>

                    <div class="subtitle">
                        www.mundofeliz.edu.pe
                    </div>

                    <div class="subtitle">
                        Cel: 961 141 838 / 922 916 052
                    </div>

                </td>

                <td width="80"></td>

            </tr>

        </table>

    </div>


    <!-- STUDENT DATA -->

    <div class="student-box">

        <table>

            <tr>

                <td width="60%">
                    <strong>Estudiante:</strong>
                    {{ $estudiante->apellidos }}, {{ $estudiante->nombre }}
                </td>

                <td width="40%">
                    <strong>Fecha reporte:</strong>
                    {{ \Carbon\Carbon::now()->format('d/m/Y') }}
                </td>

            </tr>

        </table>

    </div>


    <!-- STATS -->

    <div class="stats">

        <table>

            <tr>

                <td>
                    Total días
                    <div class="value">{{ $total }}</div>
                </td>

                <td>
                    Asistió
                    <div class="value green">{{ $asistio }}</div>
                </td>

                <td>
                    Tarde
                    <div class="value orange">{{ $tarde }}</div>
                </td>

                <td>
                    Faltas
                    <div class="value red">{{ $falta }}</div>
                </td>
                 <td>
                    Tarde Just.
                    <div class="value orange">{{ $tardejus }}</div>
                </td>
                  <td>
                    Faltas Just. 
                    <div class="value red">{{ $faltajus }}</div>
                </td>

                <td>
                    % Asistencia
                    <div class="value">{{ $porcentaje }}%</div>
                </td>

            </tr>

        </table>

    </div>


    <!-- LEGEND -->

    <div class="legend">

        <span style="background:#1aa053">Asistió</span>
        <span style="background:#f39c12">Tarde</span>
        <span style="background:#e74c3c">Falta</span>
 <span style="background:#8C4CFF">Tarde Justificada</span>
 <span style="background:#115DD0"> Falta Justificada</span>

    </div>


    @foreach ($meses as $me)
        <div class="mes-titulo">
            Mes: {{ Carbon\Carbon::parse($me)->translatedFormat('F Y') }}
        </div>

        <table>

            <thead>

                <tr>

                    <th width="35">N°</th>

                    @foreach ($dias as $di)
                        @if (Carbon\Carbon::parse($di)->format('Y-m') == $me)
                            <th>
                                {{ Carbon\Carbon::parse($di)->format('d') }}
                            </th>
                        @endif
                    @endforeach

                </tr>

            </thead>

            <tbody>

                @foreach ($items as $index => $item)
                    <tr>

                        <td>{{ $index + 1 }}</td>

                        @foreach ($dias as $di)
                            @if (Carbon\Carbon::parse($di)->format('Y-m') == $me)
                                @php
                                    $fecha = Carbon\Carbon::parse($di);
                                    $esFinDeSemana = $fecha->isWeekend();
                                    $registro = $item->asistenciahoy->firstWhere(
                                        'fechaentrada',
                                        $fecha->format('Y-m-d'),
                                    );
                                @endphp

                                <td class="{{ $esFinDeSemana ? 'weekend' : '' }}">

                                    @if ($registro)
                                        @if ($registro->estado == 1)
                                            <div class="asistio">
                                                {{ Carbon\Carbon::parse($registro->created_at)->format('H:i') }}
                                            </div>
                                        @endif

                                        @if ($registro->estado == 0)
                                            <div class="tarde">
                                                {{ Carbon\Carbon::parse($registro->created_at)->format('H:i') }}
                                            </div>
                                        @endif
                                         @if ($registro->estado == 2)
                                            <div class="" style="background-color: #8C4CFF">
                                                {{ Carbon\Carbon::parse($registro->created_at)->format('H:i') }}
                                            </div>
                                        @endif
                                          @if ($registro->estado == 3)
                                            <div class="" style="background-color: #115DD0;color:#ffff">
                                                FJ
                                            </div>
                                        @endif

                                        @if ($registro->estado == 4)
                                            <div class="falta">
                                                F
                                            </div>
                                        @endif
                                    @endif

                                </td>
                            @endif
                        @endforeach

                    </tr>
                @endforeach

            </tbody>

        </table>
    @endforeach


    <!-- SIGNATURES -->

    <div class="footer">

        <table>

            <tr>

                <td>
                    _________________________<br>
                    Docente Tutor
                </td>

                <td>
                    _________________________<br>
                    Dirección
                </td>

            </tr>

        </table>

    </div>

</div>
   
</body>

</html>
