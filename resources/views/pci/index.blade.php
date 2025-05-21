@extends('layout')

@section('title', 'Compilador PCI - RSCIEI 2025')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-6 space-y-6">
    <h1 class="text-2xl font-bold mb-4">Formulario de Evaluación PCI</h1>

    <form action="{{ route('pci.calculate') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf

        <div>
            <label for="tipo" class="font-semibold">Tipo de nave (A, B, C, etc.)</label>
            <input type="text" name="tipo" id="tipo" class="w-full border p-2 rounded" value="{{ old('tipo') }}">
            @error('tipo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="superficie" class="font-semibold">Superficie (m²)</label>
            <input type="number" name="superficie" id="superficie" class="w-full border p-2 rounded" value="{{ old('superficie') }}">
            @error('superficie') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="uso" class="font-semibold">Uso</label>
            <select name="uso" id="uso" class="w-full border p-2 rounded">
                <option value="">-- Selecciona --</option>
                <option value="almacenamiento" {{ old('uso') == 'almacenamiento' ? 'selected' : '' }}>Almacenamiento</option>
                <option value="producción" {{ old('uso') == 'producción' ? 'selected' : '' }}>Producción</option>
            </select>
            @error('uso') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="nivel" class="font-semibold">Nivel de riesgo (1-8)</label>
            <input type="number" name="nivel" id="nivel" class="w-full border p-2 rounded" min="1" max="8" value="{{ old('nivel') }}">
            @error('nivel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="rasante" class="font-semibold">Planta (opcional)</label>
            <select name="rasante" id="rasante" class="w-full border p-2 rounded">
                <option value="">-- Selecciona --</option>
                <option value="rasante" {{ old('rasante') == 'rasante' ? 'selected' : '' }}>Sobre rasante</option>
                <option value="sotano" {{ old('rasante') == 'sotano' ? 'selected' : '' }}>Bajo rasante</option>
            </select>
        </div>

        <div class="col-span-full">
            <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800">
                Calcular medidas PCI
            </button>
        </div>
    </form>

    @isset($resultados)
        <div class="mt-10">
            <h2 class="text-xl font-semibold mb-4">Resultados del Cálculo</h2>
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Parámetro</th>
                        <th class="border px-4 py-2 text-left">Resultado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultados as $clave => $valor)
                        <tr>
                            <td class="border px-4 py-2 font-medium">{{ ucfirst(str_replace('_', ' ', $clave)) }}</td>
                            <td class="border px-4 py-2">{{ $valor }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endisset
</div>
@endsection