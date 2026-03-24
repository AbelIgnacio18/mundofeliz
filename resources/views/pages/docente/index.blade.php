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
            <h4 class="card-title mb-0">Lista de Docente</h4>
        </div>

        <!-- modal para crear nuevos conceptos de pagooo -->
        <div class="">

            <a href="#" class=" text-center btn btn-primary btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    class="bi bi-person-plus" viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
                </svg>
                <span>Nuevo Docente</span>
            </a>



            <!-- <a href="#" class=" text-center btn btn-success btn-icon mt-lg-0 mt-md-0 mt-3" data-bs-toggle="modal" data-bs-target="#model-import">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-filetype-xlsx" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M14 4.5V11h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM7.86 14.841a1.13 1.13 0 0 0 .401.823q.195.162.479.252.284.091.665.091.507 0 .858-.158.355-.158.54-.44a1.17 1.17 0 0 0 .187-.656q0-.336-.135-.56a1 1 0 0 0-.375-.357 2 2 0 0 0-.565-.21l-.621-.144a1 1 0 0 1-.405-.176.37.37 0 0 1-.143-.299q0-.234.184-.384.188-.152.513-.152.214 0 .37.068a.6.6 0 0 1 .245.181.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.199-.566 1.2 1.2 0 0 0-.5-.41 1.8 1.8 0 0 0-.78-.152q-.44 0-.777.15-.336.149-.527.421-.19.273-.19.639 0 .302.123.524t.351.367q.229.143.54.213l.618.144q.31.073.462.193a.39.39 0 0 1 .153.326.5.5 0 0 1-.085.29.56.56 0 0 1-.255.193q-.168.07-.413.07-.176 0-.32-.04a.8.8 0 0 1-.249-.115.58.58 0 0 1-.255-.384zm-3.726-2.909h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415H1.5l1.24-2.016-1.228-1.983h.931l.832 1.438h.036zm1.923 3.325h1.697v.674H5.266v-3.999h.791zm7.636-3.325h.893l-1.274 2.007 1.254 1.992h-.908l-.85-1.415h-.035l-.853 1.415h-.861l1.24-2.016-1.228-1.983h.931l.832 1.438h.036z" />
             </svg>
             <span>Imports</span>
          </a> -->




            @include('pages.estudiante.import')

            <div class="modal fade" id="staticBackdrop-1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Nuevo Docente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body raw">
                            <form action="{{ route('app.docentes.store') }}" method="POST">
                                @method('POST')
                                @csrf


                                 <div class="form-group ">
                                        <label for="dni" class="form-label">DNI:</label>
                                        <input type="text" class="form-control"  aria-describedby="dni"
                                            placeholder="87654321" name="dni" id="dni_docente" value="{{ old('dni') }}">
                                    </div>

{{-- idtab @include('name') --}}
                                <div class="form-group">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" aria-describedby="nombre"
                                        placeholder="Carlos Antonio" name="nombre" value="{{ old('nombre') }}">
                                </div>

                                <div class="form-group">
                                    <label for="apellidop" class="form-label">Apellidos:</label>
                                    <input type="text" class="form-control" id="apellidop" aria-describedby="apellidop"
                                        placeholder="Silva" name="apellidop" value="{{ old('apellidop') }}">
                                </div>

                               
                                <div class="raw d-flex">
                                   
                                    <div class="form-group col-md-6 p-1">
                                        <label for="celular" class="form-label">Celular: <span
                                                class="badge bg-primary">Opcional</span></label>
                                        <input type="text" class="form-control" id="celular"
                                            aria-describedby="celular" placeholder="987654321" name="celular"
                                            value="{{ old('celular') }}">
                                    </div>
                                </div>

                              

                                <div class="form-group">
                                    <label for="Codigo" class="form-label">Codigo Alumko: <span
                                            class="badge bg-secondary">InnovaStaff</span></label>
                                    <input type="text" class="form-control" id="Codigo" aria-describedby="Codigo"
                                        placeholder="ATHON678" name="codigo" value="{{ old('codigo') }}">
                                </div>

                        </div>

                        <div class="text-center mt-2 mb-2">
                            <button class="btn btn-secondary" type="submit">Guardar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="card-body p-0">
        <div class="table-responsive mt-4">
            <table class="table table-striped" role="grid" data-toggle="data-table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nombre Completo</th>
                        <th>Dni</th>
                         <th>SEDE</th>
                        <th>Celular</th>
                        <th>Código Alumko</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $estud)
                        <tr>
                            <td class="py-0">
                                <div class="d-flex align-items-center">
                                    <p>{{ $estud->id }}</p>
                                </div>
                            </td>

                            <td>
                                <p>{{ $estud->apellidos }}, {{ $estud->nombre }}</p>
                            </td>

                            <td>
                                <p>{{ $estud->dni }}</p>
                            </td>
                             <td>
                                @foreach ($estud->user->sedes as $sede)
                                    <span>{{ $sede->nombre }}</span>
                                @endforeach
                            </td>

                            <td>
                                <p>{{ $estud->celular }}</p>
                            </td>

                            <td>
                                <p class="badge bg-alumko" style="font-size: 1em;">{{ $estud->codigo }}</p>
                            </td>

                            <td>
                                <div class="flex align-items-center list-user-action">

                                    <a class="btn btn-sm btn-icon text-warning" data-bs-toggle="modal"
                                        data-bs-original-title="Editar" data-bs-target="#model-edit-{{ $estud->id }}">
                                        <span class="btn-inner">
                                            <svg width="20" viewBox="0 0 24 24" fill="none"
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
                                        data-bs-target="#model-delete-{{ $estud->id }}">
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
                        @include('pages.docente.modal')
                        @include('pages.docente.edit')

                    @empty
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

   <script>
    // Escuchar cuando se escribe en el campo DNI

    document.getElementById('dni_docente').addEventListener('input', async (e) => {
        const dni = e.target.value;
        console.log(dni);
        if (dni.length === 8) {
            // Mostrar un indicador de carga si es posible
            try {
                const response = await fetch(
                    `https://dniruc.apisperu.com/api/v1/dni/${dni}?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imp1YWFua2FybTEwQGdtYWlsLmNvbSJ9.1R5TJpcNMHsvYLw6CKooKFAQF1fN_Kj_uMqtNAu4GDo`
                );
                const data = await response.json();
                console.log(data);
                if (data.success) {
                    // Llenar los campos automáticamente
                    document.getElementsByName('nombre')[0].value = data.nombres;
                    document.getElementsByName('apellidop')[0].value = data.apellidoPaterno + ' ' + data.apellidoMaterno;
;
                   
                } else {
                    console.error("DNI no encontrado o error en la consulta");
                }
            } catch (error) {
                console.error("Error de conexión con la API");
            }
        }
    });


    </script>
@endsection
