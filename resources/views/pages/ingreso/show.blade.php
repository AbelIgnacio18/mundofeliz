@extends('layouts.master')

@section('tab_tittle','Detalle de estudiante')

@section('content')
<div class="card-header d-flex justify-content-between flex-wrap">

    <div class="header-title">
        <h3 class="text-primary card-title mb-0">Detalle de compra de Articulos</h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h6>Registrado</h6> {{$ingreso->name}} {{$ingreso->fecha}}
        </div>
    </div>

</div>

<div class="card-body px-2">
    <table class="table table-striped table-hover" id="detalles">
        <thead style="background-color:#A9D0F5">

            <tr>
                <th>Articulo</th>
                <th>Cantidad</th>
                <th>P. Compra</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($detalleingreso as $dt)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <h6>{{$dt->nombre}}</h6>
                    </div>
                </td>

                <td>
                    <div class="iq-media-group iq-media-group-1">
                        <h6>{{$dt->cantidad}}</h6>
                    </div>
                </td>

                <td>
                    <div class="mb-2 d-flex align-items-center">
                        <h6>{{$dt->preciocosto}}</h6>
                    </div>

                </td>
                <td>
                    <div class="mb-2 d-flex align-items-center">
                        <h6>{{$dt->montototal}}</h6>
                    </div>

                </td>

            </tr>
            @empty
            @endforelse

        </tbody>
        <tfoot>
            <th>TOTAL</th>

            <th></th>
            <th>
                <h6 id="total"> {{$ingreso->montototal}}</h6>
            </th>
            </tfood>
    </table>
</div>


</div>



@endsection