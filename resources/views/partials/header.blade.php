<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="/img/icam_icon.png" alt="logo" width="50">
                <span class="fw-bold">ICAM SL</span>
            </a>

            <!-- Boton menu responsive -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                @include('partials.nav')
                
                <div class="d-flex flex-column gap-2 mt-3 d-lg-none">
                    <div class="theme-switch" id="theme" role="button" aria-label="Cambiar tema">
                        <span class="icon sun">🌞</span>
                        <div class="switch">
                            <div class="ball"></div>
                        </div>
                        <span class="icon moon">🌙</span>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-inline">
                        @csrf
                        <button type="button" id="logoutButton" class="btn btn-outline-light ms-3">Cerrar Sesión</button>
                    </form>
                </div>
            </div>

            <!-- Tema y logout escritorio (fuera del colapsado) -->
            <div class="d-none d-lg-flex align-items-center gap-3">
                <div class="theme-switch" id="theme" role="button" aria-label="Cambiar tema">
                    <span class="icon sun">🌞</span>
                    <div class="switch"><div class="ball"></div></div>
                    <span class="icon moon">🌙</span>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </nav>
</header>