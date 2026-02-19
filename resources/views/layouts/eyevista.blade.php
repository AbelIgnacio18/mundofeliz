@include('partials.header')

<body class="">
   
    <main class="main-content">
       

        <div class="conatiner-fluid content-inner mt-4 py-0" >
            <div class="col-sm-12">
                <div class="card">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Footer Section Start -->
     
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
