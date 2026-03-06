@extends('layouts.dashboard')

@section('tab_tittle', 'Dashboard')

@section('content')
    <div class="row row-cols-1">
        <div class="overflow-hidden d-slider1">
            <ul class="swiper-wrapper list-inline m-0 p-0 mb-2">

                <li class="swiper-slide">
                    <div class="card border-bottom border-5 border-0 border-info">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="bg-soft-info rounded p-3">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.8877 10.8967C19.2827 10.7007 20.3567 9.50473 20.3597 8.05573C20.3597 6.62773 19.3187 5.44373 17.9537 5.21973"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M19.7285 14.2505C21.0795 14.4525 22.0225 14.9255 22.0225 15.9005C22.0225 16.5715 21.5785 17.0075 20.8605 17.2815"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.8867 14.6638C8.67273 14.6638 5.92773 15.1508 5.92773 17.0958C5.92773 19.0398 8.65573 19.5408 11.8867 19.5408C15.1007 19.5408 17.8447 19.0588 17.8447 17.1128C17.8447 15.1668 15.1177 14.6638 11.8867 14.6638Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.8869 11.888C13.9959 11.888 15.7059 10.179 15.7059 8.069C15.7059 5.96 13.9959 4.25 11.8869 4.25C9.7779 4.25 8.0679 5.96 8.0679 8.069C8.0599 10.171 9.7569 11.881 11.8589 11.888H11.8869Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M5.88509 10.8967C4.48909 10.7007 3.41609 9.50473 3.41309 8.05573C3.41309 6.62773 4.45409 5.44373 5.81909 5.21973"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M4.044 14.2505C2.693 14.4525 1.75 14.9255 1.75 15.9005C1.75 16.5715 2.194 17.0075 2.912 17.2815"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="counter">{{ count($estudiante) }}</h3>
                                    <p class="mb-0">Total de Matriculados</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>


                <li class="swiper-slide">
                    <div class="card border-bottom border-5 border-0 border-dark">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="bg-soft-dark rounded p-3">
                                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32"
                                        viewBox="0 0 24 24">
                                        <path d="M15.7161 16.2234H8.49609" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.7161 12.0369H8.49609" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.2521 7.86011H8.49707" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.909 2.74976C15.909 2.74976 8.23198 2.75376 8.21998 2.75376C5.45998 2.77076 3.75098 4.58676 3.75098 7.35676V16.5528C3.75098 19.3368 5.47298 21.1598 8.25698 21.1598C8.25698 21.1598 15.933 21.1568 15.946 21.1568C18.706 21.1398 20.416 19.3228 20.416 16.5528V7.35676C20.416 4.57276 18.693 2.74976 15.909 2.74976Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="counter">

                                        {{ $puntualHoy + $tardeHoy + $faltaHoy }}

                                    </h3>
                                    <p class="mb-0">Cantidad de Registros</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>



                <li class="swiper-slide">
                    <div class="card border-bottom border-5 border-0 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="bg-soft-success rounded p-3">
                                    <svg class="icon-32" fill="none" xmlns="http://www.w3.org/2000/svg" width="32"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M8.43994 12.0002L10.8139 14.3732L15.5599 9.6272" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="counter">
                                        @if ($puntualHoy != 0)
                                            {{ $puntualHoy }}
                                        @else
                                            0
                                        @endif
                                    </h3>
                                    <p class="mb-0">Asistencia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="swiper-slide">
                    <div class="card border-bottom border-5 border-0 border-warning">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="bg-soft-warning rounded p-3">
                                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.334 2.75H7.665C4.644 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.333C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M11.9946 16V12" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.9896 8.2041H11.9996" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="counter">
                                        <h3 class="counter">
                                            @if ($tardeHoy != 0)
                                                {{ $tardeHoy }}
                                            @else
                                                0
                                            @endif
                                        </h3>
                                        <p class="mb-0">Tarde</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="swiper-slide">
                    <div class="card border-bottom border-5 border-0 border-danger">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="bg-soft-danger rounded p-3">
                                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32"
                                        viewBox="0 0 24 24">
                                        <path d="M14.3955 9.59497L9.60352 14.387" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14.3971 14.3898L9.60107 9.59277" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.3345 2.75024H7.66549C4.64449 2.75024 2.75049 4.88924 2.75049 7.91624V16.0842C2.75049 19.1112 4.63549 21.2502 7.66549 21.2502H16.3335C19.3645 21.2502 21.2505 19.1112 21.2505 16.0842V7.91624C21.2505 4.88924 19.3645 2.75024 16.3345 2.75024Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="counter">
                                        <h3 class="counter">
                                            @if ($faltaHoy != 0)
                                                {{ $faltaHoy }}
                                            @else
                                                0
                                            @endif
                                        </h3>
                                        <p class="mb-0">Falta</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>



            </ul>

            <div class="swiper-button swiper-button-next"></div>
            <div class="swiper-button swiper-button-prev"></div>

        </div>

        {{-- <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="counter mb-3">Ventas de Artículos</h2>


                        <div class="mt-3">
                            @forelse($pagosarticulos as $part)
                                <div class="pb-3">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <p class="mb-0">{{ $part->categoria }} <b>s/{{ $part->monto }}</b> </p>
    <h4>{{ $part->cantidad }}</h4>
</div>
<div class="progress bg-soft-info shadow-none w-100" style="height: 10px">
    <div class="progress-bar " data-toggle="progress-bar" role="progressbar"
        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
@empty
<span class="badge bg-danger"> No hay Artículos vendidos</span>
@endforelse


</div>
</div>
</div>
</div>
<div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <h2 class="counter mb-3">Pago de Pensiones</h2>


            <div class="mt-3">
                @forelse($mesesporcentaje as $mespor)
                @if (count($estudiante) != 0)
                <div class="pb-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <p class="mb-0">{{ $mespor->mes }} <b></b> </p>
                        <h4>{{ number_format(($mespor->cantidad / count($estudiante)) * 100, 1) }}%
                        </h4>
                    </div>
                    <div class="progress bg-soft-danger shadow-none w-100" style="height: 10px">
                        <div class="progress-bar bg-danger" data-toggle="progress-bar"
                            role="progressbar"
                            aria-valuenow="{{ ($mespor->cantidad / count($estudiante)) * 100 }}"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                @endif

                @empty
                <span class="badge bg-danger">No hay Pensiones pagadas</span>
                @endforelse


            </div>
        </div>
    </div>
</div>

</div> --}}


        {{-- porcentaje de faltass --}}
        <div class="row">
            <div class="col-md-8">
                <div class="card">

                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Estado de Asistencia</h4>
                        </div>
                        <div class="dropdown">
                            <a href="{{ route('app.vistaasistencia') }}" class="text-gray" data-bs-toggle=""
                                aria-expanded="false" target="_blank">
                                <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.1614 12.0531C15.1614 13.7991 13.7454 15.2141 11.9994 15.2141C10.2534 15.2141 8.83838 13.7991 8.83838 12.0531C8.83838 10.3061 10.2534 8.89111 11.9994 8.89111C13.7454 8.89111 15.1614 10.3061 15.1614 12.0531Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.998 19.355C15.806 19.355 19.289 16.617 21.25 12.053C19.289 7.48898 15.806 4.75098 11.998 4.75098H12.002C8.194 4.75098 4.711 7.48898 2.75 12.053C4.711 16.617 8.194 19.355 12.002 19.355H11.998Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>

                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card card-block card-stretch card-height">
                            <nav class="tab-bottom-bordered">
                                <div class="mb-0 nav nav-tabs justify-content-around" id="nav-tab1" role="tablist">
                                    <button class="nav-link py-3 active" id="nav-home-11-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-home-11" type="button" role="tab"
                                        aria-controls="nav-home-11" aria-selected="true">Asistencia</button>
                                    <button class="nav-link py-3" id="nav-profile-11-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile-11" type="button" role="tab"
                                        aria-controls="nav-profile-11" aria-selected="false"
                                        tabindex="-1">Tarde</button>
                                    <button class="nav-link py-3" id="nav-contact-11-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact-11" type="button" role="tab"
                                        aria-controls="nav-contact-11" aria-selected="false"
                                        tabindex="-1">Falta</button>
                                </div>
                            </nav>
                            <div class="tab-content iq-tab-fade-up" id="nav-tabContent">

                                <div class="tab-pane fade show active" id="nav-home-11" role="tabpanel"
                                    aria-labelledby="nav-home-11-tab">
                                    <div class="table-responsive">
                                        <table id="user-list-table" class="table mb-0" role="grid">
                                            <thead>
                                                <tr>
                                                    {{-- <th>N°</th> --}}
                                                    <th>Nombre Completo</th>
                                                    <th>Aula</th>
                                                    <th>Total Registros</th>

                                                    <th>Porcentaje</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $numeracion = 1;

                                                @endphp
                                                @forelse($asistenciaPorcentaje as $repor)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                {{ $repor->apellidos }}, {{ $repor->nombre }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $repor->nivel }} {{ $repor->grado }} {{ $repor->seccion }}
                                                        </td>
                                                        <td class="text-dark">{{ $repor->total_asistencias }} </td>
                                                        <td>
                                                            <div class="progress" style="height: 10px;">
                                                                <div class="progress-bar {{ $repor->total_asistencias >= 3 ? 'bg-success' : 'bg-danger' }}"
                                                                    role="progressbar"
                                                                    style="width: {{ round($repor->porcentaje_asistencia) }}%">
                                                                </div>
                                                            </div>
                                                            <small>{{ round($repor->porcentaje_asistencia) }}%</small>
                                                        </td>


                                                    </tr>
                                                    @php
                                                        $numeracion++;

                                                    @endphp
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="nav-profile-11" role="tabpanel"
                                    aria-labelledby="nav-profile-11-tab">
                                    <div class="table-responsive">
                                        <table id="user-list-table" class="table mb-0" role="grid">

                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Nombre Completo</th>
                                                    <th>Aula</th>
                                                    <th>Tarde</th>
                                                    <th>Porcentaje</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $numeracion = 1;

                                                @endphp
                                                @forelse($reportetarde as $repor)
                                                    <tr>
                                                        <td>{{ $numeracion }}</td>
                                                        @php
                                                            // Suponiendo que $repor->total_faltas representa las tardanzas en esta vista
                                                            $numeros = explode('/', $repor->celular); // Divide por la barra '/'
                                                            $celularMama = isset($numeros[0])
                                                                ? trim($numeros[0])
                                                                : null;
                                                            $celularPapa = isset($numeros[1])
                                                                ? trim($numeros[1])
                                                                : null;

                                                            // Elegimos el primer número disponible para el botón principal
                                                            $celularDestino = $celularMama || $celularPapa;

                                                            $mensaje =
                                                                'Estimado padre de familia del colegio Bertol Brecht, le informamos que su menor hijo(a) ' .
                                                                $repor->nombre .
                                                                ' ' .
                                                                $repor->apellidos .
                                                                ' registra ' .
                                                                $repor->total_tardanzas .
                                                                ' tardanza(s) a la fecha. Por favor, tomar las medidas necesarias.';
                                                            $urlWhatsapp =
                                                                'https://wa.me/51' .
                                                                $celularDestino .
                                                                '?text=' .
                                                                urlencode($mensaje);
                                                        @endphp


                                                        <td>
                                                            {{ $repor->apellidos }} {{ $repor->nombre }}</p>
                                                        </td>
                                                        <td>
                                                            <p style="">{{ $repor->nivel }} {{ $repor->grado }}
                                                                {{ $repor->seccion }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $repor->total_tardanzas }} / {{ $repor->total_dias }}
                                                            </p>
                                                        </td>


                                                        <td>
                                                            <div class="progress" style="height: 10px;">
                                                                <div class="progress-bar  {{ $repor->porcentaje_tardanza <= 10
                                                                    ? 'bg-success'
                                                                    : ($repor->porcentaje_tardanza <= 25
                                                                        ? 'bg-warning'
                                                                        : 'bg-danger') }}"
                                                                    role="progressbar"
                                                                    style="width: {{ round($repor->porcentaje_tardanza) }}%">
                                                                </div>
                                                            </div>
                                                            <small>{{ round($repor->porcentaje_tardanza) }}%</small>
                                                        </td>

                                                        <td class="text-center">
                                                            @if ($repor->total_tardanzas >= 3 && $celularDestino)
                                                                <div class="btn-group" role="group">
                                                                    {{-- Botón Principal (Mamá) --}}
                                                                    <a href="https://wa.me/51{{ $celularMama }}?text={{ urlencode($mensaje) }}"
                                                                        target="_blank" class="btn btn-success btn-sm"
                                                                        title="Notificar a Mamá">
                                                                        <i class="fab fa-whatsapp"></i> M
                                                                    </a>

                                                                    {{-- Botón Secundario (Si existe Papá) --}}
                                                                    @if ($celularPapa)
                                                                        <a href="https://wa.me/51{{ $celularPapa }}?text={{ urlencode($mensaje) }}"
                                                                            target="_blank" class="btn btn-info btn-sm"
                                                                            title="Notificar a Papá">
                                                                            <i class="fab fa-whatsapp"></i> P
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <span class="text-muted"><small>Sin acción</small></span>
                                                            @endif
                                                        </td>

                                                    </tr>

                                                    @php
                                                        $numeracion++;

                                                    @endphp
                                                @empty
                                                @endforelse

                                            </tbody>

                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-contact-11" role="tabpanel"
                                    aria-labelledby="nav-contact-11-tab">
                                    <div class="table-responsive">
                                        <table id="user-list-table" class="table mb-0" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Nombre Completo</th>
                                                    <th>Aula</th>
                                                    <th>Falta</th>
                                                    <th>Porcentaje</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $numeracion = 1; @endphp
                                                @forelse($reporte as $repor)
                                                    @php
                                                        // Suponiendo que $repor->total_faltas representa las tardanzas en esta vista
                                                        $faltas = $repor->total_faltas;

                                                        $numeros = explode('/', $repor->celular); // Divide por la barra '/'
                                                        $celularMama = isset($numeros[0]) ? trim($numeros[0]) : null;
                                                        $celularPapa = isset($numeros[1]) ? trim($numeros[1]) : null;

                                                        // Elegimos el primer número disponible para el botón principal
                                                        $celularDestino = $celularMama || $celularPapa;

                                                        $mensaje =
                                                            'Estimado padre del colegio Bertol Brecht, le informamos que su menor hijo(a) ' .
                                                            $repor->nombre .
                                                            ' ' .
                                                            $repor->apellidos .
                                                            ' registra ' .
                                                            $faltas .
                                                            ' falta(s) a la fecha. Por favor, tomar las medidas necesarias.';
                                                        $urlWhatsapp =
                                                            'https://wa.me/51' .
                                                            $celularDestino .
                                                            '?text=' .
                                                            urlencode($mensaje);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $numeracion }}</td>
                                                        <td>
                                                            {{ $repor->apellidos }} {{ $repor->nombre }}
                                                        </td>
                                                        <td>
                                                            {{ $repor->nivel }} {{ $repor->grado }} {{ $repor->seccion }}
                                                        </td>
                                                        <td>
                                                            {{-- UX: Resaltar en rojo si llega a 3 o más --}}
                                                            <span
                                                                class="badge {{ $faltas >= 3 ? 'bg-danger' : 'bg-warning' }}">
                                                                {{ $faltas }} / {{ $repor->total_dias }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <div class="progress" style="height: 10px;">
                                                                <div class="progress-bar 
                                                                {{ $repor->porcentaje_faltas <= 10
                                                                    ? 'bg-success'
                                                                    : ($repor->porcentaje_faltas <= 25
                                                                        ? 'bg-warning'
                                                                        : 'bg-danger') }}"
                                                                    role="progressbar"
                                                                    style="width: {{ round($repor->porcentaje_faltas) }}%">
                                                                </div>
                                                            </div>
                                                            <small>{{ round($repor->porcentaje_faltas) }}%</small>
                                                        </td>


                                                        <td class="text-center">
                                                            @if ($repor->total_faltas >= 1 && $celularDestino)
                                                                <div class="btn-group" role="group">
                                                                    {{-- Botón Principal (Mamá) --}}
                                                                    <a href="https://wa.me/51{{ $celularMama }}?text={{ urlencode($mensaje) }}"
                                                                        target="_blank" class="btn btn-success btn-sm"
                                                                        title="Notificar a Mamá">
                                                                        <i class="fab fa-whatsapp"></i> M
                                                                    </a>

                                                                    {{-- Botón Secundario (Si existe Papá) --}}
                                                                    @if ($celularPapa)
                                                                        <a href="https://wa.me/51{{ $celularPapa }}?text={{ urlencode($mensaje) }}"
                                                                            target="_blank" class="btn btn-info btn-sm"
                                                                            title="Notificar a Papá">
                                                                            <i class="fab fa-whatsapp"></i> P
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                <span class="text-muted"><small>Sin acción</small></span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @php $numeracion++; @endphp
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">No hay registros</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a href="{{ route('app.asist-estudiante.index') }}">
                                    <span class="me-2">
                                        Ver todos
                                    </span>
                                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                     <h2 class="counter p-3">Asistencia de Hoy</h2>
                    <div class="card-body d-flex flex-column justify-content-center offset-md-1">
                       
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="modulo" class="form-label">Nivel:</label>
                                <div class="input-group">
                                    <select name="nivel" id="nivelSelect" class="form-control">
                                        <option value="Inicial">Inicial</option>
                                        <option value="Primaria">Primaria</option>
                                        <option value="Secundaria">Secundaria</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <canvas id="graficoNivel"></canvas>
                            </div>


                        </div>
                    </div>





                </div>
            </div>
        </div>

        <!-- <div class="row">

            <div class="card">

                <h2 class="counter mb-3">Ranking de Asistencia</h2>
                <div class="card-body">

                    <select id="nivelAula" class="form-control mb-3">
                        <option value="inicial">Inicial</option>
                        <option value="Primaria">Primaria</option>
                        <option value="Secundaria">Secundaria</option>
                    </select>

                    <canvas id="graficoAula"></canvas>
                </div>

            </div>

        </div> -->

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
        const ctx = document.getElementById('graficoNivel');
        const selectNivel = document.getElementById('nivelSelect');

        let grafico;

        function cargarGrafico(nivel) {

            fetch("{{ route('app.asistencia.nivel') }}?nivel=" + nivel)
                .then(response => response.json())
                .then(data => {

                    const datos = [
                        data.puntual,
                        data.tarde,
                        data.falta
                    ];

                    if (grafico) {
                        grafico.destroy();
                    }

                    grafico = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['Asistío', 'Tarde', 'Falta'],
                            datasets: [{
                                data: datos,
                                backgroundColor: [
                                    '#28a745',
                                    '#ffc107',
                                    '#dc3545'
                                ],
                                borderWidth: 2,
                                borderColor: '#ffffff'
                            }]
                        },
                        options: {
                            responsive: true,
                            animation: {
                                duration: 700
                            },
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                datalabels: {
                                    color: '#ffffff',
                                    font: {
                                        weight: 'bold',
                                        size: 16
                                    },
                                    formatter: (value, context) => {
                                        const total = context.chart.data.datasets[0].data
                                            .reduce((a, b) => a + b, 0);

                                        if (total === 0) return "0%";

                                        return ((value / total) * 100).toFixed(1) + "%";
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });

                });
        }

        // Cargar inicial
        cargarGrafico(selectNivel.value);

        // Cambiar nivel sin recargar
        selectNivel.addEventListener('change', function() {
            cargarGrafico(this.value);
        });


        const ctxAula = document.getElementById('graficoAula');
        const selectAula = document.getElementById('nivelAula');

        let graficoAula;

        function cargarGraficoAula(nivel) {


            fetch("{{ route('app.asistencia.aula') }}?nivel=" + nivel)
                .then(res => res.json())
                .then(data => {

                    const labels = data.map(item =>
                        item.grado + " - " + item.seccion
                    );

                    const puntual = data.map(item => item.puntual);
                    const tarde = data.map(item => item.tarde);
                    const falta = data.map(item => item.falta);

                    if (graficoAula) graficoAula.destroy();

                    graficoAula = new Chart(ctxAula, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                    label: 'Puntual',
                                    data: puntual,
                                    backgroundColor: '#28a745'
                                },
                                {
                                    label: 'Tarde',
                                    data: tarde,
                                    backgroundColor: '#000000'
                                },
                                {
                                    label: 'Falta',
                                    data: falta,
                                    backgroundColor: '#dc3545'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: '# Estudiantes'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Aulas'
                                    }
                                }
                            }
                        }
                    });

                });
        }

        cargarGraficoAula(selectAula.value);

        selectAula.addEventListener('change', function() {
            cargarGraficoAula(this.value);
        });
    </script>
@endsection
