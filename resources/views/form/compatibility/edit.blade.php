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
                            value="{{ old('name') ? old('name') : $form->name }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <h5 class="mt-4">Titular</h5>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label" for="holder">Nombre del Titular:</label>
                            <input class="form-control" type="text" id="holder" name="holder"  value="{{ old('holder', $form->holder) }}">
                            @error('holder')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="cover">Imagen (opcional):</label>
                            @if ($form->cover)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/covers/' . basename($form->cover)) }}" alt="Portada actual"
                                        width="200px">
                                </div>
                            @endif
                            <input class="form-control" type="file" id="cover" name="cover" accept="image/*">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="address">Dirección Fiscal:</label>
                        <input class="form-control" type="text" id="address" name="address" value="{{ old('address', $form->address) }}">
                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cod_address">Código Postal:</label>
                        <input class="form-control" type="text" id="cod_address" name="cod_address" value="{{ old('cod_address', $form->cod_address) }}">
                        @error('cod_address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cif">CIF del Titular:</label>
                        <input class="form-control" type="text" id="cif" name="cif" value="{{ old('cif', $form->cif) }}">
                        @error('cif') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="name_agent">Representante:</label>
                        <input class="form-control" type="text" id="name_agent" name="name_agent" value="{{ old('name_agent', $form->name_agent) }}">
                        @error('name_agent') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nif">NIF del Representante:</label>
                        <input class="form-control" type="text" id="nif" name="nif" value="{{ old('nif', $form->nif) }}">
                        @error('nif') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <h5 class="mt-4">Emplazamiento:</h5>
                    <div class="mb-3">
                        <label class="form-label" for="location">Dirección del Emplazamiento:</label>
                        <input class="form-control" type="text" id="location" name="location" value="{{ old('location', $form->location) }}">
                        @error('location') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cod_location">Código Postal del Emplazamiento:</label>
                        <input class="form-control" type="text" id="cod_location" name="cod_location" value="{{ old('cod_location', $form->cod_location) }}">
                        @error('cod_location') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <h5 class="mt-4">Actividad:</h5>
                    <div class="mb-3">
                        <label class="form-label" for="activity">Actividad a realizar:</label>
                        <input class="form-control" type="text" id="activity" name="activity" value="{{ old('activity', $form->activity) }}">
                        @error('activity') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Descripción de la Actividad:</label>
                        <input class="form-control" type="text" id="description" name="description" value="{{ old('description', $form->description) }}">
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <h5 class="mt-4">Necesidades de uso y Aprovechamiento del Suelo:</h5>
                    <div class="mb-3">
                        <label class="form-label" for="m_parcels">Metros Cuadrados de la Parcela:</label>
                        <input class="form-control" type="text" id="m_parcels" name="m_parcels" value="{{ old('m_parcels', $form->m_parcels) }}">
                        @error('m_parcels') <small class="text-danger">{{ $message }}</small> @enderror
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
