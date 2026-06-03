@extends('Layouts.app')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8">

        {{-- Encabezado de la página --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-warning mb-0 fw-bold">Nueva Categoría</h2>
                {{-- Subtítulo con color dorado optimizado --}}
                <p class="mb-0" style="color: #d4af37; opacity: 0.9; font-size: 0.95rem;">
                    Registra las secciones del menú de Kraneo Café
                </p>
            </div>
            <div>
                {{-- Nota: Ajusta a 'categorias.index' si manejas el nombre en plural --}}
                <a href="{{ route('categorias.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Ver Listado
                </a>
            </div>
        </div>

        {{-- Tarjeta del Formulario --}}
        <div class="card bg-dark text-white shadow-lg border-secondary rounded-3">
            <div class="card-body p-4 p-md-5">
                
                {{-- Mostrar alertas de validación si algo falla --}}
                @if ($errors->any())
                    <div class="alert alert-danger bg-black text-danger border-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{-- 🛠️ CORREGIDO: Método POST obligatorio y acción apuntando a guardar --}}
                <form method="POST" action="{{ route('categorias.guardar') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-3">
                        {{-- 1. Nombre de la Categoría --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-warning">Nombre de la Categoría</label>
                            <input type="text" name="nombre_categoria" class="form-control bg-secondary text-white border-0" value="{{ old('nombre_categoria') }}" placeholder="Ej. Bebidas Heladas" required>
                        </div>

                        {{-- 2. Imagen (Subida o URL) --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-warning">Imagen de la Categoría</label>
                            <div class="input-group">
                                {{-- name="foto_archivo" para que lo detecte tu controlador --}}
                                <input type="file" name="foto_archivo" class="form-control bg-secondary text-white border-0" accept="image/*">
                            </div>
                            <small class="text-white-50 mt-1 d-block">O ingresa una URL: 
                                {{-- name="foto_url" para la vía de internet --}}
                                <input type="text" name="foto_url" class="form-control bg-secondary text-white border-0 mt-1" value="{{ old('foto_url') }}" placeholder="https://ejemplo.com/imagen.jpg">
                            </small>
                        </div>

                        {{-- 3. Descripción --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold text-warning">Descripción</label>
                            <textarea name="descripcion" rows="3" class="form-control bg-secondary text-white border-0" placeholder="Describe brevemente qué incluye esta categoría..." required>{{ old('descripcion') }}</textarea>
                        </div>

                        {{-- 4. Estado --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-warning">Estado</label>
                            <select name="estado" class="form-select bg-secondary text-white border-0" required>
                                <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="col-12 mt-4 d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary text-white px-4">Limpiar</button>
                            <button type="submit" class="btn btn-warning px-4 fw-bold text-black">Guardar Categoría</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection