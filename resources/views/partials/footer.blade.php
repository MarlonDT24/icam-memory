<footer class="footer bg-danger text-light py-4 mt-auto border-top">
    <div class="container text-center d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="d-flex flex-column flex-md-row gap-3">
            <a href="{{ route('form.index') }}#tipo-memoria" class="text-decoration-none text-light fw-semibold">
                Crear Memoria
            </a>
            <a href="{{ route('pci.index') }}" class="text-decoration-none text-light fw-semibold">
                PCI Manager
            </a>
        </div>

        <div class="text-black small">
            ICAM SL - Plataforma de Gestión Técnica &middot; Desarrollado por <strong>Marlon Torres</strong> &copy; {{ date('Y') }}
        </div>
    </div>
</footer>
