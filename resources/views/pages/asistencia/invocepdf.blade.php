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
        <strong>Hoja de Asistencia</strong>
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
    height: 20px; /* Ajusta a tu barra */
    z-index: 999;
}
         html, body {
        margin: 5px !important;
        padding: 0 !important;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }

  

    th {
        background-color: #f0f0f0;
        font-weight: bold;
        font-size: 15px;
        padding: 2px !important;
    }

    li {
        list-style-type: none;
        padding: 0 !important;
        margin: 0 !important;
        line-height: 0.9rem !important; /* 🔥 MÁS BAJO */
        font-size: 10px !important;
        font-weight: 700 /* 🔥 SUPER COMPACTO */
    }
    

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table td, table th {
        padding: 1px 2px !important;
        line-height: 0.9;
    }

    th, td {
        border: 1px solid #ccc;
    }

    /* Alternar filas más sutil */
    tr:nth-child(even) {
        background-color: #f8f8f8;
    }
</style>

    
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
    







    <div class="container ">


        @forelse($meses as $me)
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 width="50%">Mes</h1>
            </div>
            <div class="col-md-6">
                <h1 width="50%">{{Carbon\Carbon::parse($me)->translatedFormat('F')}}</h1>
            </div>


        </div>


        <table style="margin-top: 10px;">
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
                        <h6>{{$item->apellidos}} {{$item->nombre}} </h6>
                    </td>





                    @forelse($dias as $di)
                    @if(Carbon\Carbon::parse($di)->Format('Y-m')==$me)
                    @php
                    $fecha = Carbon\Carbon::parse($di);
                    $esFinDeSemana = $fecha->isSaturday() || $fecha->isSunday();
                    @endphp


                    <?php $contador = 1; ?>
                    <td style="{{ $esFinDeSemana ? 'background-color:#d8d1d1ff;' : '' }}">
                        @forelse($item->asistenciadocentehoy->toArray() as $asis)
                        @if(Carbon\Carbon::parse($di)->Format('Y-m-d')== Carbon\Carbon::parse($asis['fechaentrada'])->Format('Y-m-d'))

                        @if($asis['estado']===1)
                        <li style="background-color: green;color:white;font-size:13px;padding:1px 1px;">

                            {{ Carbon\Carbon::parse($asis['created_at'])->setTimezone('America/Lima')->format('h:i A') }}
                        </li>

                        @endif
                        @if($asis['estado']===0)
                        <li style="background-color: orange;color:black;font-size:13px;padding:1px 1px;">

                            {{ Carbon\Carbon::parse($asis['created_at'])->setTimezone('America/Lima')->format('h:i A') }}
                        </li>

                        @endif
                        @if($asis['estado']===null)
                        <li style="background-color: red;color:white;font-size:13px;padding:1px 1px;">

                            {{ Carbon\Carbon::parse($asis['created_at'])->setTimezone('America/Lima')->format('h:i A') }}
                        </li>

                        @endif



                        <?php $contador = 0; ?>
                        @endif

                        @empty
                        @endforelse

                        @if($contador==1)

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






    </div><!--.invoice-body-->
    <div class="invoicelist-body">

    </div>



    <div class="note" contenteditable>
        <!-- <h2>Nota:</h2> -->
    </div><!--.note-->

    <footer class="row">
        <div class="col-1 text-center">
            <p class="notaxrelated">Gracias por su preferencia.</p>
        </div>


        <!-- <div class="piedepagina">
            <img src="assets/images/piedepáginapdf.webp" alt="Pie de Página" width="100%">
        </div> -->
    </footer>



</body>

</html>