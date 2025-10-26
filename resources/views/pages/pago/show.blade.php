@extends('layouts.master')

@section('tab_tittle','Detalle de estudiante')

@section('content')
<div class="card-header d-flex justify-content-between flex-wrap">

    <div class="header-title">
        <h3 class="text-primary card-title mb-0">Ver Comprobante</h3>
    </div>

</div>

<div class="px-2">
    <div class="card-header ">
        <h5 class="py-3">Datos Personales</h5>
        @forelse($estudiante as $est)
        <div class="row ">
            <p class="col-md-5">Estudiante: <b>{{$est->nombre}} {{$est->apellidos}} </b> </p>

            <p class="col-md-12">Fecha: <b>{{$est->fecha}}</b> </p>
            <p class="col-md-12">Monto Total: <b>{{$est->montototal}}</b> </p>


        </div>
        @empty
        @endforelse
       

   
    </div>
    <div class="card-header">
         <h5>Detalles de pagos</h5>
        <br>
        @forelse($articulo as $art)
        <div class="row display-flex flex-wrap-wrap">
            <p class="col-md-5">{{$art->categoria}} {{$art->articulo}}</p>

            <p class="col-md-2"> <b>{{$art->cantidad}} x {{$art->montoar}}</b> </p>


        </div>

        @empty
        @endforelse

        @forelse($pension as $p)
        <div class="row display-flex flex-wrap-wrap">
            <p class="col-md-5">{{$p->concepto}}</p>
            <p class="col-md-2"> <b>{{$p->cantidad}} x {{$p->monto}}</b> </p>

        </div>

        @empty
        @endforelse
    </div>

</div>




@endsection