<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('principal') }}">Inicio</a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{ route('principal') }}#tipo-memoria" id="crearDesplegable" role="button" data-bs-toggle="dropdown" aria-expanded="false">Crear Memoria</a>
        <ul class="dropdown-menu" aria-labelledby="crearDesplegable">
            <li><a class="dropdown-item" href="{{ route('form.create') }}">Memoria de Compatibilidad</a></li>
            <li><a class="dropdown-item" href="{{ route('lowVoltage.create') }}">Memoria de Baja Tensión</a></li>
            <li><a class="dropdown-item" href="{{ route('groupElectro.create') }}">Memoria de Grupo Electrógeno</a></li>
        </ul>
    </li>
</ul>
