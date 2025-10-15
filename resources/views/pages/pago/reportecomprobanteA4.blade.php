<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Boleta @forelse($estudiante as $est)
        {{$est->nombre}} {{$est->apellidos}}

        @empty
        @endforelse
    </title>
    <link rel="stylesheet" href="../public/pdf/assets/css/comprobantepdf.css">
</head>

<body>
    <div class="control-bar">
        <div class="container">
            <div class="row">
                <div class="col-1">
                    <div class="slogan text-center">Boleta Electrónica
                    </div>
                </div>
            </div><!--.row-->
        </div><!--.container-->
    </div><!--.control-bar-->
    <div class="col-1">
        <header class="row">
            <div class="logoholder text-center">
                <img src="assets/images/logo.png" width="85px">
            </div><!--.logoholder-->

            <div class="me">
                <h3>
                    <strong>Colegio</strong><br>
                    MUNDO FELIZ<br>
                    RUC: 10752090625<br>
                </h3>
            </div><!--.me-->

            <div class="info text-righ">
                <h4>
                    Web:<a href="">www.mundofeliz.edu.pe</a><br>
                    E-mail:<a href="mailto:info@academiauc">info@mundofeliz.edu.pe</a><br>
                    Cel: 961 141 838 - 922 916 052
                </h4>
            </div><!-- .info -->

        </header>
    </div>


    <div class="col-1">

        <div class="row section">

            <div class="me">
                <h1>Boleta de Venta Electrónica</h1>
            </div><!--.col-->

            <div class="fecha text-right details">
                @forelse($estudiante as $est)
                <h4>
                    N° de Boleta: <input type="text" value="{{$est->id}}" /><br>
                    Fecha:{{$est->fecha}} <input type="text" class="datePicker" /><br>
                </h4>
                @empty
                @endforelse

            </div><!--.col-->
        </div><!--.row-->
    </div>

    <div class="col-2">
        <h3 class="client">

            @forelse($estudiante as $est)

            <h3>CLIENTE: {{$est->nombre}} {{$est->apellidos}}<br></h3>
            <h3>DNI: {{$est->dni}}<br></h3>
            
            @empty
            @endforelse

        </h3>
    </div><!--.col-->


    @if(count($pension)!=0)
    <div class="invoicelist-body">
        <table>
            <thead>
                <th width="5%">Código</th>
                <th width="60%">Descripción</th>

                <th width="10%">Cant.</th>
                <th width="15%">Precio</th>
                <th class="taxrelated">IGV</th>
                <th width="10%">Importe</th>
            </thead>
            <tbody>
                @forelse($pension as $p)

                <tr>
                    <td width='5%'><a class="control removeRow" href="#">x</a> <span contenteditable>{{$p->codigo}}</span></td>
                    <td width='60%'><span contenteditable>{{$p->concepto}}</span></td>
                    <td class="amount">{{$p->cantidad}}</td>
                    <td class="rate">{{$p->monto/$p->cantidad}}</td>
                    <td class="tax taxrelated">0.00</td>
                    <td class="sum">{{$p->monto}}</td>
                </tr>
                @empty
                @endforelse

            </tbody>
        </table>
    </div><!--.invoice-body-->
    @endif
    @if(count($articulo)!=0)
    <div class="invoicelist-body">
        <table>
            <thead >
                <th width="15%">Descripción</th>
                <th width="10%">Cant.</th>
                <th width="15%">Precio</th>
                <th width="10%">Importe</th>
            </thead>

            <tbody>
                @forelse($articulo as $art)
                <tr >
                    <td width="10%">{{$art->articulo}}</td>
                    <td>{{$art->cantidad}}</td>
                    <td>s/.{{$art->montoar/$art->cantidad}}</td>
                    <td>s/.{{$art->montoar}}</td>
                </tr>
                @empty
                @endforelse



            </tbody>
        </table>
    </div>

    @endif

    <div class="invoicelist-footer">
        <table contenteditable>
            <tr class="taxrelated">
                <td>IGV:</td>
                <td id="total_tax"> 0.00</td>
            </tr>
            @forelse($estudiante as $est)
            <tr>
                <td><strong>Total:</strong></td>
                <td id="total_price">{{$est->montototal}}</td>
            </tr>
            @empty
            @endforelse


        </table>
    </div>

    <div class="note" contenteditable>
        <h2>Nota:</h2>
    </div><!--.note-->

    <footer class="row">
        <div class="col-1 text-center">
            <p class="notaxrelated">Gracias por su preferencia.</p>
        </div>


        <div class="piedepagina">
            <img src="assets/images/piedepáginapdf.png" alt="Pie de Página" width="121%">
        </div>
    </footer>



</body>

</html>