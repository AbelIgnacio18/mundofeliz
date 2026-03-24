@extends('layouts.master')

@section('tab_tittle', 'Lista de aulas')

@section('content')
    <div class="card-header d-flex justify-content-between flex-wrap">
        <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12">

            <!--SI LOS ERRORES SON DE  LLLAMAMOS Y MOSTRAMOS LOS ERRORES-->
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="header-title">
            <h4 class="card-title mb-0">Lista de Asistencia Docente y Administrativos</h4>
            <h4 class="card-title mb-3"><span
                    class="badge bg-dark">{{ Carbon\Carbon::parse(date('Y-m-d'))->translatedFormat('l, j F Y') }}</span></h4>

        </div>

        <!-- modal para crear nuevos conceptos de pagooo -->
        <div class="">

            <a href="#" class="text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop-1">
                <i class="btn-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </i>
                <span>Registrar</span>
            </a>
            {{-- <a href="#" class="text-center btn btn-secondary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal"
                data-bs-target="#registrarfalta-1">
                <i class="btn-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </i>
                <span>Registrar Falta</span>
            </a> --}}
            <a class="btn btn-danger btn-round ml-auto" type="button" target="_blank"
                href="{{ route('app.reporteasistenciadocente') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z">
                    </path>
                </svg>
            </a>

            @include('pages.asistencia.create')
            @include('pages.asistencia.registrarfalta')



        </div>
    </div>
    <form action="asistencia-docentes" method="GET" autocomplete="off">
        @method('GET')
        @csrf
        <div class="row">
            <div class="input-group ms-3" style="width: auto;">
                <label for="fecha" class="form-label me-2" style="margin-top: 0.7rem !important;">Fecha:</label>
                @if ($fecha == '')
                    <input type="date" class="form-control" id="fecha" name="fecha" placeholder=""
                        value="<?= date('Y-m-d') ?>">

                    <button class="input-group-text btn-primary">
                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></circle>
                            <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                @else
                    <input type="date" class="form-control" id="fecha" name="fecha" placeholder=""
                        value="{{ $fecha }}">

                    <button class="input-group-text btn-info">
                        <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></circle>
                            <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                @endif

                <div class="invalid-feedback">
                    Seleccione una fecha válida.
                </div>
                <div class="valid-feedback">
                    ¡Se ve bien!
                </div>
            </div>


        </div>
    </form>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="user-list-table" class="table" role="grid" data-toggle="data-table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombres</th>
                        <th>Asistencia</th>
                        <th>Entr./Sal.</th>
                        <th>Minuto Tarde</th>

                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $numeracion = 1;

                    @endphp
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <h6>{{ $numeracion }}</h6>
                                </div>
                            </td>
                            <td>
                                <h6>{{ $item->user->apellidos }}, {{ $item->user->name }}</h6>
                            </td>
                            <td>
                                <div class="dropdown position-static">
                                    <button data-id="{{ $item->id }}"
                                        class="btn btn-sm 
                                @switch($item->estado)
                                    @case(1) btn-success @break
                                    @case(0) btn-warning @break
                                    @case(4) btn-danger @break
                                
                                    @default btn-outline-secondary
                                @endswitch dropdown-toggle"
                                        type="button" data-bs-toggle="dropdown">

                                        @switch($item->estado)
                                            @case(1)
                                                A
                                            @break

                                            @case(0)
                                                T
                                            @break

                                            @case(4)
                                                F
                                            @break

                                            @default
                                                -
                                        @endswitch

                                    </button>

                                    <ul class="dropdown-menu shadow">
                                        <li><a class="dropdown-item" onclick="actualizarEstado(1, {{ $item->id }})">🟢
                                                Asistió</a></li>
                                        <li><a class="dropdown-item" onclick="actualizarEstado(0, {{ $item->id }})">🟠
                                                Tarde</a></li>
                                        <li><a class="dropdown-item"
                                                onclick="actualizarEstado(4, {{ $item->id }})">🔴 Falta</a></li>

                                    </ul>
                                </div>
                            </td>
                            <td class="small">
                                <div>
                                    <strong>{{ Carbon\Carbon::parse($item->horaentrada)->format('h:i A') }}</strong>
                                </div>
                                <div class="text-muted">
                                    {{ $item->horasalida != null ? Carbon\Carbon::parse($item->horasalida)->format('h:i A') : '—' }}
                                </div>
                            </td>
                            <td>
                                <h6>
                                    {{ $item->minutos_tarde }}
                                </h6>
                            </td>

                            <td>
                                <div class="flex align-items-center list-user-action">



                                    <a class="btn btn-sm btn-icon text-success" data-bs-original-title="Ver"
                                        href="{{ route('app.asistencia.show', $item->user->id) }}">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>
                                    <a class="btn btn-sm btn-icon text-danger" data-bs-toggle="modal"
                                        data-bs-original-title="Eliminar"
                                        data-bs-target="#model-delete-{{ $item->user->id }}">
                                        <span class="btn-inner">
                                            <svg width="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                <path
                                                    d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path
                                                    d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </a>

                                </div>
                            </td>
                        </tr>
                        @include('pages.asistencia.modal')

                        @php
                            $numeracion++;

                        @endphp
                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    @endsection
