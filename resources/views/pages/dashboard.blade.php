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
                    <div class="card border-bottom border-5 border-0 border-success">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="bg-soft-primary rounded p-3">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.37121 10.2017V17.0618" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.0382 6.91919V17.0619" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M16.6285 13.8269V17.0619" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="counter">
                                       
                                            {{ $puntualHoy+$tardeHoy+$faltaHoy}}
                                       
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
                                <div class="bg-soft-primary rounded p-3">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.37121 10.2017V17.0618" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12.0382 6.91919V17.0619" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M16.6285 13.8269V17.0619" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="counter">
                                        @if ($puntualHoy != 0)
                                            s/ {{ $puntualHoy }}
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
                                <div class="bg-soft-info rounded p-3">
                                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M2.75 3.25L4.83 3.61L5.793 15.083C5.87 16.02 6.653 16.739 7.593 16.736H18.502C19.399 16.738 20.16 16.078 20.287 15.19L21.236 8.632C21.342 7.899 20.833 7.219 20.101 7.113C20.037 7.104 5.164 7.099 5.164 7.099"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M14.125 10.7949H16.898" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.15435 20.2026C7.45535 20.2026 7.69835 20.4466 7.69835 20.7466C7.69835 21.0476 7.45535 21.2916 7.15435 21.2916C6.85335 21.2916 6.61035 21.0476 6.61035 20.7466C6.61035 20.4466 6.85335 20.2026 7.15435 20.2026Z"
                                            fill="currentColor" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M18.4346 20.2026C18.7356 20.2026 18.9796 20.4466 18.9796 20.7466C18.9796 21.0476 18.7356 21.2916 18.4346 21.2916C18.1336 21.2916 17.8906 21.0476 17.8906 20.7466C17.8906 20.4466 18.1336 20.2026 18.4346 20.2026Z"
                                            fill="currentColor" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="counter">
                                        <h3 class="counter">
                                        @if ($tardeHoy != 0)
                                            s/ {{ $tardeHoy }}
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
                                <div class="bg-soft-warning rounded p-3">
                                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                        viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.666 21.25H16.335C19.355 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.365 2.75 16.335 2.75H7.666C4.636 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.636 21.25 7.666 21.25Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M12 16.0861V7.91406" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.748 12.3223L12 16.0863L8.25195 12.3223" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="counter">
                                     <h3 class="counter">
                                        @if ($faltaHoy!= 0)
                                            s/ {{ $faltaHoy }}
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
            <div class="col-md-9">
                <div class="card">


                    <div class="card-body">
                        <h2 class="counter mb-3">Ranking de Asistencia</h2>
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
                                        <table id="transaction-table" class="table mb-0 table-striped" role="grid">
                                            <thead>
                                                <tr>
                                                    {{-- <th>N°</th> --}}
                                                    <th>Nombre Completo</th>
                                                    <th>Aula</th>
                                                    <th>total registro</th>

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
                                                                {{ $repor->apellidos }},<br>
                                                                {{ $repor->nombre }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ $repor->nivel }} <br>{{ $repor->grado }}<br> {{ $repor->seccion }}
                                                        </td>
                                                        <td class="text-dark">{{ $repor->total_asistencias }} </td>
                                                        <td>
                                                            <div class="progress" style="height: 10px;">
                                                                <div class="progress-bar {{ $repor->total_asistencias >= 3 ? 'bg-info' : 'bg-danger' }}"
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
                                        <table id="transaction-table-2" class="table mb-0" role="grid">

                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Nombre Completo</th>
                                                    <th>Aula</th>
                                                    <th>tardanzas</th>
                                                    {{-- <th>Tarde</th> --}}

                                                    <th>porcentaje</th>
                                                    <th>whatsapp</th>
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
                                                            $celularDestino = $celularMama ?? $celularPapa;

                                                            $mensaje =
                                                                'Estimado padre de familia de la I.E.P. Mundo Feliz, le informamos que su menor hijo(a) ' .
                                                                $repor->nombre .
                                                                ' ' .
                                                                $repor->apellidos .
                                                                ' registra ' .
                                                                $repor->total_tardanzas .
                                                                ' tardanzas a la fecha. Por favor, tomar las medidas necesarias.';
                                                            $urlWhatsapp =
                                                                'https://wa.me/51' .
                                                                $celularDestino .
                                                                '?text=' .
                                                                urlencode($mensaje);
                                                        @endphp


                                                        <td>
                                                            {{ $repor->apellidos }}  <br>  {{ $repor->nombre }}</p>
                                                        </td>
                                                        <td>
                                                            <p style="">{{ $repor->nivel }} <br>{{ $repor->grado }}<br>
                                                                {{ $repor->seccion }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $repor->total_tardanzas }} / {{ $repor->total_dias }}
                                                            </p>
                                                        </td>


                                                        <td>
                                                            <div class="progress" style="height: 10px;">
                                                                <div class="progress-bar {{ $repor->total_tardanzas >= 3 ? 'bg-info' : 'bg-danger' }}"
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
                                        <table id="transaction-table-2" class="table mb-0" role="grid">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Nombre Completo</th>
                                                    <th>Aula</th>
                                                    <th>Cantidad (Tardanzas)</th>

                                                    <th>Porcentaje</th>
                                                    <th>Acción WhatsApp</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $numeracion = 1; @endphp
                                                @forelse($reporte as $repor)
                                                    @php
                                                        // Suponiendo que $repor->total_faltas representa las tardanzas en esta vista
                                                        $tardanzas = $repor->total_faltas;

                                                        $numeros = explode('/', $repor->celular); // Divide por la barra '/'
                                                        $celularMama = isset($numeros[0]) ? trim($numeros[0]) : null;
                                                        $celularPapa = isset($numeros[1]) ? trim($numeros[1]) : null;

                                                        // Elegimos el primer número disponible para el botón principal
                                                        $celularDestino = $celularMama ?? $celularPapa;

                                                        $mensaje =
                                                            'Estimado padre de familia de la I.E.P. Mundo Feliz, le informamos que su menor hijo(a) ' .
                                                            $repor->nombre .
                                                            ' ' .
                                                            $repor->apellidos .
                                                            ' registra ' .
                                                            $tardanzas .
                                                            ' tardanzas a la fecha. Por favor, tomar las medidas necesarias.';
                                                        $urlWhatsapp =
                                                            'https://wa.me/51' .
                                                            $celularDestino .
                                                            '?text=' .
                                                            urlencode($mensaje);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $numeracion }}</td>
                                                        <td>
                                                            {{ $repor->apellidos }} <br> {{ $repor->nombre }}
                                                        </td>
                                                        <td>
                                                            {{ $repor->nivel }} <br> {{ $repor->grado }} <br>  {{ $repor->seccion }}
                                                        </td>
                                                        <td>
                                                            {{-- UX: Resaltar en rojo si llega a 3 o más --}}
                                                            <span
                                                                class="badge {{ $tardanzas >= 3 ? 'bg-danger' : 'bg-warning' }}">
                                                                {{ $tardanzas }} / {{ $repor->total_dias }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <div class="progress" style="height: 10px;">
                                                                <div class="progress-bar {{ $tardanzas >= 3 ? 'bg-danger' : 'bg-info' }}"
                                                                    role="progressbar"
                                                                    style="width: {{ round($repor->porcentaje_faltas) }}%">
                                                                </div>
                                                            </div>
                                                            <small>{{ round($repor->porcentaje_faltas) }}%</small>
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($repor->total_faltas >= 0 && $celularDestino)
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
                                <a href="javascript:void(0);">
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
            <div class="col-md-3">
                <div class="card">
                    <h2 class="counter mb-3">Asistencia Hoy</h2>
                    <div class="form-group px-3">
                        <label for="modulo" class="form-label">Nivel:</label>
                        <div class="input-group ">
                            <select name="nivel" id="nivelSelect" class="form-control">
                                <option value="Inicial">Inicial</option>
                                <option value="Primaria">Primaria</option>
                                <option value="Secundaria">Secundaria</option>
                            </select>



                        </div>
                    </div>

                    <canvas id="graficoNivel"></canvas>


                </div>
            </div>
        </div>

        <div class="row">
         
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
            
        </div>

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
                            labels: ['Puntual', 'Tarde', 'Falta'],
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
                        datasets: [
                            {
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

    selectAula.addEventListener('change', function () {
        cargarGraficoAula(this.value);
    });
    </script>
@endsection
