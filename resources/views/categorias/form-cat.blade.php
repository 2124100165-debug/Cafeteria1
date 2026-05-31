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
                <a href="{{ route('categoria.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Ver Listado
                </a>
            </div>
        </div>

        {{-- Tarjeta del Formulario --}}
        <div class="card bg-dark text-white shadow-lg border-secondary rounded-3">
            <div class="card-body p-4 p-md-5">
                
                {{-- Formulario ajustado con multipart/form-data para archivos --}}
                <form method="GET" action="{{ route('categoria.index') }}" enctype="multipart/form-data">
                    
                    <div class="row g-3">
                        {{-- 1. Nombre de la Categoría --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-warning">Nombre de la Categoría</label>
                            <input type="text" name="nombre_categoria" class="form-control bg-secondary text-white border-0" placeholder="Ej. Bebidas Heladas" required>
                        </div>

                        {{-- 2. Imagen (Subida o URL) --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-warning">Imagen del Producto</label>
                            <div class="input-group">
                                <input type="file" name="imagen_archivo" class="form-control bg-secondary text-white border-0" accept="image/*">
                            </div>
                            <small class="text-white-50 mt-1 d-block">O ingresa una URL: 
                                <input type="text" name="imagen_url" class="form-control bg-secondary text-white border-0 mt-1" placeholder="https://ejemplo.com/imagen.jpg">
                            </small>
                        </div>

                        {{-- 3. Descripción --}}
                        <div class="col-12">
                            <label class="form-label fw-semibold text-warning">Descripción</label>
                            <textarea name="descripcion" rows="3" class="form-control bg-secondary text-white border-0" placeholder="Describe brevemente qué incluye esta categoría..." required></textarea>
                        </div>

                        {{-- 4. Estado --}}
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-warning">Estado</label>
                            <select name="estado" class="form-select bg-secondary text-white border-0" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
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