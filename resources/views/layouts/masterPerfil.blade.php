@include('partials.header')

<body class="">
    @include('partials.aside')
    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            @include('partials.nav')
            <!-- Nav Header Component Start -->
            <div class="iq-navbar-header" style="height: 185px;">
                <div class="container-fluid iq-container my-n4">
                    <div class="row" >
                        <div class="col-md-12">
                            <div class="flex-wrap d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="h1">Hola {{ auth()->user()->name }}!</h2>
                                    <p>Mi Perfil</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="iq-header-img">
                    <img src="{{asset('assets/images/dashboard/top-header.png')}}" alt="header"
                        class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                </div>
            </div> <!-- Nav Header Component End -->
            <!--Nav End-->
        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">
            <div class="col-sm-12">

                @yield('content')

            </div>
        </div>
        <!-- Footer Section Start -->
        @include('partials.footer')
        <!-- Footer Section End -->
    </main>
    <!-- Wrapper End-->
    <!-- offcanvas start -->
    @include('partials.overlay')
    <!-- Wrapper End-->
    <!-- Library Bundle Script -->
    @include('partials.scripts')
    @livewireScripts
    @yield('scripts')
</body>

</html>
