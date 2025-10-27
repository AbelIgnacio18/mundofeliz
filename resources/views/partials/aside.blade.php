<aside class="sidebar sidebar-default navs-pill-all mb-3">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        {{-- *** Logo *** --}}
        <a href="{{ route('home') }}" class="navbar-brand">

            <img src="{{ asset('assets/images/logo.png') }}" width="60px" alt="Isotipo Colegio Mundo Feliz">
            <img class="logo-title" src="{{ asset('assets/images/logo_nombre.png') }}" width="69px" height="51px" alt="Nombre Colegio Mundo Feliz">
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <!-- Sidebar Menu Start -->
            <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                <li class="nav-item dropdown">
                    <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0.425rem 0.3rem;">

                        @if (auth()->user()->foto != '')
                        <img src="{{ asset('imagenes/avatar/' . auth()->user()->foto) }}" alt="User-Profile"
                            class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                        @else
                        <img src="{{ asset('assets/images/avatars/01.png') }}" alt="User-Profile"
                            class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                        @endif
                        <div class="container upload-icone bg-green">
                        </div>

                        <div class="caption m-n2 d-md-block">
                            <h6 class="mb-0 caption-title" style="color: var(--bs-primary); font-weight: 600">
                                {{ auth()->user()->name }}
                            </h6>
                            <p class="mb-0 caption-sub-title" style="font-size: 14px">{{ auth()->user()->email }}</p>
                        </div>
                    </a>


                <li class="nav-item">
                    {{-- Activar módulo: <a class="nav-link {{ activeRoute(route('{{ activeRoute(route('app.home')) }}" aria-current="page" href="{{ route('app.home') }}"> --}}
                    <a class="nav-link " aria-current="page" href="{{ route('app.home') }}">
                        <i class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.4" d="M2 4C2 2.89543 2.89543 2 4 2H9C10.1046 2 11 2.89543 11 4V20C11 21.1046 10.1046 22 9 22H4C2.89543 22 2 21.1046 2 20V4Z" fill="currentColor" />
                                <path d="M13 4C13 2.89543 13.8954 2 15 2H20C21.1046 2 22 2.89543 22 4V9C22 10.1046 21.1046 11 20 11H15C13.8954 11 13 10.1046 13 9V4Z" fill="currentColor" />
                                <path d="M13 15C13 13.8954 13.8954 13 15 13H20C21.1046 13 22 13.8954 22 15V20C22 21.1046 21.1046 22 20 22H15C13.8954 22 13 21.1046 13 20V15Z" fill="currentColor" />
                            </svg>
                        </i>
                        <span class="item-name">Panel Control</span>
                    </a>
                </li>



                {{-- *** Estudiante *** --}}
                @if(auth()->user()->hasPermission('VER ESTUDIANTES'))
                <li class="nav-item">
                    <a class="{{ request()->is('dashboard/estudiantes') ? 'nav-link active' : 'nav-link' }}"
                        aria-current="page" href="{{ url('dashboard/estudiantes') }}">
                        <i class="icon">
                            <svg width="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.9488 14.54C8.49884 14.54 5.58789 15.1038 5.58789 17.2795C5.58789 19.4562 8.51765 20.0001 11.9488 20.0001C15.3988 20.0001 18.3098 19.4364 18.3098 17.2606C18.3098 15.084 15.38 14.54 11.9488 14.54Z"
                                    fill="currentColor"></path>
                                <path opacity="0.4"
                                    d="M11.949 12.467C14.2851 12.467 16.1583 10.5831 16.1583 8.23351C16.1583 5.88306 14.2851 4 11.949 4C9.61293 4 7.73975 5.88306 7.73975 8.23351C7.73975 10.5831 9.61293 12.467 11.949 12.467Z"
                                    fill="currentColor"></path>
                                <path opacity="0.4"
                                    d="M21.0881 9.21923C21.6925 6.84176 19.9205 4.70654 17.664 4.70654C17.4187 4.70654 17.1841 4.73356 16.9549 4.77949C16.9244 4.78669 16.8904 4.802 16.8725 4.82902C16.8519 4.86324 16.8671 4.90917 16.8895 4.93889C17.5673 5.89528 17.9568 7.0597 17.9568 8.30967C17.9568 9.50741 17.5996 10.6241 16.9728 11.5508C16.9083 11.6462 16.9656 11.775 17.0793 11.7948C17.2369 11.8227 17.3981 11.8371 17.5629 11.8416C19.2059 11.8849 20.6807 10.8213 21.0881 9.21923Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M22.8094 14.817C22.5086 14.1722 21.7824 13.73 20.6783 13.513C20.1572 13.3851 18.747 13.205 17.4352 13.2293C17.4155 13.232 17.4048 13.2455 17.403 13.2545C17.4003 13.2671 17.4057 13.2887 17.4316 13.3022C18.0378 13.6039 20.3811 14.916 20.0865 17.6834C20.074 17.8032 20.1698 17.9068 20.2888 17.8888C20.8655 17.8059 22.3492 17.4853 22.8094 16.4866C23.0637 15.9589 23.0637 15.3456 22.8094 14.817Z"
                                    fill="currentColor"></path>
                                <path opacity="0.4"
                                    d="M7.04459 4.77973C6.81626 4.7329 6.58077 4.70679 6.33543 4.70679C4.07901 4.70679 2.30701 6.84201 2.9123 9.21947C3.31882 10.8216 4.79355 11.8851 6.43661 11.8419C6.60136 11.8374 6.76343 11.8221 6.92013 11.7951C7.03384 11.7753 7.09115 11.6465 7.02668 11.551C6.3999 10.6234 6.04263 9.50765 6.04263 8.30991C6.04263 7.05904 6.43303 5.89462 7.11085 4.93913C7.13234 4.90941 7.14845 4.86348 7.12696 4.82926C7.10906 4.80135 7.07593 4.78694 7.04459 4.77973Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M3.32156 13.5127C2.21752 13.7297 1.49225 14.1719 1.19139 14.8167C0.936203 15.3453 0.936203 15.9586 1.19139 16.4872C1.65163 17.4851 3.13531 17.8066 3.71195 17.8885C3.83104 17.9065 3.92595 17.8038 3.91342 17.6832C3.61883 14.9167 5.9621 13.6046 6.56918 13.3029C6.59425 13.2885 6.59962 13.2677 6.59694 13.2542C6.59515 13.2452 6.5853 13.2317 6.5656 13.2299C5.25294 13.2047 3.84358 13.3848 3.32156 13.5127Z"
                                    fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Estudiantes</span>
                    </a>
                </li>
                @endif

                {{-- *** Matrícula *** --}}

                @if(auth()->user()->hasPermission('VER MATRICULA'))
                <!-- matricula -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#matricula" role="button" aria-expanded="false" aria-controls="Calificaciones-menus">
                        <i class="icon">
                            <svg class="icon-32" width="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4"
                                    d="M18.8088 9.021C18.3573 9.021 17.7592 9.011 17.0146 9.011C15.1987 9.011 13.7055 7.508 13.7055 5.675V2.459C13.7055 2.206 13.5036 2 13.253 2H7.96363C5.49517 2 3.5 4.026 3.5 6.509V17.284C3.5 19.889 5.59022 22 8.16958 22H16.0463C18.5058 22 20.5 19.987 20.5 17.502V9.471C20.5 9.217 20.299 9.012 20.0475 9.013C19.6247 9.016 19.1177 9.021 18.8088 9.021Z"
                                    fill="currentColor"></path>
                                <path opacity="0.4"
                                    d="M16.0842 2.56737C15.7852 2.25637 15.2632 2.47037 15.2632 2.90137V5.53837C15.2632 6.64437 16.1742 7.55437 17.2802 7.55437C17.9772 7.56237 18.9452 7.56437 19.7672 7.56237C20.1882 7.56137 20.4022 7.05837 20.1102 6.75437C19.0552 5.65737 17.1662 3.69137 16.0842 2.56737Z"
                                    fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.97398 11.3877H12.359C12.77 11.3877 13.104 11.0547 13.104 10.6437C13.104 10.2327 12.77 9.89868 12.359 9.89868H8.97398C8.56298 9.89868 8.22998 10.2327 8.22998 10.6437C8.22998 11.0547 8.56298 11.3877 8.97398 11.3877ZM8.97408 16.3819H14.4181C14.8291 16.3819 15.1631 16.0489 15.1631 15.6379C15.1631 15.2269 14.8291 14.8929 14.4181 14.8929H8.97408C8.56308 14.8929 8.23008 15.2269 8.23008 15.6379C8.23008 16.0489 8.56308 16.3819 8.97408 16.3819Z"
                                    fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Matricula</span>
                        <i class="right-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>

                        </i>
                    </a>
                    <ul class="sub-nav collapse" id="matricula" data-bs-parent="#sidebar-menu">



                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/matriculas') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/matriculas') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> A </i>
                                <span class="item-sub-name"> Matricula </span>
                            </a>
                        </li>
                        @forelse($menus as $menu)



                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/matricula-aula') ? 'nav-link active' : 'nav-link' }}" href="{{route('app.showaula',$menu->id)}}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> A </i>
                                <span class="item-sub-name"> {{ $menu->nivel }} {{ $menu->grado }} {{ $menu->seccion }}</span>
                            </a>
                        </li>
                        @empty
                        @endforelse




                    </ul>
                </li>
                @endif
                @if(auth()->user()->hasPermission('VER CONCEPTO'))
                <li class="nav-item">
                    <a class="{{ request()->is('dashboard/concepto-pago') ? 'nav-link active' : 'nav-link' }}" aria-current="page" href="{{ url('dashboard/concepto-pago') }}">
                        <i class="icon">
                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M12.0865 22C11.9627 22 11.8388 21.9716 11.7271 21.9137L8.12599 20.0496C7.10415 19.5201 6.30481 18.9259 5.68063 18.2336C4.31449 16.7195 3.5544 14.776 3.54232 12.7599L3.50004 6.12426C3.495 5.35842 3.98931 4.67103 4.72826 4.41215L11.3405 2.10679C11.7331 1.96656 12.1711 1.9646 12.5707 2.09992L19.2081 4.32684C19.9511 4.57493 20.4535 5.25742 20.4575 6.02228L20.4998 12.6628C20.5129 14.676 19.779 16.6274 18.434 18.1581C17.8168 18.8602 17.0245 19.4632 16.0128 20.0025L12.4439 21.9088C12.3331 21.9686 12.2103 21.999 12.0865 22Z" fill="currentColor"></path>
                                <path d="M11.3194 14.3209C11.1261 14.3219 10.9328 14.2523 10.7838 14.1091L8.86695 12.2656C8.57097 11.9793 8.56795 11.5145 8.86091 11.2262C9.15387 10.9369 9.63207 10.934 9.92906 11.2193L11.3083 12.5451L14.6758 9.22479C14.9698 8.93552 15.448 8.93258 15.744 9.21793C16.041 9.50426 16.044 9.97004 15.751 10.2574L11.8519 14.1022C11.7049 14.2474 11.5127 14.3199 11.3194 14.3209Z" fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Concepto</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('VER DOCENTE'))
                <li class="nav-item">
                    <a class="{{ request()->is('dashboard/docentes') ? 'nav-link active' : 'nav-link' }}" aria-current="page" href="{{ url('dashboard/docentes') }}">
                        <i class="icon">
                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746Z" fill="currentColor"></path>
                                <path opacity="0.4" d="M11.9971 12.5838C14.9351 12.5838 17.2891 10.2288 17.2891 7.29176C17.2891 4.35476 14.9351 1.99976 11.9971 1.99976C9.06008 1.99976 6.70508 4.35476 6.70508 7.29176C6.70508 10.2288 9.06008 12.5838 11.9971 12.5838Z" fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Docentes</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#Calificaciones-menus" role="button" aria-expanded="false" aria-controls="Calificaciones-menus">
                        <i class="icon">
                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M5.91064 20.5886C5.91064 19.7486 6.59064 19.0686 7.43064 19.0686C8.26064 19.0686 8.94064 19.7486 8.94064 20.5886C8.94064 21.4186 8.26064 22.0986 7.43064 22.0986C6.59064 22.0986 5.91064 21.4186 5.91064 20.5886ZM17.1606 20.5886C17.1606 19.7486 17.8406 19.0686 18.6806 19.0686C19.5106 19.0686 20.1906 19.7486 20.1906 20.5886C20.1906 21.4186 19.5106 22.0986 18.6806 22.0986C17.8406 22.0986 17.1606 21.4186 17.1606 20.5886Z" fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.1907 6.34909C20.8007 6.34909 21.2007 6.55909 21.6007 7.01909C22.0007 7.47909 22.0707 8.13909 21.9807 8.73809L21.0307 15.2981C20.8507 16.5591 19.7707 17.4881 18.5007 17.4881H7.59074C6.26074 17.4881 5.16074 16.4681 5.05074 15.1491L4.13074 4.24809L2.62074 3.98809C2.22074 3.91809 1.94074 3.52809 2.01074 3.12809C2.08074 2.71809 2.47074 2.44809 2.88074 2.50809L5.26574 2.86809C5.60574 2.92909 5.85574 3.20809 5.88574 3.54809L6.07574 5.78809C6.10574 6.10909 6.36574 6.34909 6.68574 6.34909H20.1907ZM14.1307 11.5481H16.9007C17.3207 11.5481 17.6507 11.2081 17.6507 10.7981C17.6507 10.3781 17.3207 10.0481 16.9007 10.0481H14.1307C13.7107 10.0481 13.3807 10.3781 13.3807 10.7981C13.3807 11.2081 13.7107 11.5481 14.1307 11.5481Z" fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Inventario</span>
                        <i class="right-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>

                        </i>
                    </a>
                    <ul class="sub-nav collapse" id="Calificaciones-menus" data-bs-parent="#sidebar-menu">
                        @if(auth()->user()->hasPermission('VER INVENTARIO ARTICULOS'))
                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/articulos') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/articulos') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> A </i>
                                <span class="item-sub-name"> Artículos </span>
                            </a>
                        </li>
                        @endif
                        @if(auth()->user()->hasPermission('VER INVENTARIO INGRESOS'))
                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/ingresos') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/ingresos') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> I </i>
                                <span class="item-sub-name"> Ingresos </span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/categoria') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/categoria') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">C</i>
                                <span class="item-sub-name">Categoría</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->hasPermission('VER COMPROBANTES'))
                <li class="nav-item">
                    <a class="{{ request()->is('dashboard/pagos-realizados') ? 'nav-link active' : 'nav-link' }}" aria-current="page" href="{{ url('dashboard/pagos-realizados') }}">
                        <i class="icon">
                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M21.25 13.4764C20.429 13.4764 19.761 12.8145 19.761 12.001C19.761 11.1865 20.429 10.5246 21.25 10.5246C21.449 10.5246 21.64 10.4463 21.78 10.3076C21.921 10.1679 22 9.97864 22 9.78146L21.999 7.10415C21.999 4.84102 20.14 3 17.856 3H6.144C3.86 3 2.001 4.84102 2.001 7.10415L2 9.86766C2 10.0648 2.079 10.2541 2.22 10.3938C2.36 10.5325 2.551 10.6108 2.75 10.6108C3.599 10.6108 4.239 11.2083 4.239 12.001C4.239 12.8145 3.571 13.4764 2.75 13.4764C2.336 13.4764 2 13.8093 2 14.2195V16.8949C2 19.158 3.858 21 6.143 21H17.857C20.142 21 22 19.158 22 16.8949V14.2195C22 13.8093 21.664 13.4764 21.25 13.4764Z" fill="currentColor"></path>
                                <path d="M15.4303 11.5887L14.2513 12.7367L14.5303 14.3597C14.5783 14.6407 14.4653 14.9177 14.2343 15.0837C14.0053 15.2517 13.7063 15.2727 13.4543 15.1387L11.9993 14.3737L10.5413 15.1397C10.4333 15.1967 10.3153 15.2267 10.1983 15.2267C10.0453 15.2267 9.89434 15.1787 9.76434 15.0847C9.53434 14.9177 9.42134 14.6407 9.46934 14.3597L9.74734 12.7367L8.56834 11.5887C8.36434 11.3907 8.29334 11.0997 8.38134 10.8287C8.47034 10.5587 8.70034 10.3667 8.98134 10.3267L10.6073 10.0897L11.3363 8.61268C11.4633 8.35868 11.7173 8.20068 11.9993 8.20068H12.0013C12.2843 8.20168 12.5383 8.35968 12.6633 8.61368L13.3923 10.0897L15.0213 10.3277C15.2993 10.3667 15.5293 10.5587 15.6173 10.8287C15.7063 11.0997 15.6353 11.3907 15.4303 11.5887Z" fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Comprobantes</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('VER ASISTENCIA'))
                <li class="nav-item">
                    <a class="nav-link"
                        data-bs-toggle="collapse" href="#Calificaciones-menu" role="button" aria-expanded="false"
                        aria-controls="Calificaciones-menu">
                        <i class="icon">

                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M16.3405 1.99976H7.67049C4.28049 1.99976 2.00049 4.37976 2.00049 7.91976V16.0898C2.00049 19.6198 4.28049 21.9998 7.67049 21.9998H16.3405C19.7305 21.9998 22.0005 19.6198 22.0005 16.0898V7.91976C22.0005 4.37976 19.7305 1.99976 16.3405 1.99976Z" fill="currentColor"></path>
                                <path d="M10.8134 15.248C10.5894 15.248 10.3654 15.163 10.1944 14.992L7.82144 12.619C7.47944 12.277 7.47944 11.723 7.82144 11.382C8.16344 11.04 8.71644 11.039 9.05844 11.381L10.8134 13.136L14.9414 9.00796C15.2834 8.66596 15.8364 8.66596 16.1784 9.00796C16.5204 9.34996 16.5204 9.90396 16.1784 10.246L11.4324 14.992C11.2614 15.163 11.0374 15.248 10.8134 15.248Z" fill="currentColor"></path>
                            </svg>

                        </i>
                        <span class="item-name">Asistencia</span>
                        <i class="right-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>

                        </i>
                    </a>
                    <ul class="sub-nav collapse" id="Calificaciones-menu" data-bs-parent="#sidebar-menu">

                        <!-- <li class="nav-item">
                            <a class="{{ request()->is('dashboard/asistencia-estudiantes') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/asistencia-estudiantes') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">LU</i>
                                <span class="item-sub-name">Estudiante</span>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a class="{{ request()->is('dashboard/asistencia-aula') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/asistencia-aula') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">LU</i>
                                <span class="item-sub-name">Asistencia por Aulas</span>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a class="{{ request()->is('dashboard/listar-falta') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/listar-falta') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">LU</i>
                                <span class="item-sub-name">Faltantes</span>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/asistencia-docentes') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/asistencia-docentes') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">AD</i>
                                <span class="item-sub-name">Asistencia Docente</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#Administracion" role="button"
                        aria-expanded="false" aria-controls="Calificaciones-menus">
                        <i class="icon">
                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0122 14.8299C10.4077 14.8299 9.10986 13.5799 9.10986 12.0099C9.10986 10.4399 10.4077 9.17993 12.0122 9.17993C13.6167 9.17993 14.8839 10.4399 14.8839 12.0099C14.8839 13.5799 13.6167 14.8299 12.0122 14.8299Z" fill="currentColor"></path>
                                <path opacity="0.4" d="M21.2301 14.37C21.036 14.07 20.76 13.77 20.4023 13.58C20.1162 13.44 19.9322 13.21 19.7687 12.94C19.2475 12.08 19.5541 10.95 20.4228 10.44C21.4447 9.87 21.7718 8.6 21.179 7.61L20.4943 6.43C19.9118 5.44 18.6344 5.09 17.6226 5.67C16.7233 6.15 15.5685 5.83 15.0473 4.98C14.8838 4.7 14.7918 4.4 14.8122 4.1C14.8429 3.71 14.7203 3.34 14.5363 3.04C14.1582 2.42 13.4735 2 12.7172 2H11.2763C10.5302 2.02 9.84553 2.42 9.4674 3.04C9.27323 3.34 9.16081 3.71 9.18125 4.1C9.20169 4.4 9.10972 4.7 8.9462 4.98C8.425 5.83 7.27019 6.15 6.38109 5.67C5.35913 5.09 4.09191 5.44 3.49917 6.43L2.81446 7.61C2.23194 8.6 2.55897 9.87 3.57071 10.44C4.43937 10.95 4.74596 12.08 4.23498 12.94C4.06125 13.21 3.87729 13.44 3.59115 13.58C3.24368 13.77 2.93709 14.07 2.77358 14.37C2.39546 14.99 2.4159 15.77 2.79402 16.42L3.49917 17.62C3.87729 18.26 4.58245 18.66 5.31825 18.66C5.66572 18.66 6.0745 18.56 6.40153 18.36C6.65702 18.19 6.96361 18.13 7.30085 18.13C8.31259 18.13 9.16081 18.96 9.18125 19.95C9.18125 21.1 10.1215 22 11.3069 22H12.6968C13.872 22 14.8122 21.1 14.8122 19.95C14.8429 18.96 15.6911 18.13 16.7029 18.13C17.0299 18.13 17.3365 18.19 17.6022 18.36C17.9292 18.56 18.3278 18.66 18.6855 18.66C19.411 18.66 20.1162 18.26 20.4943 17.62L21.2097 16.42C21.5776 15.75 21.6083 14.99 21.2301 14.37Z" fill="currentColor"></path>
                            </svg>
                        </i>
                        <span class="item-name">Administración

                        </span>
                        <i class="right-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>

                        </i>
                    </a>
                    <ul class="sub-nav collapse" id="Administracion" data-bs-parent="#sidebar-menu">
                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/administracion-anolectivo') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/administracion-anolectivo') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">CL</i>
                                <span class="item-sub-name">Año Lectivo</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link " href="{{ url('dashboard/concepto-pago') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">CT</i>
                                <span class="item-sub-name">Concepto</span>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/administracion-aulas') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/administracion-aulas') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">A</i>
                                <span class="item-sub-name">Aulas</span>
                            </a>
                        </li>
                        @if(auth()->user()->hasPermission('VER USUSARIOS'))
                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/administradores') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/administradores') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24" fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon"> LU </i>
                                <span class="item-sub-name"> Lista de Usuarios </span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/administracion-contrato') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/administracion-contrato') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">C</i>
                                <span class="item-sub-name">Cargo</span>
                            </a>
                        </li>
                        @if(auth()->user()->hasPermission('VER ROL & PERMISOS'))
                        <li class="nav-item">
                            <a class="{{ request()->is('dashboard/roles-permission') ? 'nav-link active' : 'nav-link' }}" href="{{ url('dashboard/roles-permission') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">R&P</i>
                                <span class="item-sub-name">Roles y Permisos</span>
                            </a>
                        </li>
                        @endif

                        <!--                         <li class="nav-item">
                            <a class="nav-link " href="{{ url('dashboard/administradores') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">S</i>
                                <span class="item-sub-name">Seguridad</span>
                            </a>
                        </li> -->

                    <!-- <li class="nav-item">
                            <a class="nav-link " href="{{ url('dashboard/administracion-caja') }}">
                                <i class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <g>
                                            <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                        </g>
                                    </svg>
                                </i>
                                <i class="sidenav-mini-icon">C</i>
                                <span class="item-sub-name">Caja</span>
                            </a>
                        </li> -->




                    </ul>
                </li>

               


                <div class="sidebar-footer"></div>

</aside>