@extends('layout')

@section('title', 'Compilador PCI - RSCIEI 2025')

@section('content')
<div class="container my-5">

    <h1 class="mb-4 fw-bold text-center">Formulario de Evaluación </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form id="pciForm" action="{{ route('pci.calculate.ajax') }}" method="POST" class="d-flex flex-wrap align-items-end justify-content-center gap-3">
                @csrf

                <div class="me-2" style="width: 180px;">
                    <label for="nombre" class="form-label fw-semibold">Nombre de la Tabla:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
                </div>
                
                <div class="me-2" style="width: 100px;">
                    <label for="tipo" class="form-label fw-semibold">Tipo</label>
                    <select name="tipo" id="tipo" class="form-select">
                        <option value="">--</option>
                        <option value="Av" {{ old('tipo') == 'Av' ? 'selected' : '' }}>Av</option>
                        <option value="Ah" {{ old('tipo') == 'Ah' ? 'selected' : '' }}>Ah</option>
                        <option value="B" {{ old('tipo') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('tipo') == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ old('tipo') == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                </div>

                <div class="me-2" style="width: 140px;">
                    <label for="superficie" class="form-label fw-semibold">Superficie</label>
                    <input type="number" name="superficie" id="superficie" class="form-control" value="{{ old('superficie') }}">
                </div>

                <div class="me-2" style="width: 200px;">
                    <label for="uso" class="form-label fw-semibold">Uso</label>
                    <select name="uso" id="uso" class="form-select">
                        <option value="">--</option>
                        <option value="almacenamiento" {{ old('uso') == 'almacenamiento' ? 'selected' : '' }}>Almacenamiento</option>
                        <option value="producción" {{ old('uso') == 'producción' ? 'selected' : '' }}>Producción</option>
                    </select>
                </div>

                <div class="me-2" style="width: 100px;">
                    <label for="nivel" class="form-label fw-semibold">Riesgo</label>
                    <select name="nivel" id="nivel" class="form-select">
                        <option value="">--</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('nivel') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="me-2" style="width: 190px;">
                    <label for="rasante" class="form-label fw-semibold">Planta</label>
                    <select name="rasante" id="rasante" class="form-select">
                        <option value="rasante" {{ old('rasante', 'rasante') == 'rasante' ? 'selected' : '' }}>Sobre rasante</option>
                        <option value="sotano" {{ old('rasante') == 'sotano' ? 'selected' : '' }}>Sótano</option>
                    </select>
                </div>

                <div class="me-2">
                    <button type="submit" class="btn btn-danger">
                        Calcular
                    </button>
                </div>
            </form>
        </div>
    </div>

   {{-- Tabla horizontal de resultados generado dinamicamente--}}
   <div class="table-responsive" id="tabla-wrapper">
    <table class="table table-bordered text-center align-middle" id="tabla-resultados">
        <thead class="table-light">
            <tr id="cabecera-tabla">
                <th>RESULTADOS</th> {{-- Columna fija para los nombres --}}
                {{-- Las columnas de los parámetros se rellenan dinámicamente con JS --}}
            </tr>
        </thead>
        <tbody id="cuerpo-tabla">
            {{-- Filas se añaden dinámicamente con JS --}}
        </tbody>
    </table>
</div>

</div>
@endsection
@push('scripts')
    <script>
        const PCI_ROUTE = "{{ route('pci.calculate.ajax') }}";
    </script>
    <script src="{{ asset('js/pci.js') }}"></script>
@endpush