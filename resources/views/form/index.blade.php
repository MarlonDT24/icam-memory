@extends('layout')

@section('title', 'Inicio')

@section('content')

    <div class="container">
        <!-- Header -->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">GENERADOR DE MEMORIAS</h1>
                    @if ($forms->isEmpty() && $groupElectro->isEmpty())
                        <p class="lead fw-normal text-white-50 mb-4">No existen memorias para mostrar</p>
                    @endif
                </div>
            </div>
        </header>

        <!-- Selector de tipo de memoria -->
        <h2 class="mt-5 text-center">Seleccione el tipo de memoria:</h2>
        <section class="py-4 mt-3">
            <div class="row text-center mb-5">
                <div class="col-md-4 mb-3">
                    <a href="{{ route('form.create') }}" class="btn btn-danger btn-lg w-100">Tipo: COMPATIBILIDAD</a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ route('lowVoltage.create') }}" class="btn btn-danger btn-lg w-100">Tipo: BAJA TENSIÓN</a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ route('groupElectro.create') }}" class="btn btn-danger btn-lg w-100">Tipo: GRUPO ELECTRÓGENO</a>
                </div>
            </div>
        </section>

        <!-- Historial de Compatibilidad -->
        <section class="py-5">
            <h2 class="text-center mb-4">Historial de Memorias de Compatibilidad</h2>
            @if ($forms->isEmpty())
                <p class="text-center text-muted">No existen memorias de compatibilidad para mostrar.</p>
            @else
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 justify-content-center">
                    @foreach ($forms as $form)
                        <div class="col mb-5">
                            <div class="card card-hover">
                                <img class="card-img-top" src="{{ asset('img/document.jpg') }}" alt="Imagen del documento">
                                <div class="card-body p-4 text-center">
                                    <h5 class="fw-bolder">
                                        <a href="{{ route('form.show', $form->id) }}" class="text-decoration-none">
                                            {{ $form->name }}
                                        </a>
                                    </h5>
                                    <h6 class="fw-bolder">Fecha de Creación</h6>
                                    <p class="text-muted">{{ $form->created_at->format('d/m/Y') }}</p>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex flex-column align-items-center gap-2">
                                    <a class="btn btn-success" href="{{ route('form.show', $form->id) }}">Ver Más Detalles</a>
                                    <a class="btn btn-primary" href="{{ route('form.edit', $form->id) }}">Editar</a>
                                    <form action="{{ route('form.destroy', $form->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Eliminar" class="btn btn-secondary btn-outline-dark">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Historial de Baja Tensión -->
        <section class="py-5">
            <h2 class="text-center mb-4">Historial de Memorias de Baja Tensión</h2>
            @if ($forms->isEmpty())
                <p class="text-center text-muted">No existen memorias de baja tensión para mostrar.</p>
            @else
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 justify-content-center">
                    @foreach ($forms as $form)
                        <div class="col mb-5">
                            <div class="card card-hover">
                                <img class="card-img-top" src="{{ asset('img/document.jpg') }}" alt="Imagen del documento">
                                <div class="card-body p-4 text-center">
                                    <h5 class="fw-bolder">
                                        <a href="{{ route('form.show', $form->id) }}" class="text-decoration-none">
                                            {{ $form->name }}
                                        </a>
                                    </h5>
                                    <h6 class="fw-bolder">Fecha de Creación</h6>
                                    <p class="text-muted">{{ $form->created_at->format('d/m/Y') }}</p>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex flex-column align-items-center gap-2">
                                    <a class="btn btn-success" href="{{ route('form.show', $form->id) }}">Ver Más Detalles</a>
                                    <a class="btn btn-primary" href="{{ route('form.edit', $form->id) }}">Editar</a>
                                    <form action="{{ route('form.destroy', $form->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Eliminar" class="btn btn-secondary btn-outline-dark">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Historial de Grupo Electrógeno -->
        <section class="py-5">
            <h2 class="text-center mb-4">Historial de Memorias de Grupo Electrógeno</h2>
            @if ($groupElectro->isEmpty())
                <p class="text-center text-muted">No existen memorias de grupo electrógeno para mostrar.</p>
            @else
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-5 justify-content-center">
                    @foreach ($groupElectro as $group)
                        <div class="col mb-5">
                            <div class="card card-hover">
                                <img class="card-img-top" src="{{ asset('img/document.jpg') }}" alt="Imagen del documento">
                                <div class="card-body p-4 text-center">
                                    <h5 class="fw-bolder">
                                        <a href="{{ route('groupElectro.show', $group->id) }}" class="text-decoration-none">
                                            {{ $group->name }}
                                        </a>
                                    </h5>
                                    <h6 class="fw-bolder">Fecha de Creación</h6>
                                    <p class="text-muted">{{ $group->created_at->format('d/m/Y') }}</p>
                                </div>
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent d-flex flex-column align-items-center gap-2">
                                    <a class="btn btn-success" href="{{ route('groupElectro.show', $group->id) }}">Ver Más Detalles</a>
                                    <a class="btn btn-primary" href="{{ route('groupElectro.edit', $group->id) }}">Editar</a>
                                    <form action="{{ route('groupElectro.destroy', $group->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Eliminar" class="btn btn-secondary btn-outline-dark">
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

    </div>
@endsection
