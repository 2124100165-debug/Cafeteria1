@extends('Layouts.app')

@section('titulo', 'Registrar Personal - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-black text-white border-dorado-kraneo border-2 shadow-lg">
                <div class="card-header border-bottom border-dorado-kraneo text-center py-3">
                    <h3 class="text-dorado-kraneo mb-0">Crear Nuevo Personal</h3>
                </div>
                <div class="card-body p-4">

                    {{-- Mostrar alertas de error de validación (Ej: Si los correos no coinciden) --}}
                    @if ($errors->any())
                        <div class="alert alert-danger bg-dark text-danger border-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    {{-- CRÍTICO: enctype="multipart/form-data" para permitir la subida de archivos JPG/PNG --}}
                    <form action="{{ route('administrador.guardar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label text-dorado-kraneo fw-bold">Nombres</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="nombres" name="nombres" value="{{ old('nombres') }}" placeholder="Ej. Carlos" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label text-dorado-kraneo fw-bold">Apellidos</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" placeholder="Ej. Mendoza" required>
                            </div>
                        </div>

                        {{--  DOBLE CONFIRMACIÓN DE CORREO --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-dorado-kraneo fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" value="{{ old('email') }}" placeholder="carlos@kraneocafe.com" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email_confirmation" class="form-label text-dorado-kraneo fw-bold">Confirmar Correo Electrónico</label>
                                <input type="email" class="form-control bg-dark text-white border-secondary" id="email_confirmation" name="email_confirmation" placeholder="Repite tu correo electrónico" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="usuario" class="form-label text-dorado-kraneo fw-bold">Nombre de Usuario</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="usuario" name="usuario" value="{{ old('usuario') }}" placeholder="Ej. cmendoza" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="rol" class="form-label text-dorado-kraneo fw-bold">Rol o Puesto</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="rol" name="rol" value="{{ old('rol') }}" placeholder="Ej: Barista, Mesero" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label text-dorado-kraneo fw-bold">Contraseña</label>
                                <input type="password" class="form-control bg-dark text-white border-secondary" id="password" name="password" placeholder="********" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label text-dorado-kraneo fw-bold">Confirmar Contraseña</label>
                                <input type="password" class="form-control bg-dark text-white border-secondary" id="password_confirmation" name="password_confirmation" placeholder="********" required>
                            </div>
                        </div>

                        {{--  CARGA DUAL DE FOTOGRAFÍA --}}
                        <div class="card bg-dark border-secondary p-3 mb-3">
                            <h5 class="text-dorado-kraneo mb-3"><i class="bi bi-image"></i> Fotografía del Personal</h5>
                            <div class="row">
                                {{-- Opción A: Subir archivo --}}
                                <div class="col-md-6 mb-3">
                                    <label for="foto_archivo" class="form-label text-white-50 small">Opción 1: Subir imagen (JPG, JPEG, PNG)</label>
                                    <input type="file" class="form-control bg-black text-white border-secondary" id="foto_archivo" name="foto_archivo" accept=".jpg,.jpeg,.png">
                                </div>
                                {{-- Opción B: Pegar URL --}}
                                <div class="col-md-6 mb-3">
                                    <label for="foto_url" class="form-label text-white-50 small">Opción 2: Enlace / URL de la imagen</label>
                                    <input type="url" class="form-control bg-black text-white border-secondary" id="foto_url" name="foto_url" placeholder="https://ejemplo.com/foto.jpg">
                                </div>
                            </div>
                        </div>

                        <hr class="border-secondary my-4">
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                            <a href="{{ route('administrador.index') }}" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold text-black">Guardar Personal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection