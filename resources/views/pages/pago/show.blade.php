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
            <div class="row col-md-6">
       <p class="col-md-5">Estudiante: <b>{{$est->nombre}} {{$est->apellidos}} </b> </p>
            <p class="col-md-12">Número Comprobante: <b>{{$est->numcomprobante}}</b> </p>
            <p class="col-md-12">Fecha: <b>{{$est->fecha}}</b> </p>
            <p class="col-md-12">Monto Total: <b> s/.{{$est->montototal}}</b> </p>
            </div>
            <div class="col-md-6">
            <p class="col-md-12">Imagen(ARCHIVO):</p>
                @if(($est->archivo) !="")
                <img class="bg-soft-primary rounded img-fluid avatar-40 me-3" src="{{ asset('storage/pagos/' . $est->archivo) }}" alt="{{$est->id}}" class="img-thumbnail" style="width: 30vh;height: 35vh">

                @else
            <p>Ninguno</p>

            @endif
            

            </div>
     
         



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

            <p class="col-md-2"> <b>{{$art->cantidad}} x s/{{$art->montoar}}</b> </p>


        </div>

        @empty
        @endforelse

        @forelse($pension as $p)
        <div class="row display-flex flex-wrap-wrap">
            <p class="col-md-5">{{$p->concepto}}</p>
            <p class="col-md-2"> <b>{{$p->cantidad}} x s/{{$p->monto}}</b> </p>

        </div>

        @empty
        @endforelse
    </div>

</div>




@endsection