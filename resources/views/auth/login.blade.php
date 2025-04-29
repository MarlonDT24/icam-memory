@extends('layout')

@section('title', 'Login Privado')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm p-4">
                    <h1 class="text-center mb-4">ICAM S.L</h1>
                    <img src="/img/icam_icon.png" alt="logo" width="65" class="d-block mx-auto mb-3">
                
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li >{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                
                    <form action="{{ route('login') }}" method="post" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Usuario:</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input">
                            <label for="remember" class="form-check-label">Recordar usuario</label>
                        </div>
                
                        <div class="d-grid">
                            <button type="submit" class="btn btn-transition btn-primary">Iniciar Sesión</button>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>

    </div>
@endsection