@extends('layouts.master')

@section('tab_tittle','Registro de asistencia')

@section('content')


<style>
    .page_break {
        page-break-before: always;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        /* Para un borde único entre celdas */
    }

    th,
    td {
        border: 1px solid #cccccc;
        /* Borde de celda */
        padding: 2px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        /* Fondo para encabezados */
        font-weight: bold;
    }
      li{
            list-style-type: none;
            font-size: 12px !important;
            font-weight:700;
        }


    tr:nth-child(even) {
        background-color: #f9f9f9;
        /* Color alterno para filas */
    }
</style>

<div class="col-12 p-2">
    <header class="row">


        <div class="col-md-4">
            <h6>


                Alumno: @forelse($items as $item) {{$item->estudiante->nombre}}, {{$item->estudiante->apellidos}} @empty @endforelse
            </h6>
        </div><!--.me-->



        <div class="col-md-12">
            <div style=" display: flex;;flex-direction: row;">
                <div class="col-md-1">Temprano:</div>
                <div style="background-color: green;width: 40px;color: green">ll</div>

            </div>
            <div style=" display: flex;;flex-direction: row;">
                <div class="col-md-1">Tarde:</div>
                <div style="background-color: orange;width: 40px;color: orange">ll</div>

            </div>
            <div style=" display: flex;;flex-direction: row;">
                <div class="col-md-1">Faltó:</div>
                <div style="background-color: red;width: 40px;color: red">ll</div>

            </div>
        </div><!--.me-->


    </header>
</div>







<div class="container table-responsive mt-4">


    @forelse($meses as $me)
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h6 width="50%">Mes</h6>
        </div>
        <div class="col-md-6">
            <h6 width="50%">{{Carbon\Carbon::parse($me)->translatedFormat('F')}}</h6>
        </div>


    </div>


    <table>
        <thead>
            <tr>
                <th>Nº</th>

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

                @forelse($dias as $di)
                @if(Carbon\Carbon::parse($di)->Format('Y-m')==$me)
                @php
                $fecha = Carbon\Carbon::parse($di);
                $esFinDeSemana = $fecha->isSaturday() || $fecha->isSunday();
                $contador = 1;
                @endphp

                <td style="{{ $esFinDeSemana ? 'background-color:#d8d1d1;' : '' }}">
                    @forelse($item->asistenciahoy->toArray() as $asis)
                    @if(Carbon\Carbon::parse($di)->Format('Y-m-d')== Carbon\Carbon::parse($asis['fechaentrada'])->Format('Y-m-d'))
                    @if($asis['estado']===1)
                    <li style="background-color: green;color:white;padding:0px 1px">
                        {{ Carbon\Carbon::parse($asis['created_at'])->setTimezone('America/Lima')->format('h:i A') }}


                    </li>

                    @endif
                    @if($asis['estado']===0)
                    <li style="background-color: orange;color:black;padding:0px 1px">

                        {{ Carbon\Carbon::parse($asis['created_at'])->setTimezone('America/Lima')->format('h:i A') }}

                    </li>

                    @endif
                    @if($asis['estado']===null)
                    <li style="background-color: red;color:white;padding:0px 1px">
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

                </td>

                @endif
                @empty
                @endif






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

<div class="form-group text-center pt-lg-3">
    <a href="{{url('dashboard/asistencia-estudiantes')}}" class="btn btn-secondary" type="submit">Regresar</a>
</div>


@endsection