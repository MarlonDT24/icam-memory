@extends('layout')

@section('title', $groupElectro->name)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white justify-content-between align-items-center">
            <h2 class="mb-3">MEMORIA: {{ $groupElectro->name }}</h2>
        </div>
        
        <div class="card-body">

            <ul class="list-group mb-4">
                <h5 class="mt-2">Caracterísicas</h5>
                <li class="list-group-item">
                <strong class="d-block mb-2">Nombre del Titular:</strong>
                <div class="d-flex flex-column flex-md-row align-items-start justify-content-between gap-3">
                    <div class="formatted-text w-100">
                        {!! nl2br(e($groupElectro->holder)) !!}
                    </div>
                    
                    @if ($groupElectro->cover)
                        <div class="text-end">
                            <img src="{{ asset('storage/covers/' . basename($groupElectro->cover)) }}" alt="Portada actual" style="max-width: 200px;">
                        </div>
                    @endif
                </div>
                </li>
            <li class="list-group-item">
                <strong>Dirección Fiscal:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->address)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Código Postal:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->cod_address)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>CIF del Titular:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->cif)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Representante:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->name_agent)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>NIF del Representante:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->nif)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Dirección del Emplazamiento:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->location)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Código Postal del Emplazamiento:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->cod_location)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Localidad del Emplazamiento:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->name_location)) !!}</div>
            </li>

            <li class="list-group-item">
                <strong>Tipo de Local:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->build)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Potencia Instalada en KVA:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->kva)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Potencia Instalada en KW:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->kw)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Tensión Simple y Compuesta en V:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->tension_type)) !!}</div>
            </li>

            <li class="list-group-item">
                <strong>Presupuesto Total de la Instalación:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->budget)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Tipo de Clasificación:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->type_clasi)) !!}</div>
            </li>

            <li class="list-group-item">
                <strong>Marca:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->mark)) !!}</div>
            </li>

            <li class="list-group-item">
                <strong>Modelo:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->model)) !!}</div>
            </li>

            <li class="list-group-item">
                <strong>Imagen del Modelo:</strong>
                <div class="mb-2">
                    <img src="{{ asset('storage/imagemodels/' . basename($groupElectro->image_model)) }}" alt="imagen del modelo"
                        width="200px">
                </div>
            </li>

            <li class="list-group-item">
                <strong>Imagen de las Dimensiones:</strong>
                <div class="mb-2">
                    <img src="{{ asset('storage/imagedimensions/' . basename($groupElectro->image_dimensions)) }}" alt="imagen de las dimensiones"
                        width="200px">
                </div>
            </li>

            <li class="list-group-item">
                <strong>Tensión de Servicio:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->voltage)) !!}</div>
            </li>

            <li class="list-group-item">
                <strong>Entrada de Aire en m3/h:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->air_entry)) !!}</div>
            </li>

            <li class="list-group-item">
                <strong>Entrada de Flujo en m3/minuto:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->air_flow)) !!}</div>
            </li>

            <li class="list-group-item">
                <strong>Potencia en W:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->w)) !!}</div>
            </li>

            <li class="list-group-item">
                <strong>Factor de Potencia del Grupo:</strong>
                <div class="formatted-text">{!! nl2br(e($groupElectro->factor)) !!}</div>
            </li>
        </ul>
        
        <!-- Botones de acciones -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('groupElectro.convertToWord', $groupElectro) }}" class="btn btn-success">Descargar en Word</a>
            <a href="{{ route('groupElectro.edit', $groupElectro->id) }}" class="btn btn-primary">Editar</a>
            <a href="{{ route('form.index', $groupElectro->id) }}" class="btn btn-secondary">Volver</a>
        </div>
        
        {{-- <!-- Vista previa en PDF (Posible implementación a futuro)-->
        <div class="mb-5">
            <h4>Vista previa en PDF:</h4>
            <iframe src="{{ route('form.convert.pdf', $form) }}" width="100%" height="600px" style="border: 1px solid #ccc;"></iframe>
        </div> --}}
        
        <!-- Historial de versiones (Posible implementación a futuro) -->
        {{-- <div class="card mt-5">
            <div class="card-header">
                <strong>Historial de versiones (futuro)</strong>
            </div>
            <div class="card-body">
                <p>Este espacio se usará para mostrar versiones anteriores del formulario y sus respectivas plantillas.</p>
            </div>
        </div> --}}
        </div>
    </div>
</div>
@endsection
