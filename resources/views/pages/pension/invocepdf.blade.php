<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Matrícula
    </title>
    <link rel="stylesheet" href="../public/pdf/assets/css/comprobantepdf.css">
</head>

<body>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            /* más pequeño, pero legible */
        }

        th,
        td {
            border: 1px solid #cccccc;
            padding: 1px 2px;
            /* <<< PADDING MÍNIMO */
            line-height: 1.1;
            /* compacta la altura */
        }

        th {
            background: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .page_break {
            page-break-before: always;
        }






        tr:nth-child(even) {
            background: #fafafa;
        }

        /* Evitar márgenes de elementos internos */
        h4,
        h5,
        div {
            margin: 0;
            padding: 0;
            line-height: 1.1;
        }

        /* Burbujas compactas */
        .tag,
        .iq-media-1 div {
            padding: 0px 2px !important;
            font-size: 9px;
            line-height: 1;
            border-radius: 3px !important;
            margin: 1px;
        }
    </style>
    <div class="control-bar">
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <div class="slogan text-center">Reporte de Matrícula y Pensiones
                    </div>
                </div>
            </div><!--.row-->
        </div><!--.container-->
    </div><!--.control-bar-->
    <div class="col-1">
        <header class="row">
            <div class="logoholder text-center">
                <img src="assets/images/logo.webp" alt="Isotipo Colegio Mundo Feliz" width="85px">
            </div><!--.logoholder-->

            <div class="me">
                <h3>
                    <strong>I.E.P.</strong><br>
                    Mundo Feliz<br>
                    RUC: 10752090625<br>
                    Año Lectivo:{{$anolect->años}}
                </h3>
            </div><!--.me-->


            <div class="info text-righ">
                <h4>
                    Web:<a href="">www.mundofeliz.edu.pe</a><br>
                    E-mail:<a href="mailto:info@mundofeliz.edu.pe">info@mundofeliz.edu.pe</a><br>
                    Cel: 961 141 838 - 922 916 052
                </h4>
            </div><!-- .info -->


        </header>
        <div>
            <h1>
                {{$mostraraula->nivel}} {{$mostraraula->grado}} {{$mostraraula->seccion}}
            </h1>
        </div>

    </div>

    <div class="container">
        

        <div class="table-responsive mt-4">
            <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Estudiante</th>
                        <th>DNI</th>
                        <th>Nivel</th>
                        <th>Pensión</th>
                        <th>D.Admisión</th>

                        <!--                    <th>Código</th> -->
                    </tr>
                </thead>
                <tbody>
                    @php
                    $contador=1;
                    @endphp
                    @forelse($matricula as $matri)
                    <tr>
                        <td>
                            <h4>{{$contador}}</h4>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <h5>{{$matri->estudiante->apellidos}}, {{$matri->estudiante->nombre}} @if($matri->estado==1) <span class="badge bg-danger"> trasladado</span> @endif </h5>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <h5>{{$matri->estudiante->dni}}</h5>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <h5>{{$matri->aula->nivel}} {{$matri->aula->grado}} {{$matri->aula->seccion}}</h5>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex; flex-wrap:wrap; gap:8px;">
                                @forelse($matri->meses as $me)
                                <a href="#" class="iq-media-1" style="display:inline-block; padding:0px 0px; background:#F5CCD0; border-radius:6px;">
                                    <div>{{ $me->mes }}</div>
                                </a>
                                @empty
                                @endforelse
                            </div>

                        </td>

                        <td>
                            @php

                            $pensiones = $matri->estudiante->pagos->flatMap->pensiones;
                            $conceptosMostrar = [
                            'M2025' => 'MTR',
                            'C2025' => 'COP',
                            'PSC2025' => 'PS',
                            'UE2025' => 'UTE',
                            ];
                            @endphp

                            <div style="display:flex; flex-wrap:wrap;">

                                @foreach ($conceptosMostrar as $codigo => $label)
                                @if ($pensiones->firstWhere('concepto.codigo', $codigo))
                                <span style="
                    display:inline-block; 
                    padding:0px; 
                    background:#F5CCD0; 
                    border-radius:6px;
                    margin:2px;">
                                    {{ $label }}
                                </span>
                                @endif
                                @endforeach

                            </div>
                        </td>

                    </tr>
                    @php
                    $contador++;
                    @endphp
                    @empty
                    @endforelse

                </tbody>
            </table>
        </div>

    </div><!--.invoice-body-->
    <div class="invoicelist-body">

    </div>

    <div class="note" contenteditable>
        <h2>Nota:</h2>
    </div><!--.note-->

    <footer class="row">
        <!--         <div class="piedepagina">
            <img src="assets/images/piedepáginapdf.webp" alt="Pie de Página" width="174%">
        </div> -->
    </footer>


</body>

</html>