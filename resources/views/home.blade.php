@extends('layout')

@section('title', 'Inicio')

@section('content')
<div class="container py-5">
    <div class="text-center text-white mb-5">
        <h1 class="display-4 fw-bold">Bienvenido, {{ Auth::user()->name ?? 'Usuario' }}</h1>
        <p class="lead text-white-50">Selecciona una herramienta para comenzar</p>
    </div>

    <div class="row justify-content-center g-4">
        <!-- Generador de Memorias -->
        <div class="col-md-5">
            <div class="card h-100 shadow-lg border-0">
                <div class="card-body text-center p-5">
                    <img src="{{ asset('img/generadorimg.png') }}" alt="Generador de Memorias" class="mb-4" width="80">
                    <h4 class="fw-bold">Generador de Memorias</h4>
                    <p class="text-muted">Crea memorias mediante un formulario y descárgalas en Word.</p>
                    <a href="{{ route('form.index') }}" class="btn btn-danger btn-lg mt-3">Generar Memoria</a>
                </div>
            </div>
        </div>

        <!-- PCI Manager -->
        <div class="col-md-5">
            <div class="card h-100 shadow-lg border-0">
                <div class="card-body text-center p-5">
                    <img src="{{ asset('img/pcimanagerimg.png') }}" alt="PCI Manager" class="mb-4" width="80">
                    <h4 class="fw-bold">PCI Manager</h4>
                    <p class="text-muted">Determina medidas contra incendios según el tipo de edificación.</p>
                    <a href="{{ route('pci.index') }}" class="btn btn-danger btn-lg mt-3">Acceder a PCI Manager</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
