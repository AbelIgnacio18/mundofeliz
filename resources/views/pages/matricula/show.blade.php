@extends('layouts.master')

@section('tab_tittle','Detalle de estudiante')

@section('content')
<div class="card-header d-flex justify-content-between flex-wrap">

    <div class="header-title">
        <h3 class="text-primary card-title mb-0">Detalle de Pago de Pensiones</h3>
    </div>

</div>

<div class="card-body px-2">
    <div class="mt-4 table-responsive">
        <table id="basic-table" class="table mb-0 table-striped" role="grid">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Pensión</th>
                    <th>Avance Pago</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <h6>{{$matricula->estudiantes->nombre}} {{$matricula->estudiantes->apellidos}} </h6>
                        </div>
                    </td>

                    <td>
                        <div class="iq-media-group iq-media-group-1">
                            @forelse($mes as $me)
                            <a href="#" class="iq-media-1">
                                <div class="icon iq-icon-box-3 rounded-pill">{{$me->mes}}</div>
                            </a>
                            @empty
                            @endforelse
                        </div>
                    </td>

                    <td>
                        <div class="mb-2 d-flex align-items-center">
                            <h6>{{$avancepen*10}}%</h6>
                        </div>
                        <div class="shadow-none progress bg-soft-primary w-100" style="height: 4px">
                            <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="{{$avancepen*10}}" aria-valuemin="0" aria-valuemax="100" style="width: 60%; transition: width 2s ease 0s;"></div>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>


</div>

<div class="card-header d-flex justify-content-between flex-wrap mb-2">
    <div class="header-title">
        <h6 class="card-title mb-0">Pagos por Concepto</h6>
    </div>
</div>

<div class="px-4">
    <div class="card-transparent mb-0 desk-info">
        <div class="">
            <div class="row">

                @forelse($otros as $otr)
                <div class="col-lg-3  shadow group__item">
                    <div class="card" style="background-color: #ffffff63">
                        <div class="card-body">
                            <div class="d-grid grid-flow-col align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">{{$otr->concepto}}</p>
                                </div>
                            </div>
                            
                            <h6 class="mb-3">{{Carbon\Carbon::parse($otr->fecha)->translatedFormat('l, j F Y h:i A')}}</h6>
                            
                            <div class="iq-media-group-1">
                            
                                <a href="#" class="iq-media-1">
                                
                                    <div class="icon text-danger h3">
                                    s/ {{$otr->monto}}
                                    </div>
                                </a>
                            </div>
                        </div>
                        <span class="remove"> Nº Cant. {{$otr->cantidad}}</span>
                    </div>
                </div>
                @empty
                @endforelse

            </div>
          
        </div>
    </div>

</div>

<div class="card-header d-flex justify-content-between flex-wrap mb-2">
    <div class="header-title">
        <h6 class="card-title mb-0">Pagos por Artículos</h6>
    </div>
</div>

<div class="px-4">
    <div class="card-transparent mb-0 desk-info">
        <div class="">
            <div class="row">

                @forelse($articulo as $art)
                <div class="col-lg-3  shadow group__item">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-grid grid-flow-col align-items-center justify-content-between mb-2">
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">{{$art->articulo}}</p>
                                </div>
                            </div>
                            
                            <h6 class="mb-3">{{Carbon\Carbon::parse($art->fecha)->translatedFormat('l, j F Y h:i A')}}</h6>
                            
                            <div class="iq-media-group-1">
                            
                                <a href="#" class="iq-media-1">
                                
                                    <div class="icon text-danger h4">Precio Unit: s/ {{$art->montoar}}
                                    </div>
                                </a>
                            </div>
                        </div>
                        <span class="remove"> Nº Cant. {{$art->cantidad}}</span>
                    </div>
                </div>
                @empty
                No hay Datos
                @endforelse

            </div>
            
           
          
        </div>
    </div>

</div>

<div class="form-group text-center">
    <a href="{{url('dashboard/matriculas')}}" class="btn btn-secondary" type="submit">Regresar</a>
</div>
@endsection