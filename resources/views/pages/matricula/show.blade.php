@extends('layouts.master')

@section('tab_tittle','Detalle de estudiante')

@section('content')
<div class="card-header d-flex justify-content-between flex-wrap">

    <div class="header-title">
        <h3 class="text-primary card-title mb-0">Detalle</h3>
    </div>

</div>

<div class="p-3">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card" style="background-color: #ffffff63">
                <div class="card-header d-flex justify-content-between" style="background-color: #ffffff63">
                    <div class="header-title">
                        <h4 class="card-title">Datos del Estudiante</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="px-3">
                            <div class="bg-primary text-white p-3 rounded">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="currentColor" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1">Nombre del Estudiante</p>
                            <h5 class="mb-0">{{$matricula->estudiante->nombre}} {{$matricula->estudiante->apellidos}}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mt-4">
                        <div class="px-3">
                            <div class="bg-info text-white p-3 rounded">
                                <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 24 24">
                                    <path d="M15.7161 16.2234H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.7161 12.0369H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.2521 7.86011H8.49707" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.909 2.74976C15.909 2.74976 8.23198 2.75376 8.21998 2.75376C5.45998 2.77076 3.75098 4.58676 3.75098 7.35676V16.5528C3.75098 19.3368 5.47298 21.1598 8.25698 21.1598C8.25698 21.1598 15.933 21.1568 15.946 21.1568C18.706 21.1398 20.416 19.3228 20.416 16.5528V7.35676C20.416 4.57276 18.693 2.74976 15.909 2.74976Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1">DNI</p>
                            <h5 class="mb-0">{{$matricula->estudiante->dni}} </h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mt-4">
                        <div class="px-3">
                            <div class="bg-warning text-white p-3 rounded">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.09277 9.40421H20.9167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16.442 13.3097H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12.0045 13.3097H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7.55818 13.3097H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16.442 17.1962H16.4512" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M12.0045 17.1962H12.0137" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7.55818 17.1962H7.56744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M16.0433 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M7.96515 2V5.29078" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2383 3.5791H7.77096C4.83427 3.5791 3 5.21504 3 8.22213V17.2718C3 20.3261 4.83427 21.9999 7.77096 21.9999H16.229C19.175 21.9999 21 20.3545 21 17.3474V8.22213C21.0092 5.21504 19.1842 3.5791 16.2383 3.5791Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1">Fecha Matrícula</p>
                            <h5 class="mb-0">{{$matricula->estudiante->created_at}} </h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mt-4">
                        <div class="px-3">
                            <div class="bg-dark text-white p-3 rounded">
                                <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 24 24">
                                    <path d="M11.9951 16.6766V14.1396" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.19 5.33008C19.88 5.33008 21.24 6.70008 21.24 8.39008V11.8301C18.78 13.2701 15.53 14.1401 11.99 14.1401C8.45 14.1401 5.21 13.2701 2.75 11.8301V8.38008C2.75 6.69008 4.12 5.33008 5.81 5.33008H18.19Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M15.4951 5.32576V4.95976C15.4951 3.73976 14.5051 2.74976 13.2851 2.74976H10.7051C9.48512 2.74976 8.49512 3.73976 8.49512 4.95976V5.32576" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M2.77441 15.4829L2.96341 17.9919C3.09141 19.6829 4.50041 20.9899 6.19541 20.9899H17.7944C19.4894 20.9899 20.8984 19.6829 21.0264 17.9919L21.2154 15.4829" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1">Aula</p>
                            <h5 class="mb-0">{{$matricula->aula->nivel}} {{$matricula->aula->grado}} {{$matricula->aula->seccion}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card" style="background-color: #ffffff63">
                <div class="card-header d-flex justify-content-between" style="background-color: #ffffff63">
                    <div class="header-title">
                        <h4 class="card-title">Datos del Apoderado</h4>
                    </div>
                </div>
                <div class="row">

                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="px-3">
                                <div class="bg-primary text-white p-3 rounded">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="currentColor" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1">Nombre del Apoderado</p>
                                <h5 class="mb-0">{{$matricula->estudiante->apoderado->nombre}}</h5>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mt-4">
                            <div class="px-3">
                                <div class="bg-info text-white p-3 rounded">
                                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 24 24">
                                        <path d="M15.7161 16.2234H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15.7161 12.0369H8.49609" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.2521 7.86011H8.49707" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.909 2.74976C15.909 2.74976 8.23198 2.75376 8.21998 2.75376C5.45998 2.77076 3.75098 4.58676 3.75098 7.35676V16.5528C3.75098 19.3368 5.47298 21.1598 8.25698 21.1598C8.25698 21.1598 15.933 21.1568 15.946 21.1568C18.706 21.1398 20.416 19.3228 20.416 16.5528V7.35676C20.416 4.57276 18.693 2.74976 15.909 2.74976Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1">DNI</p>
                                <h5 class="mb-0">{{$matricula->estudiante->apoderado->dni}} </h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start align-items-center mt-4">
                            <div class="px-3">
                                <div class="bg-success text-white p-3 rounded">
                                    <svg fill="none" xmlns="http://www.w3.org/2000/svg" width="32px" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M14.353 2.5C18.054 2.911 20.978 5.831 21.393 9.532" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M14.353 6.04297C16.124 6.38697 17.508 7.77197 17.853 9.54297" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0315 12.4724C15.0205 16.4604 15.9254 11.8467 18.4653 14.3848C20.9138 16.8328 22.3222 17.3232 19.2188 20.4247C18.8302 20.737 16.3613 24.4943 7.68447 15.8197C-0.993406 7.144 2.76157 4.67244 3.07394 4.28395C6.18377 1.17385 6.66682 2.58938 9.11539 5.03733C11.6541 7.5765 7.04254 8.48441 11.0315 12.4724Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </div>
                            </div>
                            <div>
                                <p class="mb-1">Celular</p>
                                <h5 class="mb-0">{{$matricula->estudiante->apoderado->celular}}</h5>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>


    </div>
</div>



<div class="form-group text-center">
    <a href="{{url('dashboard/matriculas')}}" class="btn btn-secondary" type="submit">Regresar</a>
</div>
@endsection