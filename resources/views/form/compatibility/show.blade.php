@extends('layout')

@section('title', $form->name)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white justify-content-between align-items-center">
            <h2 class="mb-3">MEMORIA: {{ $form->name }}</h2>
        </div>
        
        <div class="card-body">

            <ul class="list-group mb-4">
                <h5 class="mt-2">Titular</h5>
                <li class="list-group-item">
                <strong class="d-block mb-2">Nombre del Titular:</strong>
                <div class="d-flex flex-column flex-md-row align-items-start justify-content-between gap-3">
                    <div class="formatted-text w-100">
                        {!! nl2br(e($form->holder)) !!}
                    </div>
                    
                    @if ($form->cover)
                    <div class="text-end">
                        <img src="{{ asset('storage/covers/' . basename($form->cover)) }}" alt="Portada actual" style="max-width: 200px;">
                        </div>
                        @endif
                </div>
            </li>
            
            <li class="list-group-item">
                <strong>Dirección Fiscal:</strong>
                <div class="formatted-text">{!! nl2br(e($form->address)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Código Postal:</strong>
                <div class="formatted-text">{!! nl2br(e($form->cod_address)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>CIF del Titular:</strong>
                <div class="formatted-text">{!! nl2br(e($form->cif)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Representante:</strong>
                <div class="formatted-text">{!! nl2br(e($form->name_agent)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>NIF del Representante:</strong>
                <div class="formatted-text">{!! nl2br(e($form->nif)) !!}</div>
            </li>
            
            <h5 class="mt-4">Emplazamiento</h5>
            <li class="list-group-item">
                <strong>Dirección del Emplazamiento:</strong>
                <div class="formatted-text">{!! nl2br(e($form->location)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Código Postal del Emplazamiento:</strong>
                <div class="formatted-text">{!! nl2br(e($form->cod_location)) !!}</div>
            </li>
            
            <h5 class="mt-4">Actividad</h5>
            <li class="list-group-item">
                <strong>Actividad a realizar:</strong>
                <div class="formatted-text">{!! nl2br(e($form->activity)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Descripción de la Actividad:</strong>
                <div class="formatted-text">{!! nl2br(e($form->description)) !!}</div>
            </li>
            
            <h5 class="mt-4">Necesidades de uso y Aprovechamiento del Suelo:</h5>
            <li class="list-group-item">
                <strong>Metros Cuadrados de la Parcela:</strong>
                <div class="formatted-text">{!! nl2br(e($form->m_parcels)) !!}</div>
            </li>
            
            <li class="list-group-item">
                <strong>Metros Cuadrados de la Superficie Edificada:</strong>
                <div class="formatted-text">{!! nl2br(e($form->m_surface)) !!}</div>
            </li>
            
            <h5 class="mt-4">Requerimientos de la Instalación respecto a los Servicios Públicos Municipales:</h5>
            <li class="list-group-item">
                <div class="formatted-text">
                    La instalación requiere de los servicios básicos de cualquier nave industrial. Estos servicios son los siguientes:<br><br>
                    • Conexión con red de agua municipal.<br>
                    • Conexión con red de alcantarillado.<br>
                    • Servicio de recogida de basuras.<br><br>
                    También se requiere conexión con la red eléctrica de Baja Tensión, aunque este servicio depende de la Compañía Suministradora.
                </div>
            </li>
        </ul>
        
        <!-- Botones de acciones -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('form.convertToWord', $form) }}" class="btn btn-success">Descargar en Word</a>
            <a href="{{ route('form.edit', $form->id) }}" class="btn btn-primary">Editar</a>
            <a href="{{ route('form.index', $form->id) }}" class="btn btn-secondary">Volver</a>
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
