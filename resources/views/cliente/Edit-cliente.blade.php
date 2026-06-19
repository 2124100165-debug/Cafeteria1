@extends('Layouts.app')

@section('titulo', 'Editar Cliente - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="card bg-dark text-white border-dorado-kraneo shadow-lg">
        <div class="card-header border-bottom border-dorado-kraneo bg-black py-3">
            <h3 class="text-dorado-kraneo mb-0">Editar Cliente: {{ $cliente->nombres }}</h3>
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

            <form action="{{ route('cliente.actualizar', $cliente->id_cliente) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    {{-- Columna Izquierda: Foto Actual y Selector de Archivo (Estructura idéntica a la vista de Ver) --}}
                    <div class="col-md-3 text-center mb-4">
                        <label class="text-dorado-kraneo fw-bold d-block mb-2">Fotografía Actual</label>
                        <img src="{{ $cliente->imagen ? $cliente->imagen : url('storage/imagenes/clientes/producto_default.jpg') }}" 
                             class="img-fluid rounded border border-dorado-kraneo shadow mb-3" 
                             style="max-width: 200px; object-fit: cover;" alt="Foto de Perfil">
                        
                        <div class="text-start mt-2">
                            <label for="imagen" class="form-label text-white-50 small fw-bold">Subir nueva foto (Opcional):</label>
                            {{-- RÚBRICA: Tipo file, SIN required en editar --}}
                            <input type="file" name="imagen" id="imagen" class="form-control bg-black text-white border-secondary small" accept=".jpg,.jpeg,.png">
                        </div>
                    </div>

                    {{-- Columna Derecha: Formulario con Campos Editables (Ordenados en rejilla) --}}
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label text-dorado-kraneo fw-bold">Nombres</label>
                                <input type="text" id="nombres" name="nombres" class="form-control bg-black text-white border-secondary" value="{{ old('nombres', $cliente->nombres) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label text-dorado-kraneo fw-bold">Apellidos</label>
                                <input type="text" id="apellidos" name="apellidos" class="form-control bg-black text-white border-secondary" value="{{ old('apellidos', $cliente->apellidos) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label text-dorado-kraneo fw-bold">Correo Electrónico</label>
                                <input type="email" id="email" name="email" class="form-control bg-black text-white border-secondary" value="{{ old('email', $cliente->email) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label text-dorado-kraneo fw-bold">Nueva Contraseña</label>
                                <input type="password" id="password" name="password" class="form-control bg-black text-white border-secondary" placeholder="Opcional">
                                <small class="text-secondary">Deja en blanco para no cambiar</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label text-dorado-kraneo fw-bold">Confirmar Contraseña</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control bg-black text-white border-secondary" placeholder="Repetir contraseña">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label text-dorado-kraneo fw-bold">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" class="form-control bg-black text-white border-secondary" value="{{ old('telefono', $cliente->telefono) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="direccion" class="form-label text-dorado-kraneo fw-bold">Dirección</label>
                                <input type="text" id="direccion" name="direccion" class="form-control bg-black text-white border-secondary" value="{{ old('direccion', $cliente->direccion) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label text-dorado-kraneo fw-bold">Estado</label>
                            <select id="estado" name="estado" class="form-select bg-black text-white border-secondary" required>
                                <option value="Activo" {{ old('estado', $cliente->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado', $cliente->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Botones de Acción inferiores coincidentes con el diseño --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary fw-bold text-white">
                        <i class="bi bi-house-door"></i> Inicio
                    </a>
                    <button type="submit" class="btn btn-warning fw-bold text-black">
                        <i class="bi bi-check-circle"></i> Actualizar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection