@extends('layouts.dashboard')

@section('tab_tittle', 'Dashboard')

@section('content')
<div class="row row-cols-1">
    <div class="overflow-hidden d-slider1">
        <ul class="swiper-wrapper list-inline m-0 p-0 mb-2">

            <li class="swiper-slide">
                <div class="card border-bottom border-5 border-0 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="bg-soft-success rounded p-3">
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
                <div class="card border-bottom border-5 border-0 border-primary">
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

        </div>
        {{-- porcentaje de faltass --}}
        <div class="row">
            <div class="col-md-6">
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
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="mb-0">$1,833</h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-primary">
                                                        hui_vxnnjigakm
                                                    </td>
                                                    <td class="text-dark">1 Hour Ago</td>
                                                    <td class="text-end">
                                                        <span class="badge rounded-pill bg-success ">Processed</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-profile-11" role="tabpanel"
                                    aria-labelledby="nav-profile-11-tab">
                                    <div class="table-responsive">
                                        <table id="transaction-table-2" class="table mb-0 table-striped" role="grid">

                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Nombre Completo</th>
                                                    <th>Aula</th>
                                                    <th>T / T</th>
                                                    <th>Porcentaje</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $numeracion = 1;

                                                @endphp
                                                @forelse($reportetarde as $repor)
                                                    <tr>
                                                        <td>{{ $numeracion }}</td>
                                                        <td>
                                                            <p>{{ $repor->apellidos }}, {{ $repor->nombre }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $repor->nivel }} {{ $repor->grado }}
                                                                {{ $repor->seccion }}</p>
                                                        </td>

                                                        <td>
                                                            <p>{{ $repor->total_tardanzas }} / {{ $repor->total_dias }}
                                                            </p>
                                                        </td>

                                                        <td>
                                                            <p>{{ round($repor->porcentaje_tardanza) }}%</p>
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
                                        <table id="transaction-table-2" class="table mb-0 table-striped" role="grid">

                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Nombre Completo</th>
                                                    <th>Aula</th>
                                                    <th>F / T</th>
                                                    <th>Porcentaje</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $numeracion = 1;

                                                @endphp
                                                @forelse($reporte as $repor)
                                                    <tr>
                                                        <td>{{ $numeracion }}</td>
                                                        <td>
                                                            <p>{{ $repor->apellidos }}, {{ $repor->nombre }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $repor->nivel }} {{ $repor->grado }}
                                                                {{ $repor->seccion }}</p>
                                                        </td>

                                                        <td>
                                                            <p>{{ $repor->total_faltas }} / {{ $repor->total_dias }}</p>
                                                        </td>

                                                        <td>
                                                            <p>{{ round($repor->porcentaje_faltas) }}%</p>
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
                                    @if (count($pagospensiones) != 0)
                                    s/ {{ $pagospensiones[0]->monto }}
                                    @else
                                    0
                                    @endif
                                </h3>
                                <p class="mb-0">Total de Pensiones</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h2 class="counter mb-3">Asistensia Hoy</h2>
                    <div class="form-group px-3">
                        <label for="modulo" class="form-label">Nivel:</label>
                        <div class="input-group ">

                          <select name="nivel" class="form-control" required>
                           
                            
                              <option value="inicial" selected> Inicial </option>
                            <option value="Primaria" > Primaria </option>
                            <option value="Secundaria" > Secundaria </option>
                            



                           </select>


                        </div>
                    </div>

                    
                    

                    <canvas id="graficoNivel"></canvas>
                </div>
            </div>
        </div>
            </li>

            <li class="swiper-slide">
                <div class="card border-bottom border-5 border-0 border-info">
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
                                    @if ($pagosventas[0]->montototal != null)
                                    s/{{ $pagosventas[0]->montototal }}
                                    @else
                                    0
                                    @endif
                                </h3>
                                <p class="mb-0">Venta Total</p>
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
                                    @if ($pagosingresos[0]->montototal != null)
                                    s/{{ $pagosingresos[0]->montototal }}
                                    @else
                                    s/. 0.00
                                    @endif
                                </h3>
                                <p class="mb-0">Costo Total</p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="swiper-slide">
                <div class="card border-bottom border-5 border-0 border-primary">
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
                                    @forelse($pagosventasmes as $pm)
                                    @if ($pm->montototal != null)
                                    s/{{ $pm->montototal }}
                                    @else
                                    s/ 0.00
                                    @endif
                                    @empty
                                    @endforelse
                                </h3>
                                <p class="mb-0">Pagos de {{ $date->monthName }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="swiper-slide">
                <div class="card border-bottom border-5 border-0 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="bg-soft-info rounded p-3">
                                <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M16.334 2.75H7.665C4.645 2.75 2.75 4.889 2.75 7.916V16.084C2.75 19.111 4.635 21.25 7.665 21.25H16.334C19.364 21.25 21.25 19.111 21.25 16.084V7.916C21.25 4.889 19.364 2.75 16.334 2.75Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12 7.91394L12 16.0859" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.25205 11.6777L12 7.91373L15.748 11.6777" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="counter">
                                    @forelse($pagosingresosmes as $pm)
                                    @if ($pm->montototal != null)
                                    s/{{ $pm->montototal }}
                                    @else
                                    s/ 0.00
                                    @endif
                                    @empty
                                    @endforelse
                                </h3>
                                <p class="mb-0">Ingresos de {{ $date->monthName }}</p>
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
                                <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                    viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.59151 15.2068C13.2805 15.2068 16.4335 15.7658 16.4335 17.9988C16.4335 20.2318 13.3015 20.8068 9.59151 20.8068C5.90151 20.8068 2.74951 20.2528 2.74951 18.0188C2.74951 15.7848 5.88051 15.2068 9.59151 15.2068Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.59157 12.0198C7.16957 12.0198 5.20557 10.0568 5.20557 7.63476C5.20557 5.21276 7.16957 3.24976 9.59157 3.24976C12.0126 3.24976 13.9766 5.21276 13.9766 7.63476C13.9856 10.0478 12.0356 12.0108 9.62257 12.0198H9.59157Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M16.4829 10.8815C18.0839 10.6565 19.3169 9.28253 19.3199 7.61953C19.3199 5.98053 18.1249 4.62053 16.5579 4.36353"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M18.5952 14.7322C20.1462 14.9632 21.2292 15.5072 21.2292 16.6272C21.2292 17.3982 20.7192 17.8982 19.8952 18.2112"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="counter">{{ count($usuarios) - 1 }}</h3>
                                <p class="mb-0">Usuarios</p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>


        </ul>

        <div class="swiper-button swiper-button-next"></div>
        <div class="swiper-button swiper-button-prev"></div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
        const ctx = document.getElementById('graficoNivel');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Puntual', 'Tarde', 'Falta'],
                datasets: [{
                    data: [
                        {{ (int) $datos->puntual }},
                        {{ (int) $datos->tarde }},
                        {{ (int) $datos->falta }}
                    ],
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
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    datalabels: {
                        color: '#ffffff',
                        font: {
                            weight: 'bold',
                            size: 16
                        },
                        formatter: (value, context) => {
                            let total = context.chart.data.datasets[0].data
                                .reduce((a, b) => a + b, 0);
                            let percentage = (value / total * 100).toFixed(1) + "%";
                            return percentage;
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
@endsection

    <div class="row">
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

    </div>
    {{-- porcentaje de faltass --}}
    <div class="row">
        <div class="col-md-6">
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
                                        <tbody>
                                            @php
                                            $numeracion = 1;

                                            @endphp
                                            @forelse($reportetarde as $repor)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="mb-0">{{ $repor->apellidos }}, {{ $repor->nombre }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-primary">
                                                    {{ $repor->nivel }} {{ $repor->grado }} {{ $repor->seccion }}
                                                </td>
                                                <td class="text-dark">{{ $repor->total_tardanzas }} / {{ $repor->total_dias }}</td>
                                                <td>
                                                    <div class="mb-2 d-flex align-items-center">
                                                        <h6>{{ round($repor->porcentaje_tardanza) }}%</h6>
                                                    </div>
                                                    <div class="shadow-none progress bg-primary-subtle w-100" style="height: 4px">
                                                        <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="{{$repor->porcentaje_tardanza}}" aria-valuemin="0" aria-valuemax="100" style="width: 60%; transition: width 2s;">
                                                        </div>
                                                    </div>
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
                                    <table id="transaction-table-2" class="table mb-0 table-striped" role="grid">

                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Nombre Completo</th>
                                                <th>Aula</th>
                                                <th>T / T</th>
                                                <th>Porcentaje</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $numeracion = 1;

                                            @endphp
                                            @forelse($reportetarde as $repor)
                                            <tr>
                                                <td>{{ $numeracion }}</td>
                                                <td>
                                                    <p>{{ $repor->apellidos }}, {{ $repor->nombre }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $repor->nivel }} {{ $repor->grado }} {{ $repor->seccion }}</p>
                                                </td>

                                                <td>
                                                    <p>{{ $repor->total_tardanzas }} / {{ $repor->total_dias }}</p>
                                                </td>

                                                <td>
                                                    <div class="mb-2 d-flex align-items-center">
                                                        <h6>{{ round($repor->porcentaje_tardanza) }}%</h6>
                                                    </div>
                                                    <div class="shadow-none progress bg-primary-subtle w-100" style="height: 4px">
                                                        <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="{{$repor->porcentaje_tardanza}}" aria-valuemin="0" aria-valuemax="100" style="width: 60%; transition: width 2s;">
                                                        </div>
                                                    </div>
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
                                    <table id="transaction-table-2" class="table mb-0 table-striped" role="grid">

                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Nombre Completo</th>
                                                <th>Aula</th>
                                                <th>F / T</th>
                                                <th>Porcentaje</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $numeracion = 1;

                                            @endphp
                                            @forelse($reporte as $repor)
                                            <tr>
                                                <td>{{ $numeracion }}</td>
                                                <td>
                                                    <p>{{ $repor->apellidos }}, {{ $repor->nombre }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $repor->nivel }} {{ $repor->grado }} {{ $repor->seccion }}</p>
                                                </td>

                                                <td>
                                                    <p>{{ $repor->total_faltas }} / {{ $repor->total_dias }}</p>
                                                </td>

                                                <td>
                                                    <div class="mb-2 d-flex align-items-center">
                                                        <h6>{{ round($repor->porcentaje_faltas) }}%</h6>
                                                    </div>
                                                    <div class="shadow-none progress bg-primary-subtle w-100" style="height: 4px">
                                                        <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="{{ $repor->porcentaje_faltas }}" aria-valuemin="0" aria-valuemax="100" style="width: 60%; transition: width 2s;">
                                                        </div>
                                                    </div>
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
    </div>


</div>
@endsection
