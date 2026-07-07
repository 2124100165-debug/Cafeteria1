@extends('Layouts.app')

@section('titulo', 'Editar Personal - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-black text-white border-dorado-kraneo border-2 shadow-lg">
                <div class="card-header border-bottom border-dorado-kraneo text-center py-3">
                    <h3 class="text-dorado-kraneo mb-0">Editar Personal: {{ $administrador->nombres }}</h3>
                </div>
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger bg-dark text-danger border-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('administrador.actualizar', $administrador->id_admin) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label text-dorado-kraneo fw-bold">Nombres</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="nombres" name="nombres" value="{{ old('nombres', $administrador->nombres) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label text-dorado-kraneo fw-bold">Apellidos</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="apellidos" name="apellidos" value="{{ old('apellidos', $administrador->apellidos) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-dorado-kraneo fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" value="{{ old('email', $administrador->email) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="usuario" class="form-label text-dorado-kraneo fw-bold">Nombre de Usuario</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="usuario" name="usuario" value="{{ old('usuario', $administrador->usuario) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rol" class="form-label text-dorado-kraneo fw-bold">Rol o Puesto</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="rol" name="rol" value="{{ old('rol', $administrador->rol) }}" required>
                            </div>
                            
                            {{-- CORREGIDO: Cambiado de 'estado' a 'activo' usando valores enteros (1 y 0) --}}
                            <div class="col-md-6 mb-3">
                                <label for="activo" class="form-label text-dorado-kraneo fw-bold">Estado</label>
                                <select name="activo" id="activo" class="form-select bg-dark text-white border-secondary" required>
                                    <option value="1" {{ old('activo', $administrador->activo) == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('activo', $administrador->activo) == 0 ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="password" class="form-label text-dorado-kraneo fw-bold">Nueva Contraseña (Opcional)</label>
                                <input type="password" class="form-control bg-dark text-white border-secondary" id="password" name="password" placeholder="Solo llenar si desea cambiarla">
                            </div>
                        </div>

                        {{-- SECCIÓN DE FOTOGRAFÍA --}}
                        <div class="card bg-dark border-secondary p-3 mb-3">
                            <h5 class="text-dorado-kraneo mb-3"><i class="bi bi-image"></i> Actualizar Fotografía</h5>
                            @if($administrador->imagen_url)
                                <div class="mb-2">
                                    <small class="text-white-50">Imagen actual:</small><br>
                                    <img src="{{ asset($administrador->imagen_url) }}" alt="Perfil" width="60" class="rounded-circle border border-warning m-1">
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="foto_archivo" class="form-label text-white-50 small">Subir nueva imagen:</label>
                                    <input type="file" class="form-control bg-black text-white border-secondary" id="foto_archivo" name="foto_archivo" accept=".jpg,.jpeg,.png">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="foto_url" class="form-label text-white-50 small">O cambiar URL:</label>
                                    {{-- OPTIMIZADO: Solo muestra la URL si empieza con http/https, evitando pintar rutas locales como /storage/... --}}
                                    <input type="url" class="form-control bg-black text-white border-secondary" id="foto_url" name="foto_url" 
                                           value="{{ str_starts_with($administrador->imagen_url, 'http') ? old('foto_url', $administrador->imagen_url) : old('foto_url') }}" 
                                           placeholder="https://ejemplo.com/foto.jpg">
                                </div>
                            </div>
                        </div>

                        <hr class="border-secondary my-4">
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                            <a href="{{ route('administrador.index') }}" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold text-black">Actualizar Datos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection