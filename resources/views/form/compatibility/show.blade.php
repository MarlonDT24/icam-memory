@extends('layout')

@section('title', $form->name)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white">
            <h2 class="mb-3 mt-2">MEMORIA: {{ $form->name }}</h2>
        </div>

        <div class="card-body">
            <!-- Titular -->
            <h5 class="mt-4 border-bottom pb-2">Titular</h5>
            <div class="list-group mb-4 rounded shadow-sm">
                <div class="list-group-item bg-transparent">
                    <strong>Nombre del Titular:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->holder)) !!}</div>
                </div>
                <div class="list-group-item bg-transparent">
                    <strong>Dirección Fiscal:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->address)) !!}</div>
                </div>
                <div class="list-group-item bg-transparent">
                    <strong>Código Postal:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->cod_address)) !!}</div>
                </div>
                <div class="list-group-item bg-transparent">
                    <strong>CIF del Titular:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->cif)) !!}</div>
                </div>
                <div class="list-group-item bg-transparent">
                    <strong>Representante:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->name_agent)) !!}</div>
                </div>
                <div class="list-group-item bg-transparent">
                    <strong>NIF del Representante:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->nif)) !!}</div>
                </div>
            </div>

            <!-- Emplazamiento -->
            <h5 class="mt-4 border-bottom pb-2">Emplazamiento</h5>
            <div class="list-group mb-4 rounded shadow-sm">
                <div class="list-group-item bg-transparent">
                    <strong>Dirección del Emplazamiento:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->location)) !!}</div>
                </div>
                <div class="list-group-item bg-transparent">
                    <strong>Código Postal del Emplazamiento:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->cod_location)) !!}</div>
                </div>
            </div>

            <!-- Actividad -->
            <h5 class="mt-4 border-bottom pb-2">Actividad</h5>
            <div class="list-group mb-4 rounded shadow-sm">
                <div class="list-group-item bg-transparent">
                    <strong>Actividad a realizar:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->activity)) !!}</div>
                </div>
                <div class="list-group-item bg-transparent">
                    <strong>Descripción de la Actividad:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->description)) !!}</div>
                </div>
            </div>

            <!-- Superficie -->
            <h5 class="mt-4 border-bottom pb-2">Necesidades de uso y Aprovechamiento del Suelo</h5>
            <div class="list-group mb-4 rounded shadow-sm">
                <div class="list-group-item bg-transparent">
                    <strong>Metros Cuadrados de la Parcela:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->m_parcels)) !!}</div>
                </div>
                <div class="list-group-item bg-transparent">
                    <strong>Metros Cuadrados de la Superficie Edificada:</strong>
                    <div class="formatted-text">{!! nl2br(e($form->m_surface)) !!}</div>
                </div>
            </div>

            <!-- Requerimientos -->
            <h5 class="mt-4 border-bottom pb-2">Requerimientos de la Instalación respecto a los Servicios Públicos Municipales</h5>
            <div class="list-group mb-4 rounded shadow-sm">
                <div class="list-group-item bg-transparent">
                    <div class="formatted-text">
                        La instalación requiere de los servicios básicos de cualquier nave industrial. Estos servicios son los siguientes:<br><br>
                        • Conexión con red de agua municipal.<br>
                        • Conexión con red de alcantarillado.<br>
                        • Servicio de recogida de basuras.<br><br>
                        También se requiere conexión con la red eléctrica de Baja Tensión, aunque este servicio depende de la Compañía Suministradora.
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex flex-wrap gap-2 mt-4">
                <a href="{{ route('form.convertToWord', $form) }}" class="btn btn-success">Descargar en Word</a>
                <a href="{{ route('form.edit', $form->id) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('form.index', $form->id) }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>
@endsection