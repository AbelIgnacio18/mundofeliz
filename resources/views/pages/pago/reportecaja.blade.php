Te paso el código:
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos </title>
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

     

    </styl>
    <div class="control-bar">
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <div class="slogan text-center">Reporte de Pago </div>
                </div>
            </div><!--.row-->
        </div><!--.container-->
    </div><!--.control-bar-->
    <div class="col-1">
        <header class="row">
            <div class="logoholder text-center"> <img src="assets/images/logo.webp" alt="Isotipo Colegio Mundo Feliz" width="85px"> </div><!--.logoholder-->
            <div class="me">
                <h2> <strong>I.E.P.</strong><br> MUNDO FELIZ<br> RUC: 10752090625<br> </h2>
            </div><!--.me-->
            <div class="info">
                <h3> DINERO EN EFECTIVO: <span style="color:#f16a1b; font-size: 18px">s/{{$totales->total_efectivo}}</span> <br> DINERO DIGITAL: <span style="color:#6610f2; font-size: 18px">s/{{$totales->total_digital}}</span> <br> MONTO TOTAL: <span style="color:#3a57e8; font-size: 18px">s/{{$totales->total_monto}}</span> </h3>
            </div><!-- .info -->
        </header>
    </div>
    <div class="container">
        <table class="table table-striped" role="grid" data-toggle="data-table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Boleto</th>
                    <th>Nombre Completo</th>
                    <th>Fecha</th>
                    <th>D.Efectivo</th>
                    <th>D.Digital</th>
                    <th>Monto Total</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody> <?php $contadorpago = 1; ?> @forelse($pago as $pag) <tr>
                    <td>
                        <div class="d-flex align-items-center"> <?php echo $contadorpago; ?> </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <h4>{{$pag->numcomprobante}}</h4>
                        </div>
                    </td>
                    <td>
                        <div class="icon iq-icon-box-3"> {{$pag->apellidos}} {{$pag->nombre}}</div>
                    </td>
                    <td>
                        <h5>{{Carbon\Carbon::parse($pag->created_at)->translatedFormat('l, j F Y h:i A')}}</h5>
                    </td>
                    <td>
                        <h4 style="color:#f16a1b">S/ {{$pag->montoefectivo}}</h4>
                    </td>
                    <td>
                        <h4 style="color:#6610f2">S/ {{$pag->montodigital}}</h4>
                    </td>
                    <td>
                        <h4 style="color:#3a57e8">S/ {{$pag->montototal}}</h4>
                    </td>
                    <td>
                        <h5>{{$pag->descripcion}}</h5>
                    </td>
                </tr> <?php $contadorpago++; ?> @empty <div class="alert alert-danger d-flex align-items-center" role="alert"> <svg class="flex-shrink-0 bi me-2 icon-24" width="24" height="24">
                        <use xlink:href="#exclamation-triangle-fill"></use>
                    </svg>
                    <div> No hay Datos </div>
                </div> @endforelse </tbody>
        </table>
</body>

</html>