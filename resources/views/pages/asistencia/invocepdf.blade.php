<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro de asistencia
    </title>
    <link rel="stylesheet" href="../public/pdf/assets/css/comprobantepdf.css">
</head>

<body>
    <style>
        .page_break {
            page-break-before: always;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            /* Para un borde único entre celdas */
        }

        th
        {
            border: 1px solid #cccccc;
            /* Borde de celda */
            padding: 0px;
            text-align: center;
        }
        td {
            border: 1px solid #cccccc;
            /* Borde de celda */
            text-align: center;
            line-height: 1px !important;/* también ayuda */
        }
        th {
            background-color: #f2f2f2;
            /* Fondo para encabezados */
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Color alterno para filas */
        }
    </style>
    <div class="control-bar">
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <div class="slogan text-center">Hoja de Asistencia
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
                    MUNDO FELIZ<br>
                    RUC: 10752090625<br>
                    Lista de Docentes
                </h3>
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
                <h1 width="50%">Mes</h1>
            </div>
            <div class="col-md-6">
                <h1 width="50%">{{Carbon\Carbon::parse($me)->translatedFormat('F')}}</h1>
            </div>

        </div>


        <table>
            <thead>
                <tr>
                    <th>Nº</th>
                    <th width="20%">Docente</th>
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
                        <h6>{{$item->nombre}}, {{$item->apellidos}}</h6>
                    </td>


                    @forelse($dias as $di)
                        @if(Carbon\Carbon::parse($di)->Format('Y-m')==$me)
                        <?php $contador = 1; ?>

                            @forelse($item->asistenciadocentehoy->toArray() as $asis)
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