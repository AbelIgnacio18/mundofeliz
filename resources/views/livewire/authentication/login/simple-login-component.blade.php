@section('tab_tittle', 'Login')
<section class="login-content">
    <div class="login row m-0 align-items-center justify-content-center bg-white vh-100 vw-100">


        <!-- <div class="col-md-6">
            <div class="row justify-content-end">
                <div class="col-md-10 col-lg-10">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('home') }}" class="">
                                <img src="{{ asset('assets/images/auth/alumko_niño.png') }}" width="740px" alt="Alumko Niño">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <div class="col-md-5">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-10">
                    <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                        <div class="card-body">
                            <a href="{{ route('home') }}" class="navbar-brand d-flex justify-content-center mb-3">
                                <!--Logo start-->
                                <img src="{{ asset('assets/images/alumko.webp') }}" width="300px" alt="Logo Colegio Santa Bárbara">
                                <!--logo End-->
                                {{-- <h5 class="logo-title ms-3">ALUMKO</h5> --}}
                            </a>
                            <h2 class="mb-2 text-center">Iniciar Sesión</h2>
                            <p class="text-center">Sistema Educativo</p>
                            @if (session()->has('error'))
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                            <form wire:submit.prevent="login">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input wire:model.debounce.500ms="email" type="email" class="form-control" id="floatingInput"
                                                placeholder="name@example.com" aria-describedby="email">
                                            <label for="floatingInput">Correo electrónico</label>
                                            @error('email')
                                            <div class="text-danger m-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input wire:model.debounce.500ms="password" type="password" class="form-control" id="floatingPassword"
                                                placeholder="Password" aria-describedby="password">
                                            <label for="floatingPassword">Contraseña</label>
                                            <span type="button" class="vercontraseña">
                                                <!-- OJO ABIERTO -->
                                                <svg class="icon-open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-width="1.5" d="M12 15.2a3.15 3.15 0 1 0 0-6.3 3.15 3.15 0 0 0 0 6.3z" />
                                                    <path stroke="currentColor" stroke-width="1.5" d="M21.25 12.05c-2 4.56-5.48 7.3-9.25 7.3S4.7 16.62 2.75 12.05C4.7 7.49 8.18 4.75 12 4.75s7.25 2.74 9.25 7.3z" />
                                                </svg>

                                                <!-- OJO CERRADO -->
                                                <svg class="icon-closed" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" style="display: none;">
                                                    <path stroke="currentColor" stroke-width="1.5" d="M3 3l18 18" />
                                                    <path stroke="currentColor" stroke-width="1.5" d="M10.6 10.65a3.15 3.15 0 0 1 4.45 4.45" />
                                                    <path stroke="currentColor" stroke-width="1.5" d="M9.5 5.2c.8-.3 1.66-.45 2.5-.45 3.8 0 7.28 2.74 9.25 7.3a18.8 18.8 0 0 1-2 3.3" />
                                                    <path stroke="currentColor" stroke-width="1.5" d="M5 6.7A18.8 18.8 0 0 0 2.75 12c2 4.56 5.48 7.3 9.25 7.3 1.5 0 3-.34 4.3-1" />
                                                </svg>
                                            </span>


                                            @error('password')
                                            <div class="text-danger m-1">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-lg-12 d-flex justify-content-between">
                                        <div class="form-check mb-3">
                                            <input wire:model="rememberMe" type="checkbox" class="form-check-input"
                                                id="customCheck1">

                                            <label class="form-check-label" for="customCheck1">Recordar
                                                contraseña</label>
                                        </div>
                                        <!-- <a href="recoverpw.html">Olvidaste tu contraseña?</a> -->
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sign-bg">
            </div>
        </div>









    </div>
</section>