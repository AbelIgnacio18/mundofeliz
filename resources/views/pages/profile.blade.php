@extends('layouts.masterPerfil')

@section('tab_tittle', 'Mi Perfil')

@section('content')
    <div class="mt-5">
        <div class="conatiner-fluid mt-3 py-0">
            <div class="row">
                <div class="col-lg-12  col-md-12  col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="profile-img position-relative me-3 mb-3 mb-lg-0 profile-logo profile-logo1">

                                        @if((auth()->user()->foto)!="")

                                        <img src="{{asset('imagenes/avatar/'.auth()->user()->foto)}}" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-100 avatar-rounded" >
                                        @else
                                        <img src="{{ asset('assets/images/avatars/01.png') }}" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-100 avatar-rounded">
                
                                        @endif
                                 
                                    </div>
                                    <div class="d-flex flex-wrap align-items-center mb-3 mb-sm-0">
                                        <h4 class="me-2 h4">{{ auth()->user()->name }}</h4>
                                        <span> - {{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="conatiner-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="profile-content tab-content">
                    <div class="tab-pane fade active show"">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <div class="header-title">
                                        <h4 class="card-title">Información de Perfil</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="user-bio mt-n3">
                                        <p>Datos de Perfil.</p>
                                    </div>
                                    <div class="mt-2">
                                        <h6 class="mb-1 text-primary">Nombre:</h6>
                                        <h5>{{ Auth::user()->name }} </h5>
                                    </div>
                                    <div class="mt-2">
                                        <h6 class="mb-1 text-primary">Apellidos:</h6>
                                        <h5>{{ Auth::user()->apellidos }} </h5>
                                    </div>
                                    <div class="mt-2">
                                        <h6 class="mb-1 text-primary">Correo Electrónico:</h6>
                                        <h5>{{ Auth::user()->email }} </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Cambiar Contraseña</h4>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        @livewire('authentication.change-password.change-password-component')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection