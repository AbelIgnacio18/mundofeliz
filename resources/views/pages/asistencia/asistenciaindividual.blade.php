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
        

        } .contenedor {
           
            
    width: 90%;
    
    margin-left: auto;
    margin-right: auto;

            
        }


        .page {
            width: 100%;
        }

        .page-break {
            page-break-after: always;
        }

        /* HEADER */

        .header {
            border-bottom: 3px solid #0F55BD;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .header table {
            width: 100%;
        }

        .logo img {
            width: 70px;
        }

        .school-info {
            text-align: center;
        }

        .school-title {
            font-size: 20px;
            font-weight: bold;
            color: #0F55BD;
        }

        .school-sub {
            font-size: 12px;
        }

        /* DOCENTE */

        .info {
            margin-top: 10px;
            font-size: 12px;
        }

        .info table {
            width: 100%;
        }

        /* RESUMEN */

        .stats {
            margin-top: 10px;
        }

        .stats table {
            width: 100%;
            border-collapse: collapse;
        }

        .stats td {
            border: 1px solid #ccc;
            text-align: center;
            padding: 6px;
            font-size: 12px;
        }

        .value {
            font-weight: bold;
            font-size: 16px;
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

        /* MES */

        .mes {
            margin-top: 10px;
            font-weight: bold;
            font-size: 13px;
        }

        /* TABLA CALENDARIO */

        .calendario {
            margin-top: 6px;
        }

        .calendario table {
            width: 100%;
            border-collapse: collapse;
        }

        .calendario th {
            background: #0F55BD;
            color: white;
            font-size: 10px;
            padding: 4px;
        }

        .calendario td {
            border: 1px solid #ccc;
            text-align: center;
            font-size: 9px;
            padding: 2px;
        }

        .weekend {
            background: #eee;
        }

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

        /* FIRMAS */

        .footer {
            margin-top: 60px;
        }

        .footer table {
            width: 100%;
        }

        .footer td {
            text-align: center;
            font-size: 12px;
        }

        .calendar{
width:100%;
border-collapse:collapse;
margin-top:10px;
}

.calendar th{
background:#0F55BD;
color:white;
padding:6px;
font-size:12px;
}

.calendar td{
border:1px solid #ccc;
height:45px;
vertical-align:top;
text-align:center;
font-size:10px;
}

.dia{
font-weight:bold;
margin-bottom:3px;
}

.asistio{
background:#1aa053;
color:white;
padding:2px;
}

.tarde{
background:#f39c12;
color:white;
padding:2px;
}

.falta{
background:#e74c3c;
color:white;
padding:2px;
}
    </style>
</head>

<body>
    <div class="contenedor">
        @foreach ($meses as $me)

        
            <div class="page" style="margin-top:70px">

                <!-- HEADER -->

                <div class="header">

                    <table>

                        <tr>

                            <td class="logo">
                                <img src="assets/images/logo.webp">
                            </td>

                            <td class="school-info">

                                <div class="school-title">Colegio Bertolt Brecht</div>

                                <div class="school-sub">
                                    Reporte de Asistencia Docente
                                </div>

                                <div class="school-sub">
                                    bertoltbrecht2020@gmail.com
                                </div>

                                <div class="school-sub">
                                    Calle Real 859 - Chilca, Huancayo
                                </div>

                                <div class="school-sub">
                                    Tel:(064) 212189
                                </div>

                            </td>

                            <td width="80"></td>

                        </tr>

                    </table>

                </div>

                <!-- DATOS DOCENTE -->

                <div class="info">

                    <table>

                        <tr>

                            <td width="60%">
                                Docente:
                                <strong>{{ $docente->apellidos }}, {{ $docente->nombre }}</strong>
                            </td>

                            <td width="40%">
                                Fecha reporte:
                                <strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong>
                            </td>

                        </tr>

                    </table>

                </div>

                <!-- RESUMEN MES -->

                @php
                    $stats = $resumenMes[$me] ?? [
                        'asistio' => 0,
                        'tarde' => 0,
                        'falta' => 0,
                        'minutos_tarde' => 0,
                    ];
                @endphp

                <div class="stats">

                    <table>

                        <tr>

                            <td>
                                Asistió
                                <div class="value green">
                                    {{ $stats['asistio'] }}
                                </div>
                            </td>

                            <td>
                                Tarde
                                <div class="value orange">
                                    {{ $stats['tarde'] }}
                                </div>
                            </td>

                            <td>
                                Faltas
                                <div class="value red">
                                    {{ $stats['falta'] }}
                                </div>
                            </td>

                            <td>
                                Minutos Tarde
                                <div class="value orange">
                                    {{ $stats['minutos_tarde'] }}
                                </div>
                            </td>

                        </tr>

                    </table>

                </div>

                <!-- MES -->

                <div class="mes">

                    Mes: {{ \Carbon\Carbon::parse($me)->translatedFormat('F Y') }}

                </div>

                <!-- CALENDARIO -->

                <div class="calendario">

                    <table class="calendar">

<thead>

<tr>
<th>L</th>
<th>M</th>
<th>M</th>
<th>J</th>
<th>V</th>
<th>S</th>
<th>D</th>
</tr>

</thead>

<tbody>

@foreach($calendarioMes[$me] as $semana)

<tr>

@foreach($semana as $fecha)

@if($fecha)

@php

$registro = $docente->asistenciadocentehoy
->firstWhere('fechaentrada',$fecha->format('Y-m-d'));

@endphp

<td>

<div class="dia">
{{ $fecha->format('d') }}
</div>

@if($registro)

@if($registro->estado==1)

<div class="asistio">
{{ Carbon\Carbon::parse($registro->horaentrada)->format('h:i A') }}
</div>
<div class="asistio">
{{$registro->minutos_tarde }} min
</div>


@endif

@if($registro->estado==0)

<div class="tarde">
{{ Carbon\Carbon::parse($registro->horaentrada)->format('h:i A') }}
</div>
<div class="tarde">
{{$registro->minutos_tarde }} min
</div>


@endif

@if($registro->estado==4)

<div class="falta">
F
</div>

@endif

@endif

</td>

@else

<td></td>

@endif

@endforeach

</tr>

@endforeach

</tbody>

</table>

                </div>

                <!-- FIRMAS -->

                <div class="footer">

                    <table>

                        <tr>

                            <td>

                                _________________________<br>
                                Docente

                            </td>

                            <td>

                                _________________________<br>
                                Dirección

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

            <div class="page-break"></div>
        @endforeach
    </div>


</body>

</html>
