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
                                        <a href="recoverpw.html">Olvidaste tu contraseña?</a>
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
