@extends('layout')

@section('title', 'Creación')

@section('content')

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header text-center bg-danger text-white">
                <h2 class="mb-3">MEMORIA DE COMPATIBILIDAD</h2>
            </div>

            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    Hay errores en el formulario:<br>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>[ERROR]: {{ $error }}</li>
                        @endforeach
                    </ul>
                </div> 
                @endif

                <form action="{{ route('form.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="name">Nombre de la Memoria:</label>
                        <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" data-bs-toggle="tooltip" title="Introduzca el nombre de la memoria">
                        @error('name') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <h5 class="mt-4">Titular</h5>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label" for="holder">Nombre del Titular:</label>
                            <input class="form-control" type="text" id="holder" name="holder" value="{{ old('holder') }}" data-bs-toggle="tooltip" title="Introduzca el nombre del titular">
                            @error('holder') <br>[ERROR]:{{ $message }} @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="cover">Imagen (opcional):</label>
                            <input class="form-control" type="file" id="cover" name="cover" accept="image/*" data-bs-toggle="tooltip" title="Puede añadir una imagen">
                            @error('cover') <br>[ERROR]:{{ $message }} @enderror
                            <br>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="address">Dirección Fiscal:</label>
                        <input class="form-control" type="text" id="address" name="address" value="{{ old('address') }}" data-bs-toggle="tooltip" title="Introduzca una dirección fiscal">
                        @error('address') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cod_address">Código Postal:</label>
                        <input class="form-control" type="text" id="cod_address" name="cod_address" value="{{ old('cod_address') }}" data-bs-toggle="tooltip" title="Introduzca el código postal">
                        @error('cod_address') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cif">CIF del Titular:</label>
                        <input class="form-control" type="text" id="cif" name="cif" value="{{ old('cif') }}" data-bs-toggle="tooltip" title="Introduzca el CIF del titular">
                        @error('cif') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="name_agent">Representante:</label>
                        <input class="form-control" type="text" id="name_agent" name="name_agent" value="{{ old('name_agent') }}" data-bs-toggle="tooltip" title="Introduzca el nombre del representante">
                        @error('name_agent') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nif">NIF del Representante:</label>
                        <input class="form-control" type="text" id="nif" name="nif" value="{{ old('nif') }}" data-bs-toggle="tooltip" title="Introduzca el NIF del representante">
                        @error('nif') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <h5 class="mt-4">Emplazamiento:</h5>
                    <div class="mb-3">
                        <label class="form-label" for="location">Dirección del Emplazamiento:</label>
                        <input class="form-control" type="text" id="location" name="location" value="{{ old('location') }}" data-bs-toggle="tooltip" title="Introduzca la dirección del emplazamiento">
                        @error('location') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cod_location">Código Postal del Emplazamiento:</label>
                        <input class="form-control" type="text" id="cod_location" name="cod_location" value="{{ old('cod_location') }}" data-bs-toggle="tooltip" title="Introduzca el código postal del emplazamiento">
                        @error('cod_location') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <h5 class="mt-4">Actividad:</h5>
                    <div class="mb-3">
                        <label class="form-label" for="activity">Actividad a realizar:</label>
                        <input class="form-control" type="text" id="activity" name="activity" value="{{ old('activity') }}" data-bs-toggle="tooltip" title="Introduzca la actividad que se va realizar">
                        @error('activity') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Descripción de la Actividad:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" data-bs-toggle="tooltip" title="Introduzca una descripción que se va a realizar">{{ old('description') }}</textarea>
                        @error('description') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <h5 class="mt-4">Necesidades de uso y Aprovechamiento del Suelo:</h5>
                    <div class="mb-3">
                        <label class="form-label" for="m_parcels">Metros Cuadrados de la Parcela:</label>
                        <input class="form-control" type="text" id="m_parcels" name="m_parcels" value="{{ old('m_parcels') }}" data-bs-toggle="tooltip" title="Puede añadir decimales">
                        @error('m_parcels') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="m_surface">Metros Cuadrados de la Superficie Edificada:</label>
                        <input class="form-control" type="text" id="m_surface" name="m_surface" value="{{ old('m_surface') }}" data-bs-toggle="tooltip" title="Puede añadir decimales">
                        @error('m_surface') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <h5 class="mt-4">Requerimientos de la Instalación respecto a los Servicios Públicos Municipales:</h5>
                    <div class="mb-3">
                        <label class="form-label" for="requirements">Requerimientos de la Instalación:</label>
                        <textarea class="form-control" id="requirements" name="requirements" rows="6">{{ old('requirements',
                        "La instalación requiere de los servicios básicos de cualquier nave industrial. Estos servicios son los siguientes:\n\n• Conexión con red de agua municipal.\n• Conexión con red de alcantarillado.\n• Servicio de recogida de basuras.\n\nTambién se requiere conexión con la red eléctrica de Baja Tensión, aunque este servicio depende de la Compañía Suministradora.") }}</textarea>
                        @error('requirements') <br>[ERROR]:{{ $message }} @enderror
                        <br>
                    </div>

                    <div class="d-flex justify-content-left">
                        <button type="submit" class="btn btn-success me-2">Crear Plantilla</button>
                        <a href="{{ route('form.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
