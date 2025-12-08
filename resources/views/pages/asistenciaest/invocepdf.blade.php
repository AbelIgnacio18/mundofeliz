<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro de asistencia
    </title>
    <link rel="stylesheet" href="../public/pdf/assets/css/comprobantepdf.css">
</head>
<htmlpageheader name="headerasistencia">
    <div style="width:100%; text-align:center; font-size:14px; padding:5px 0;
                border-bottom: 2px solid #c00000;">
        <strong>Reporte de Asistencia</strong>
    </div>


</htmlpageheader>
<body>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        @page {
            margin-top: 130px;
            margin-left: 20px;
            margin-right: 20px;
            margin-bottom: 60px;
        }

        .page_break {
            page-break-before: always;

        }

        .control-bar-2 {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 20px;
            /* Ajusta a tu barra */
            z-index: 999;
        }

        html,
        body {
            margin: 5px !important;
            padding: 0 !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #D72B3B;
            color: white;
            font-weight: bold;
            font-size: 15px;
            padding: 2px !important;
        }

        li {
            list-style-type: none;
            padding: 0 !important;
            margin: 0 !important;
            line-height: 0.9rem !important;
            /* 🔥 MÁS BAJO */
            font-size: 10px !important;
            font-weight: 700
                /* 🔥 SUPER COMPACTO */
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            padding: 1px 2px !important;
            line-height: 0.9;
        }

        th,
        td {
            border: 1px solid #ccc;
        }

        /* Alternar filas más sutil */
        tr:nth-child(even) {
            background-color: #f8f8f8;
        }
    </style>
    <div class="col-1">
        <header class="row">
            <div class="logoholder text-center">
                <img src="assets/images/logo.webp" alt="Isotipo Colegio Mundo Feliz" width="85px">
            </div><!--.logoholder-->

            <div class="me">
            <h2>
                <strong>I.E.P.</strong><br>
                MUNDO FELIZ<br>
                www.mundofeliz.edu.pe<br>
                Cel: 961 141 838 / 922 916 052
            </h2>
            </div><!--.me-->

            <div class="info text-righ">
                <div style=" display: flex;;flex-direction: row;">
                    <div style="width: 40px;">Temprano:</div>
                    <div style="background-color: green;width: 40px;color: green">ll</div>

                </div>
                <div style=" display: flex;;flex-direction: row;">
                    <div style="width: 40px;">Tarde:</div>
                    <div style="background-color: orange;width: 40px;color: orange">ll</div>

                </div>
                <div style=" display: flex;;flex-direction: row;">
                    <div style="width: 40px;">Faltó:</div>
                    <div style="background-color: red;width: 40px;color: red">ll</div>

                </div>
            </div><!-- .info -->

        </header>
    </div>


    <div class="container">

        @forelse($meses as $me)
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 width="50%"><span style="font-size: 1.5rem; color: #000">Aula: </span>{{$nombreaula->nivel}} {{$nombreaula->grado}} {{$nombreaula->seccion}}</h1>
            </div>
            <div class="col-md-6">
                <h1 width="50%"><span style="font-size: 1.5rem; color: #000">Mes: </span>{{Carbon\Carbon::parse($me)->translatedFormat('F')}}</h1>
            </div>

        </div>


        <table style="margin-top: 8px;">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th width="20%">Estudiante</th>
                    @forelse($dias as $di)

                    @if(Carbon\Carbon::parse($di)->Format('Y-m')==$me)
                    <th>
                        {{Carbon\Carbon::parse($di)->Format('d')}}
                    </th>
                    @endif

                    @empty
                    @endforelse
                </tr>
            </thead>
            <tbody>
                <?php $contadorgallo = 1; ?>
                @forelse($items as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <?php echo $contadorgallo; ?>
                        </div>
                    </td>
                    <td>
                        <h6>{{$item->estudiantes->apellidos}}, {{$item->estudiantes->nombre}}</h6>
                    </td>


                    @forelse($dias as $di)
                    @if(Carbon\Carbon::parse($di)->Format('Y-m')==$me)
                    <?php $contador = 1; ?>

                    @forelse($item->asistenciahoy->toArray() as $asis)
                    @if(Carbon\Carbon::parse($di)->Format('Y-m-d')== Carbon\Carbon::parse($asis['fechaentrada'])->Format('Y-m-d'))
                    @if($asis['estado']===1)
                    <td style="background-color: green;">
                        .
                    </td>

                    @endif
                    @if($asis['estado']===0)
                    <td style="background-color: orange;">
                        .
                    </td>

                    @endif
                    @if($asis['estado']===null)
                    <td style="background-color: red;">
                        .
                    </td>

                    @endif

                    <?php $contador = 0; ?>
                    @endif

                    @empty
                    @endforelse

                    @if($contador==1)
                    <td></td>
                    <?php $contador = 1; ?>
                    @endif



                    @endif
                    @empty
                    @endif


                    </td>


                </tr>

                <?php $contadorgallo++; ?>

                @empty
                @endforelse


            </tbody>
        </table>
        <div class="page_break">
        </div>
        @empty
        @endforelse


</body>

</html>