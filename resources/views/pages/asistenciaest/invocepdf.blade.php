<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        /* Configuración para impresión A4 Horizontal */
        @page { 
            size: A4 landscape; 
            margin: 0.5cm; 
        }
        
        * { box-sizing: border-box; font-family: 'Arial Narrow', Arial, sans-serif; margin: 0; padding: 0; }
        
        body { width: 95%; color: #333; background-color: white; margin: 20px auto; }

        /* HEADER PROFESIONAL */
        .header-container { width: 100%; margin-bottom: 10px; position: relative; height: 80px; border-bottom: 2px solid #345da7; }
        .logo-box { position: absolute; left: 0; top: 5px; width: 70px; }
        .info-box { width: 100%; text-align: center; padding-top: 5px; }
       .leyenda-box {
    position: absolute;
    right: 0;
    top: 0;
    text-align: left;
    font-size: 8px;
    line-height: 1.6;
    border: 0.5px solid #ccc;
    padding: 6px;
    background: #f9f9f9;
}

.leyenda-item {
    display: block;
    margin-bottom: 2px;
}

/* Esta técnica asegura que el color aparezca incluso si "imprimir fondos" está desactivado */
.color-dot {
    display: inline-block;
    width: 0;
    height: 8px;
    border-left: 10px solid; /* El color se define en el style inline */
    margin-right: 4px;
    vertical-align: middle;
}
        .title-seccion { 
            background: #345da7; 
            color: white; 
            padding: 5px 10px; 
            font-size: 10px; 
            font-weight: bold; 
            border: 0.5px solid #000;
        }

        /* AJUSTE DE COLUMNAS PARA QUE TODO QUEPA EN LA HOJA */
        table { width: 100%; border-collapse: collapse; table-layout: fixed; }

        .col-n { width: 1px; }
        .col-estudiante { width: 380px; } /* Ancho ideal para nombres sin desplazar la tabla */
        .col-dia { width: auto; } /* El resto se reparte equitativamente */

        th { 
            background-color: #345da7; 
            color: white; 
            font-size: 8px; 
            border: 0.5px solid #000;
            height: 28px; 
        }

        .num-dia { display: block; font-size: 9px; }
        .letra-dia { display: block; font-size: 6px; text-transform: uppercase; }

        td { border: 0.5px solid #444; text-align: center; font-size: 7px; height: 30px; padding: 0; }

        /* AJUSTE PARA NOMBRES LARGOS */
        .nombre-txt { 

            text-align: left; 
            padding: 2px 4px; 
            font-size: 8px; 
            font-weight: bold; 
            line-height: 1;
            white-space: normal; /* Permite salto de línea si el nombre es muy largo */
            overflow: hidden;
        }

        .asis-box { 
            display: block; 
            width: 100%; 
          
            font-weight: bold; 
            line-height: 1.2;
            padding-top: 0px;
        }

        .weekend { background-color: #f2f2f2 !important; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>

@foreach($meses as $me)
    <div class="header-container">
        <div class="logo-box"><img src="assets/images/logo.webp" width="65"></div>
        <div class="info-box">
            <h1 style="font-size: 16px;">COLEGIO BERTOLT BRECHT</h1>
            <p style="font-size: 9px;">bertoltbrecht2020@gmail.com | Tel:(064) 212189</p>
            <h2 style="font-size: 12px; margin-top: 5px;">REPORTE DE ASISTENCIA MENSUAL</h2>
        </div>
       <div class="leyenda-box">
    <strong>LEYENDA:</strong><br>
    <div class="leyenda-item"><span class="color-dot" style="border-left-color: #28a745;"></span>Asistío(Puntual)</div>
    <div class="leyenda-item"><span class="color-dot" style="border-left-color: #ffc107;"></span> Tarde</div>
    <div class="leyenda-item"><span class="color-dot" style="border-left-color: #dc3545;"></span> Falta</div>
    <div class="leyenda-item"><span class="color-dot" style="border-left-color: #8e44ad;"></span> T.Justificado</div>
    <div class="leyenda-item"><span class="color-dot" style="border-left-color: #1f6ed4;"></span> F.Justificado</div>
</div>
    </div>

    <div class="title-seccion">
        AULA: {{ strtoupper($nombreaula->grado) }} "{{ $nombreaula->seccion }}" &nbsp;&nbsp;&nbsp; 
        MES: {{ strtoupper(Carbon\Carbon::parse($me)->translatedFormat('F Y')) }}
    </div>

    <table>
        <thead>
            <tr>
                <th class="col-n">Nº</th>
                <th class="col-estudiante">APELLIDOS Y NOMBRES</th>
                @foreach($dias as $di)
                    @if (str_starts_with($di, $me))
                        @php 
                            $fechaC = Carbon\Carbon::parse($di);
                            $letra = substr($fechaC->translatedFormat('D'), 0, 1);
                        @endphp
                        <th class="col-dia">
                            <span class="num-dia">{{ $fechaC->format('d') }}</span>
                            <span class="letra-dia">{{ $letra }}</span>
                        </th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
            <tr>
                <td style="background-color: #f5f5f5; font-weight: bold;">{{ $index + 1 }}</td>
                <td class="nombre-txt">
                    {{ $item->estudiante->apellidos }}<br>
                    <span style="font-weight: normal; font-size: 7px;">{{ $item->estudiante->nombre }}</span>
                </td>
                
                @foreach($dias as $di)
                    @if (str_starts_with($di, $me))
                        @php
                            $f = Carbon\Carbon::parse($di);
                            $esFinde = $f->isSaturday() || $f->isSunday();
                            $asis = $item->asistencia_indexada[$di] ?? null; 
                        @endphp
                        <td class="{{ $esFinde ? 'weekend' : '' }}">
                            @if($asis)
                                @php
                                    $color = match((int)$asis->estado) {
                                        1 => '#28a745', 0 => '#ffc107', 4 => '#dc3545', 
                                        2 => '#8e44ad', 3 => '#1f6ed4', default => '#6c757d'
                                    };
                                    $time = \Carbon\Carbon::parse($asis->created_at);
                                @endphp
                                <div class="asis-box" style="background-color: {{ $color }}; color: {{ (int)$asis->estado === 0 ? 'black' : 'white' }};display:block">
                                    @if($asis->estado !== 4)
                                       {{ $time->format('h:i') }}<br>
                                    <span style="font-size: 5px;">{{ $time->format('A') }}</span>
                                    @endif
                                     @if($asis->estado === 4)
                                  
                                    <span style="font-size: 15px;">F</span>
                                    @endif
                                 
                                </div>
                            @endif
                        </td>
                    @endif
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!$loop->last) <div class="page-break"></div> @endif
@endforeach
</body>
</html>