@extends('layout')

@section('title', 'Edición')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header text-center bg-primary text-white justify-content-between align-items-center">
                <h2 class="mb-3">EDITAR MEMORIA</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('groupElectro.update', $groupElectro->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label" for="name">Nombre de la Memoria:</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{ old('name') ? old('name') :  $groupElectro->name }}">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="budget_excel">Subir Excel:</label>
                        <input class="form-control" type="file" id="budget_excel" budget_excel="budget_excel" accept=".xlsx, .xls"
                        value="{{ old('budget_excel') ? old('budget_excel') :  $groupElectro->budget_excel }}">
                        @error('budget_excel') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    
                    <h5 class="mt-4">Características</h5>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label" for="holder">Nombre del Titular:</label>
                            <input class="form-control" type="text" id="holder" name="holder" value="{{ old('holder', $groupElectro->holder) }}">
                            @error('holder') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="cover">Imagen (opcional):</label>
                            @if ($groupElectro->cover)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/covers/' . basename($groupElectro->cover)) }}" alt="Portada actual" width="200px">
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
                        <input class="form-control" step="0.01" type="number" id="kva" name="kva" value="{{ old('kva', $groupElectro->kva) }}">
                        @error('kva') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="kw">Potencia Instalada en KW:</label>
                        <input class="form-control" step="0.01" type="number" id="kw" name="kw" value="{{ old('kw', $groupElectro->kw) }}">
                        @error('kw') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Mirar si se guarda la opcion en .edit --}}
                    <div class="mb-3">
                        <label class="form-label" for="tension_type">Tensión Simple y Compuesta en V:</label>
                        <select class="form-select" id="tension_type" name="tension_type" data-bs-toggle="tooltip" title="Seleccione el tipo de tensión">
                            <option value="">-- Seleccione --</option>
                            <option value="3F+N" {{ old('tension_type', $groupElectro->tension_type ?? '') == '3F+N' ? 'selected' : '' }}>3F+N (Trifásica)</option>
                            <option value="F+N" {{ old('tension_type', $groupElectro->tension_type ?? '') == 'F+N' ? 'selected' : '' }}>F+N (Monofásica)</option>
                        </select>
                        @error('tension_type') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="budget">Presupuesto Total de la Instalación:</label>
                        <input class="form-control" step="0.01" type="number" id="budget" name="budget" value="{{ old('budget', $groupElectro->budget) }}">
                        @error('budget') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    {{-- Mirar si se guarda la opcion en .edit --}}
                    <div class="mb-3">
                        <label class="form-label" for="type_clasi">Tipo de clasificación:</label>
                        <select class="form-select" id="type_clasi" name="type_clasi" data-bs-toggle="tooltip" title="Seleccione el tipo de clasificación">
                            <option value="">-- Seleccione --</option>
                            <option value="mojado" {{ old('type_clasi', $groupElectro->type_clasi ?? '') == 'mojado' ? 'selected' : '' }}>Tipo Mojado</option>
                            <option value="F+N" {{ old('type_clasi', $groupElectro->type_clasi ?? '') == 'F+N' ? 'selected' : '' }}>F+N (Monofásica)</option>
                        </select>
                        @error('type_clasi') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="mark">Marca:</label>
                        <input class="form-control" type="text" id="mark" name="mark" value="{{ old('mark', $groupElectro->mark) }}">
                        @error('mark') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="model">Model:</label>
                            <input class="form-control" type="text" id="model" name="model" value="{{ old('model', $groupElectro->model) }}">
                            @error('model') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
    
                        <div class="col-md-4">
                            <label class="form-label" for="image_model">Imagen del Modelo:</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/imagemodels/' . basename($groupElectro->image_model)) }}" alt="imagen del modelo"
                                    width="200px">
                            </div>
                            <input class="form-control" type="file" id="image_model" name="image_model" accept="image/*">
                            @error('image_model') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
    
                        <div class="col-md-4">
                            <label class="form-label" for="image_dimensions">Imagen de las Dimensiones:</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/imagedimensions/' . basename($groupElectro->image_dimensions)) }}" alt="imagen de las dimensiones"
                                    width="200px">
                            </div>
                            <input class="form-control" type="file" id="image_dimensions" name="image_dimensions" accept="image/*">
                            @error('image_dimensions') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="voltage">Tensión de servicio:</label>
                        <select class="form-select" id="voltage" name="voltage" data-bs-toggle="tooltip" title="Seleccione el tipo de tensión de servicio">
                            <option value="">-- Seleccione --</option>
                            <option value="3F+N" {{ old('voltage', $groupElectro->voltage ?? '') == '3F+N' ? 'selected' : '' }}>400/230V (Trifásica)</option>
                            <option value="F+N" {{ old('voltage', $groupElectro->voltage ?? '') == 'F+N' ? 'selected' : '' }}>230V (Monofásica)</option>
                        </select>
                        @error('voltage') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="air_entry">Entrada de aire en m3/h:</label>
                        <input class="form-control" step="0.01" type="number" id="air_entry" name="air_entry" value="{{ old('air_entry', $groupElectro->air_entry) }}">
                        @error('air_entry') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="air_flow">Entrada de flujo en m3/minuto:</label>
                        <input class="form-control" step="0.01" type="number" id="air_flow" name="air_flow" value="{{ old('air_flow', $groupElectro->air_flow) }}">
                        @error('air_flow') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="w">Potencia en W:</label>
                            <input class="form-control" step="0.01" type="number" id="w" name="w" value="{{ old('w', $groupElectro->w) }}">
                            @error('w') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
    
                        <div class="col-md-4">
                            <label class="form-label" for="factor">Factor de Potencia del Grupo:</label>
                            <input class="form-control" step="0.01" type="number" id="factor" name="factor" value="{{ old('factor', $groupElectro->factor) }}">
                            @error('factor') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
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
