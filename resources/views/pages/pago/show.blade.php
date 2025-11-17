@extends('layouts.master')

@section('tab_tittle','Detalle de estudiante')

@section('content')
<div class="card-header d-flex justify-content-between flex-wrap">

    <div class="header-title">
        <h3 class="text-primary card-title mb-0">Ver Comprobante</h3>
    </div>

</div>

<div class="p-3">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card" style="background-color: #ffffff63">
                <div class="card-header d-flex justify-content-between" style="background-color: #ffffff63">
                    <div class="header-title">
                        <h4 class="card-title">Datos del Comprobante</h4>
                    </div>
                </div>
                @forelse($estudiante as $est)
                <div class="card-body">
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="px-xl-3">
                            <div class="bg-primary text-white p-3 rounded">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 15.3462C8.11731 15.3462 4.81445 15.931 4.81445 18.2729C4.81445 20.6148 8.09636 21.2205 11.9849 21.2205C15.8525 21.2205 19.1545 20.6348 19.1545 18.2938C19.1545 15.9529 15.8735 15.3462 11.9849 15.3462Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9849 12.0059C14.523 12.0059 16.5801 9.94779 16.5801 7.40969C16.5801 4.8716 14.523 2.81445 11.9849 2.81445C9.44679 2.81445 7.3887 4.8716 7.3887 7.40969C7.38013 9.93922 9.42394 11.9973 11.9525 12.0059H11.9849Z" stroke="currentColor" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1">Estudiante</p>
                            <h5 class="mb-0">{{$est->nombre}} {{$est->apellidos}}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mt-4">
                        <div class="px-xl-3">
                            <div class="bg-info text-white p-3 rounded">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.857 20.417C19.73 20.417 21.249 18.899 21.25 17.026V17.024V14.324C20.013 14.324 19.011 13.322 19.01 12.085C19.01 10.849 20.012 9.846 21.249 9.846H21.25V7.146C21.252 5.272 19.735 3.752 17.862 3.75H17.856H6.144C4.27 3.75 2.751 5.268 2.75 7.142V7.143V9.933C3.944 9.891 4.945 10.825 4.987 12.019C4.988 12.041 4.989 12.063 4.989 12.085C4.99 13.32 3.991 14.322 2.756 14.324H2.75V17.024C2.749 18.897 4.268 20.417 6.141 20.417H6.142H17.857Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3711 9.06303L12.9871 10.31C13.0471 10.432 13.1631 10.517 13.2981 10.537L14.6751 10.738C15.0161 10.788 15.1511 11.206 14.9051 11.445L13.9091 12.415C13.8111 12.51 13.7671 12.647 13.7891 12.782L14.0241 14.152C14.0821 14.491 13.7271 14.749 13.4231 14.589L12.1921 13.942C12.0711 13.878 11.9271 13.878 11.8061 13.942L10.5761 14.589C10.2711 14.749 9.91609 14.491 9.97409 14.152L10.2091 12.782C10.2321 12.647 10.1871 12.51 10.0891 12.415L9.09409 11.445C8.84809 11.206 8.98309 10.788 9.32309 10.738L10.7001 10.537C10.8351 10.517 10.9521 10.432 11.0121 10.31L11.6271 9.06303C11.7791 8.75503 12.2191 8.75503 12.3711 9.06303Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1">Número Comprobante</p>
                            <h5 class="mb-0">{{$est->numcomprobante}}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mt-4">
                        <div class="px-xl-3">
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
                            <p class="mb-1">Fecha</p>
                            <h5 class="mb-0">{{$est->fecha}}</h5>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start align-items-center mt-4">
                        <div class="px-xl-3">
                            <div class="bg-success text-white p-3 rounded">
                                <svg class="icon-24" xmlns="http://www.w3.org/2000/svg" width="32px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1">Monto Total</p>
                            <h5 class="mb-0">S/.{{$est->montototal}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-6 col-sm-6">
            <div class="card" style="background-color: #ffffff63">
                <div class="card-header d-flex justify-content-between" style="background-color: #ffffff63">
                    <div class="header-title">
                        <h4 class="card-title">Detalle de Pago</h4>
                    </div>
                </div>
                <div class="row">

                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="px-xl-3">
                                <div class="bg-primary text-white p-3 rounded">
                                    <svg class="icon-24" xmlns="http://www.w3.org/2000/svg" width="32px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            @forelse($pension as $p)
                            <div class="">
                                <span>{{$p->concepto}}</span>
                                <div>
                                    <h5 class="counter" style="visibility: visible;">{{$p->cantidad}} x s/{{$p->monto}}</h5>
                                </div>
                            </div>
                            @empty
                            @endforelse
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="px-xl-3">
                                <div class="bg-secondary text-white p-3 rounded">
                                    <svg class="icon-24" xmlns="http://www.w3.org/2000/svg" width="32px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            @forelse($articulo as $art)
                            <div class="">
                                <span>{{$art->categoria}} {{$art->articulo}}</span>
                                <div>
                                    <h5 class="counter" style="visibility: visible;">{{$art->cantidad}} x s/{{$art->montoar}}</h5>
                                </div>
                            </div>
                            @empty
                            @endforelse
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- Imagen del comprobante -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card" style="background-color: #ffffff63">
                <div class="card-header d-flex justify-content-between mb-xxl-2" style="background-color: #ffffff63">
                    <div class="header-title">
                        <h4 class="card-title">Imagen</h4>
                    </div>
                </div>

                @if(($est->archivo) !="")
                <img class="bg-soft-primary rounded img-fluid" src="{{ asset('storage/pagos/' . $est->archivo) }}" alt="{{$est->id}}" class="img-thumbnail" style="width: 38vh;height: 38vh">
                @else
                <p>Ninguno</p>
                @endif
            </div>
        </div>
    </div>
</div>
@empty
@endforelse




@endsection