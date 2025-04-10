@extends('layout')

@section('title', 'Creación')

@section('content')

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header text-center bg-danger text-white">
                <h2 class="mb-3">MEMORIA DE GRUPO ELECTRÓGENO</h2>
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

                <form action="{{ route('groupElectro.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h5 class="mt-2 mb-3">Datos de la Memoria</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" for="name">Nombre de la Memoria:</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" data-bs-toggle="tooltip" title="Introduzca el nombre de la memoria">
                            @error('name') <br>[ERROR]:{{ $message }} @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="author">Autor:</label>
                            <select class="form-select" id="author" name="author" data-bs-toggle="tooltip" title="Autor para la firma de la memoria">
                                <option value="">-- Seleccione --</option>
                                <option value="luis_m" {{ old('author') == 'luis_m' ? 'selected' : '' }}>LUIS MIR (ICLM)</option>
                                <option value="enrique_s" {{ old('author') == 'enrique_s' ? 'selected' : '' }}>ENRIQUEEE SEBASTIÁ (ICES)</option>
                                <option value="jaime_c" {{ old('author') == 'jaime_c' ? 'selected' : '' }}>JAIME CAMPOS (ICJC)</option>
                                <option value="marta_n" {{ old('author') == 'marta_n' ? 'selected' : '' }}>MARTA NAVARRO (ICMN)</option>
                                <option value="pepe_a" {{ old('author') == 'pepe_a' ? 'selected' : '' }}>PEPE ALCOVER (ICPA)</option>
                                <option value="oscar_a" {{ old('author') == 'oscar_a' ? 'selected' : '' }}>OSCAR ALONSO (ICOA)</option>
                            </select>
                            @error('author') <br>[ERROR]:{{ $message }} @enderror
                        </div>
                    
                        <div class="col-md-4">
                            <label class="form-label" for="budget_excel">Subir Excel:</label>
                            @if(session('temp_budget_excel'))
                                <p class="text-muted mt-2">Archivo ya subido: {{ basename(session('temp_budget_excel')) }}</p>
                            @endif
                            <input class="form-control" type="file" id="budget_excel" name="budget_excel" accept=".xlsx, .xls" data-bs-toggle="tooltip" title="Solo se acepta archivos .xls y .xlsx">
                            @error('budget_excel') <br>[ERROR]:{{ $message }} @enderror
                        </div>
                    </div>

                    <h5 class="mt-5 mb-3">Características</h5>
                    <div class="row mb-3">
                        <div class="col-md-7">
                            <label class="form-label" for="holder">Nombre del Titular:</label>
                            <input class="form-control" type="text" id="holder" name="holder" value="{{ old('holder') }}" data-bs-toggle="tooltip" title="Introduzca el nombre del titular">
                            @error('holder') <br>[ERROR]:{{ $message }} @enderror
                        </div>

                        <div class="col-md-5">
                            <label class="form-label" for="cover">Imagen (opcional):</label>
                            <input class="form-control" type="file" id="cover" name="cover" accept="image/*" data-bs-toggle="tooltip" title="Puede añadir una imagen">
                            @error('cover') <br>[ERROR]:{{ $message }} @enderror
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
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="name_agent">Representante:</label>
                        <input class="form-control" type="text" id="name_agent" name="name_agent" value="{{ old('name_agent') }}" data-bs-toggle="tooltip" title="Introduzca el nombre del representante">
                        @error('name_agent') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="nif">NIF del Representante:</label>
                        <input class="form-control" type="text" id="nif" name="nif" value="{{ old('nif') }}" data-bs-toggle="tooltip" title="Introduzca el NIF del representante">
                        @error('nif') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="location">Dirección del Emplazamiento:</label>
                        <input class="form-control" type="text" id="location" name="location" value="{{ old('location') }}" data-bs-toggle="tooltip" title="Introduzca la dirección del emplazamiento">
                        @error('location') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="cod_location">Código Postal del Emplazamiento:</label>
                        <input class="form-control" type="text" id="cod_location" name="cod_location" value="{{ old('cod_location') }}" data-bs-toggle="tooltip" title="Introduzca el código postal del emplazamiento">
                        @error('cod_location') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="name_location">Localidad del Emplazamiento:</label>
                        <input class="form-control" type="text" id="name_location" name="name_location" value="{{ old('name_location') }}" data-bs-toggle="tooltip" title="Introduzca la localidad del emplazamiento">
                        @error('name_location') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="build">Tipo de Local:</label>
                        <input class="form-control" type="text" id="build" name="build" value="{{ old('build') }}" data-bs-toggle="tooltip" title="Introduzca la actividad que se va realizar">
                        @error('build') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="kva">Potencia Instalada en KVA:</label>
                        <input class="form-control" step="0.01" type="number" id="kva" name="kva" value="{{ old('kva') }}" data-bs-toggle="tooltip" title="Introduzca la potencia en KVA">
                        @error('kva') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="kw">Potencia Instalada en KW:</label>
                        <input class="form-control" step="0.01" type="number" id="kw" name="kw" value="{{ old('kw') }}" data-bs-toggle="tooltip" title="Introduzca la potencia en KW">
                        @error('kw') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="tension_type">Tensión Simple y Compuesta en V:</label>
                        <select class="form-select" id="tension_type" name="tension_type" data-bs-toggle="tooltip" title="Seleccione el tipo de tensión">
                            <option value="">-- Seleccione --</option>
                            <option value="3F+N" {{ old('tension_type') == '3F+N' ? 'selected' : '' }}>3F+N (Trifásica)</option>
                            <option value="F+N" {{ old('tension_type') == 'F+N' ? 'selected' : '' }}>F+N (Monofásica)</option>
                        </select>
                        @error('tension_type') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="budget">Presupuesto Total de la Instalación:</label>
                        <input class="form-control" step="0.01" type="number" id="budget" name="budget" value="{{ old('budget') }}" data-bs-toggle="tooltip" title="Introduzca comas solo para los decimales">
                        @error('budget') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="type_clasi">Tipo de Clasificación:</label>
                        <select class="form-select" id="type_clasi" name="type_clasi" data-bs-toggle="tooltip" title="Seleccione el tipo de clasificación">
                            <option value="">-- Seleccione --</option>
                            <option value="mojado" {{ old('type_clasi') == 'mojado' ? 'selected' : '' }}>Tipo Mojado</option>
                            <option value="humedo" {{ old('type_clasi') == 'humedo' ? 'selected' : '' }}>Tipo Húmedo</option>
                            <option value="ambos" {{ old('type_clasi') == 'ambos' ? 'selected' : '' }}>Tipo Mojado y Húmedo</option>
                            <option value="noclasi" {{ old('type_clasi') == 'noclasi' ? 'selected' : '' }}>No Clasificado</option>
                        </select>
                        @error('type_clasi') <br>[ERROR]:{{ $message }} @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="mark">Marca:</label>
                        <input class="form-control" type="text" id="mark" name="mark" value="{{ old('mark') }}" data-bs-toggle="tooltip" title="Introduzca la marca">
                        @error('mark') <br>[ERROR]:{{ $message }} @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="model">Modelo:</label>
                            <input class="form-control" type="text" id="model" name="model" value="{{ old('model') }}" data-bs-toggle="tooltip" title="Introduzca el nombre del modelo">
                            @error('model') <br>[ERROR]:{{ $message }} @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="image_model">Imagen del Modelo:</label>
                            <input class="form-control" type="file" id="image_model" name="image_model" accept="image/*" data-bs-toggle="tooltip" title="Puede añadir una imagen del modelo">
                            @error('image_model') <br>[ERROR]:{{ $message }} @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="image_dimensions">Imagen de las Dimensiones:</label>
                            <input class="form-control" type="file" id="image_dimensions" name="image_dimensions" accept="image/*" data-bs-toggle="tooltip" title="Puede añadir una imagen de las dimensiones">
                            @error('image_dimensions') <br>[ERROR]:{{ $message }} @enderror
                        </div>
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label" for="voltage">Tensión de Servicio:</label>
                        <select class="form-select" id="voltage" name="voltage" data-bs-toggle="tooltip" title="Seleccione el tipo de tensión de servicio">
                            <option value="">-- Seleccione --</option>
                            <option value="3F+N" {{ old('voltage') == '3F+N' ? 'selected' : '' }}>400/230V (Trifásica)</option>
                            <option value="F+N" {{ old('voltage') == 'F+N' ? 'selected' : '' }}>230V (Monofásica)</option>
                        </select>
                        @error('voltage') <br>[ERROR]:{{ $message }} @enderror
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="air_entry">Entrada de Aire en m3/h:</label>
                            <input class="form-control" step="0.01" type="number" id="air_entry" name="air_entry" value="{{ old('air_entry') }}" data-bs-toggle="tooltip" title="Introduzca la entrada de aire en m3/h">
                            @error('air_entry') <br>[ERROR]:{{ $message }} @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="air_flow">Entrada de Flujo en m3/minuto:</label>
                            <input class="form-control" step="0.01" type="number" id="air_flow" name="air_flow" value="{{ old('air_flow') }}" data-bs-toggle="tooltip" title="Introduzca la entrada de aire en m3/minuto">
                            @error('air_flow') <br>[ERROR]:{{ $message }} @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="w">Potencia en W:</label>
                            <input class="form-control" step="0.01" type="number" id="w" name="w" value="{{ old('w') }}" data-bs-toggle="tooltip" title="Introduzca la potencia en W">
                            @error('w') <br>[ERROR]:{{ $message }} @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label" for="factor">Factor de Potencia del Grupo:</label>
                            <input class="form-control" step="0.01" type="number" id="factor" name="factor" value="{{ old('factor') }}" data-bs-toggle="tooltip" title="Introduzca el factor de potencia">
                            @error('factor') <br>[ERROR]:{{ $message }} @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="method">Método de Refrigeración:</label>
                        <textarea class="form-control" id="method" name="method" rows="3" data-bs-toggle="tooltip" title="Método de refrigeración del grupo electrógeno">El sistema de refrigeración lo conforma un radiador con ventilador soplante y protecciones adecuadas, diseñados para refrigerar el motor en temperaturas ambientes de hasta 50 º C, incluyendo grifo de vaciado, incorporará liquido anticongelante.</textarea>
                        @error('method') <br>[ERROR]: {{ $message }} @enderror
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
