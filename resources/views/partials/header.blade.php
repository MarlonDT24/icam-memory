<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('principal') }}">
                <img src="/img/icam_icon.png" alt="logo" width="65">
                ICAM SL
            </a>
            <!-- Boton menu responsive -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                @include('partials.nav')
            </div>
            <div class="theme-switch" id="theme" role="button" aria-label="Cambiar tema">
                <span class="icon sun">🌞</span>
                <div class="switch">
                    <div class="ball"></div>
                </div>
                <span class="icon moon">🌙</span>
            </div>
        </div>
    </nav>
</header>
