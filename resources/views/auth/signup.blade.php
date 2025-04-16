@extends('layout')

@section('title', 'Registro')

@section('content')
    <div class="container">
        <h1 class="mb-4">Registro de usuario</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('signup') }}" method="post" class="needs-validation">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Usuario:</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Repita la Contraseña:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-transition btn-primary">Registrarse</button>
        </form>
    </div>
@endsection
