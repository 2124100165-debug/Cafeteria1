@extends('Layouts.app')

@section('titulo', 'Iniciar Sesión - Kraneo Café')

@section('contenido')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card bg-black text-white border-dorado-kraneo border-2 shadow-lg">
                <div class="card-header border-bottom border-dorado-kraneo text-center py-4">
                    <h3 class="text-dorado-kraneo mb-0 font-montserrat fw-bold"><i class="bi bi-shield-lock-fill"></i> Acceso Administrativo</h3>
                </div>
                <div class="card-body p-4">
                    
                    {{-- Mostrar alertas de error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger bg-dark text-danger border-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="usuario" class="form-label text-dorado-kraneo fw-bold">Usuario</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-dorado-kraneo"><i class="bi bi-person-fill"></i></span>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="usuario" name="usuario" value="{{ old('usuario') }}" placeholder="Ingresa tu usuario" required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="contraseña" class="form-label text-dorado-kraneo fw-bold">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-dorado-kraneo"><i class="bi bi-key-fill"></i></span>
                                <input type="password" class="form-control bg-dark text-white border-secondary" id="contraseña" name="contraseña" placeholder="Ingresa tu contraseña" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-warning fw-bold text-black py-2"><i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilos personalizados para combinar con el diseño premium */
    .border-dorado-kraneo {
        border-color: #d4af37 !important; /* Dorado Kraneo */
    }
    .text-dorado-kraneo {
        color: #d4af37 !important;
    }
    .bg-black {
        background-color: #0b0c10 !important;
    }
    .btn-warning {
        background-color: #d4af37 !important;
        border-color: #d4af37 !important;
    }
    .btn-warning:hover {
        background-color: #bfa030 !important;
        border-color: #bfa030 !important;
    }
</style>
@endsection
