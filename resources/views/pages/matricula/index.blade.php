@extends('layouts.master')

@section('tab_tittle', 'Lista de conceptos de pago')

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
        <h4 class="card-title mb-0">Lista de Matrículas</h4>
    </div>

    <!-- modal para crear nuevos conceptos de pagooo -->
    <div class="">

        <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop-1">
            <i class="btn-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </i>
            <span>Nueva Matrícula</span>
        </a>



        <a class="btn btn-danger btn-round ml-auto" type="button" href="" data-bs-toggle="modal"
            data-bs-target="#reporteasistencia">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z">
                </path>
            </svg>
        </a>
        <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Registrar Matrículas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('app.matriculas.store') }}" method="POST">
                            @method('POST')
                            @csrf

                            <div class="form-group">
                                <label for="modulo" class="form-label">Estudiante:</label>
                                <div class="input-group ">

                                    <select name="estudiante_id[]" class="form-control select2" required
                                        id="ex-estudiante" multiple data-placeholder="Seleccionar...">

                                        @forelse($estudiante as $est)
                                        <option value="{{ $est->id }}"> {{ $est->apellidos }}
                                            {{ $est->nombre }}- {{ $est->dni }}
                                        </option>
                                        @empty
                                        @endforelse

                                    </select>

                                </div>
                            </div>

                            <div class="raw d-flex">
                                <div class="form-group col-md-6 p-1">
                                    <label for="modulo" class="form-label">Aula:</label>
                                    <div class="input-group ">
                                        <span class="input-group-text" id="">
                                            <svg width="18" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                </circle>
                                                <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </span>
                                        <select name="aula_id" type="search" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                            @forelse($aula as $esp)
                                            <option value="{{ $esp->id }}">{{ $esp->nivel }} {{ $esp->grado }}
                                                {{ $esp->seccion }}
                                            </option>
                                            @empty
                                            @endforelse

                                        </select>

                                    </div>
                                </div>
                                <div class="form-group col-md-6 p-1">
                                    <label for="dni" class="form-label">Código:</label>
                                    <span class="badge bg-alumko">Alumko</span>
                                    <input type="text" class="form-control" id="dni" aria-describedby="dni"
                                        placeholder="87654321" name="codigo" value="{{ old('codigo') }}">
                                </div>

                            </div>
                            {{-- <div class="form-group">
                                    <label for="modulo" class="form-label">Concepto:</label>
                                    <div class="input-group ">

                                        <select name="concepto" class="form-control" required>
                                            <option value="">Seleccionar</option>
                                            @forelse($concepto as $con)
                                                <option value="{{ $con->id }}"> {{ $con->concepto }} </option>
                            @empty
                            @endforelse

                            </select>

                    </div>
                </div> --}}



            <div class="text-start mt-2">
                <button class="btn btn-secondary" type="submit">Guardar</button>
                <button type="button" class="btn btn-danger"
                    data-bs-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>

@include('pages.matricula.pdfasistencia')
@include('pages.matricula.search')
<form action="matriculas" method="GET" autocomplete="off">
        @method('GET')
        @csrf
        <div class="row p-2">
          

            <div class="input-group ms-3" style="width: auto;">
                <label for="fecha" class="form-label me-2" style="margin-top: 0.7rem !important;">Fecha:</label>
               
       <input type="date" class="form-control" name="fecha"
                            value="{{ $searchTextFecha == '' ? date('Y-m-d') : $searchTextFecha }}">


                <button class="input-group-text btn-info">
                    <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>


<div class="card-body p-0">
    <div class="table-responsive">
        <table id="user-list-table" class="table table-striped" role="grid" data-toggle="grid">
            <thead>
                <tr>
                    <th>N°</th>

                    <th>Estudiante</th>
                    <th>Aula</th>
                    <th>DNI</th>
                    <th>Estado</th>
                    <!--                <th>Código Alumko</th> -->
                    <th>CÓDIGO</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matricula as $matri)
                <tr>
                    <td>
                        <h6>{{ $matri->id }}</h6>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            {{ $matri->estudiante->apellidos }}, {{ $matri->estudiante->nombre }}
                            @if ($matri->estado == 1)
                            <span class="badge bg-danger"> trasladad@</span>
                            @endif

                        </div>
                    </td>

                    <td>
                        <div class="d-flex align-items-center">
                            {{ $matri->aula->nivel }} {{ $matri->aula->grado }} {{ $matri->aula->seccion }}

                        </div>
                    </td>

                    <td>
                        <div class="d-flex align-items-center">
                            {{ $matri->estudiante->dni }}
                        </div>
                    </td>

                    <td>
                        <span class="badge {{$matri->estado == 1 ? 'bg-info' : 'bg-secondary'}}">
                            {{$matri->estado == 1 ? 'Trasladado' : 'Matrículado'}}
                        </span>
                    </td>



                    <td>
                        <h6 class="badge bg-alumko" style="font-size: 1em;">{{ $matri->codigo }}</h6>
                    </td>


                    <td>
                        <div class="flex align-items-center list-user-action">

                            <a class="btn btn-sm btn-icon text-success" data-bs-original-title="Ver"
                                href="{{ route('app.matriculas.show', $matri->id) }}">
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

                            <a class="btn btn-sm btn-icon text-warning" data-bs-toggle="modal"
                                data-bs-original-title="Editar" data-bs-target="#model-edit-{{ $matri->id }}">
                                <span class="btn-inner">
                                    <svg width="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        </path>
                                    </svg>
                                </span>
                            </a>

                            <a class="btn btn-sm btn-icon text-danger" data-bs-toggle="modal"
                                data-bs-original-title="Eliminar"
                                data-bs-target="#model-delete-{{ $matri->id }}">
                                <span class="btn-inner">
                                    <svg width="20" viewBox="0 0 24 24" fill="none"
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

                @include('pages.matricula.delete')
                @include('pages.matricula.edit')



                @empty
                @endforelse

            </tbody>
        </table>
    </div>
    {{ $matricula->render() }}
</div>
@endsection