<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        {{-- *** Logo *** --}}
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('assets/images/logob.svg') }}" width="60px" alt="Isotipo Colegio Santa Bárbara">
            <img class="logo-title mb-n3" src="{{ asset('assets/images/logo_nombreb.svg') }}" width="140px" alt="Texto Colegio Santa Bárbara">
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg width="20px" height="20px" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                </svg>
            </i>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <span class="mt-2 navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">

                {{-- * Modo Oscuro * --}}
                <li class="nav-item dropdown">
                    <label class="modo">
                        <input type="checkbox" />
                        <div class="checkmark">
                            <div class="btn Yes name" data-setting="color-mode" data-name="color" data-value="light">
                                <svg class="icon Yes" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8M12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18M20,8.69V4H15.31L12,0.69L8.69,4H4V8.69L0.69,12L4,15.31V20H8.69L12,23.31L15.31,20H20V15.31L23.31,12L20,8.69Z" />
                                </svg>
                            </div>

                            <div class="btn No name active" data-setting="color-mode" data-name="color"
                                data-value="dark">
                                <svg class="icon No"" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="currentColor"
                                        d="M9,2C7.95,2 6.95,2.16 6,2.46C10.06,3.73 13,7.5 13,12C13,16.5 10.06,20.27 6,21.54C6.95,21.84 7.95,22 9,22A10,10 0 0,0 19,12A10,10 0 0,0 9,2Z" />
                                </svg>
                            </div>
                        </div>
                    </label>
                </li>


                <li class="nav-item dropdown">
                    <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <div class="caption ms-3">
                            <h6 class="mb-0 caption-title" style="color:#fff">{{ auth()->user()->name }}</h6>
                            <p class="mb-0 caption-sub-title"><span
                                    class="
                                badge bg-success">Activo</span></p>

                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        <li><a class="dropdown-item" href="{{ route('app.setting.my-profile') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-user me-2 icon-xxs dropdown-item-icon">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Perfil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>

                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-power me-2 icon-xxs dropdown-item-icon">
                                        <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
                                        <line x1="12" y1="2" x2="12" y2="12">
                                        </line>
                                    </svg>Cerrar Sesión</button>
                            </form>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>