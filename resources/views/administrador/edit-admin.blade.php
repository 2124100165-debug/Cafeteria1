@extends('Layouts.app')

@section('titulo', 'Editar Personal - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="card bg-dark text-white border-dorado-kraneo shadow-lg">
        <div class="card-header border-bottom border-dorado-kraneo bg-black py-3">
            <h3 class="text-dorado-kraneo mb-0">Editar Personal: {{ $administrador->nombres }}</h3>
        </div>
        
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger bg-black text-danger border-danger mb-4">
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
                    {{-- Columna Izquierda: Foto Actual y Selector de Archivo (Guiado del diseño de ver) --}}
                    <div class="col-md-3 text-center mb-4">
                        <label class="text-dorado-kraneo fw-bold d-block mb-2">Fotografía Actual</label>
                        <img src="{{ $administrador->imagen_url ? $administrador->imagen_url : url('storage/imagenes/personal/producto_default.jpg') }}" 
                             class="img-fluid rounded border border-dorado-kraneo shadow mb-3" 
                             style="max-width: 200px; object-fit: cover;" alt="Foto de Perfil">
                        
                        <div class="text-start mt-2">
                            <label for="foto_archivo" class="form-label text-white-50 small fw-bold">Subir nueva foto (Opcional):</label>
                            {{-- RÚBRICA: Tipo file, SIN required en editar --}}
                            <input type="file" class="form-control bg-black text-white border-secondary small" id="foto_archivo" name="foto_archivo" accept=".jpg,.jpeg,.png">
                        </div>
                    </div>

                    {{-- Columna Derecha: Formulario con Campos Editables (Guiado del diseño de ver) --}}
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label text-dorado-kraneo fw-bold">Nombres</label>
                                <input type="text" class="form-control bg-black text-white border-secondary" id="nombres" name="nombres" value="{{ old('nombres', $administrador->nombres) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label text-dorado-kraneo fw-bold">Apellidos</label>
                                <input type="text" class="form-control bg-black text-white border-secondary" id="apellidos" name="apellidos" value="{{ old('apellidos', $administrador->apellidos) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="usuario" class="form-label text-dorado-kraneo fw-bold">Usuario</label>
                                <input type="text" class="form-control bg-black text-white border-secondary" id="usuario" name="usuario" value="{{ old('usuario', $administrador->usuario) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-dorado-kraneo fw-bold">Email</label>
                                <input type="email" class="form-control bg-black text-white border-secondary" id="email" name="email" value="{{ old('email', $administrador->email) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="rol" class="form-label text-dorado-kraneo fw-bold">Rol</label>
                                <input type="text" class="form-control bg-black text-white border-secondary" id="rol" name="rol" value="{{ old('rol', $administrador->rol) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="estado" class="form-label text-dorado-kraneo fw-bold">Estado</label>
                                <select name="estado" id="estado" class="form-select bg-black text-white border-secondary" required>
                                    <option value="Activo" {{ old('estado', $administrador->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('estado', $administrador->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="password" class="form-label text-dorado-kraneo fw-bold">Nueva Contraseña (Opcional)</label>
                                <input type="password" class="form-control bg-black text-white border-secondary" id="password" name="password" placeholder="Solo llenar si desea cambiarla">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botones de Acción en la parte inferior derecha --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('administrador.index') }}" class="btn btn-outline-secondary fw-bold text-white">
                        <i class="bi bi-house-door"></i> Inicio
                    </a>
                    <button type="submit" class="btn btn-warning fw-bold text-black">
                        <i class="bi bi-check-circle"></i> Actualizar Datos
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection