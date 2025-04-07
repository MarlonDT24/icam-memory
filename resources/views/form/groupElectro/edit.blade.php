@extends('layout')

@section('title', 'Edición')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-primary text-white justify-content-between align-items-center">
                <h2 class="mb-3">EDITAR MEMORIA</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('form.update', $form->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label" for="name">Nombre de la Memoria:</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="{{ old('name') ? old('name') : $groupElectro->name }}">
                        @error('name') <small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="budget_excel">Subir Excel:</label>
                        <p class="mb-2">
                            Excel: {{ basename($groupElectro->budget_excel) }}
                        </p>
                        <input class="form-control" type="file" id="budget_excel" name="budget_excel" accept=".xlsx, .xls">
                        @error('budget_excel') <br>[ERROR]:{{ $message }} @enderror
                    </div>
                    
                    <h5 class="mt-5 mb-3">Características</h5>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label" for="holder">Nombre del Titular:</label>
                            <input class="form-control" type="text" id="holder" name="holder"  value="{{ old('holder', $groupElectro->holder) }}">
                            @error('holder') <small class="text-danger">{{ $message }}</small>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="cover">Imagen (opcional):</label>
                            @if ($form->cover)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/covers/' . basename($groupElectro->cover)) }}" alt="Portada actual"
                                        width="200px">
                                </div>
                            @endif
                            <input class="form-control" type="file" id="cover" name="cover" accept="image/*">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="address">Dirección Fiscal:</label>
                        <input class="form-control" type="text" id="address" name="address" value="{{ old('address', $groupElectro->address) }}">
                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cod_address">Código Postal:</label>
                        <input class="form-control" type="text" id="cod_address" name="cod_address" value="{{ old('cod_address', $groupElectro->cod_address) }}">
                        @error('cod_address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cif">CIF del Titular:</label>
                        <input class="form-control" type="text" id="cif" name="cif" value="{{ old('cif', $groupElectro->cif) }}">
                        @error('cif') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="name_agent">Representante:</label>
                        <input class="form-control" type="text" id="name_agent" name="name_agent" value="{{ old('name_agent', $groupElectro->name_agent) }}">
                        @error('name_agent') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nif">NIF del Representante:</label>
                        <input class="form-control" type="text" id="nif" name="nif" value="{{ old('nif', $groupElectro->nif) }}">
                        @error('nif') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <h5 class="mt-4">Emplazamiento:</h5>
                    <div class="mb-3">
                        <label class="form-label" for="location">Dirección del Emplazamiento:</label>
                        <input class="form-control" type="text" id="location" name="location" value="{{ old('location', $groupElectro->location) }}">
                        @error('location') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cod_location">Código Postal del Emplazamiento:</label>
                        <input class="form-control" type="text" id="cod_location" name="cod_location" value="{{ old('cod_location', $groupElectro->cod_location) }}">
                        @error('cod_location') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="name_location">Localidad del Emplazamiento:</label>
                        <input class="form-control" type="text" id="name_location" name="name_location" value="{{ old('name_location', $groupElectro->name_location) }}">
                        @error('name_location') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="build">Tipo de Local:</label>
                        <input class="form-control" type="text" id="build" name="build" value="{{ old('build', $groupElectro->build) }}">
                        @error('build') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="kva">Potencia Instalada en KVA:</label>
                        <input class="form-control" type="text" id="kva" name="kva" value="{{ old('kva', $groupElectro->kva) }}">
                        @error('kva') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tension_type">Tensión Simple y Compuesta en V:</label>
                        <select class="form-select" id="tension_type" name="tension_type">
                            <option value="">-- Seleccione --</option>
                            <option value="3F+N" {{ old('tension_type', $groupElectro->tension_type) == '3F+N' ? 'selected' : '' }}>3F+N (Trifásica)</option>
                            <option value="F+N" {{ old('tension_type', $groupElectro->tension_type) == 'F+N' ? 'selected' : '' }}>F+N (Monofásica)</option>
                        </select>
                        @error('tension_type') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="m_surface">Metros Cuadrados de la Superficie:</label>
                        <input class="form-control" type="text" id="m_surface" name="m_surface" value="{{ old('m_surface', $form->m_surface) }}">
                        @error('m_surface') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <h5 class="mt-4">Requerimientos de la Instalación respecto a los Servicios Públicos Municipales:</h5>
                    <div class="mb-3">
                        <label for="requirements">REQUERIMIENTOS DE LA INSTALACIÓN RESPECTO A LOS SERVICIOS PÚBLICOS
                            MUNICIPALES:</label>
                        <textarea class="form-control" id="requirements" name="requirements" rows="4">{{ old('requirements') ? old('requirements') : $form->requirements }}</textarea>
                        @error('requirements') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="d-flex justify-content-left">
                        <button type="submit" class="btn btn-primary me-2">Actualizar</button>
                        <a href="{{ route('form.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
