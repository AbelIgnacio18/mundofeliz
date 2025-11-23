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

        tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Color alterno para filas */
        }
    </style>

    <div class="col-12 py-2">
        <header class="row">
        

            <div class="col-md-4">
                <h6>
                    
                
                    Docente: @forelse($items as $item)  {{$item->nombre}}, {{$item->apellidos}}  @empty @endforelse
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



    <div class="container">


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



    </div><!--.invoice-body-->
    <div class="invoicelist-body">

    </div>

<div class="form-group text-center pt-lg-3">
    <a href="{{url('dashboard/asistencia-docentes')}}" class="btn btn-secondary" type="submit">Regresar</a>
</div>

@endsection


