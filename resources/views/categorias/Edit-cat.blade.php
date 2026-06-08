@extends('Layouts.app')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8">

        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-warning mb-0 fw-bold">Editar Categoría</h2>
                <p class="mb-0" style="color: #d4af37; opacity: 0.9; font-size: 0.95rem;">
                    Actualizando: {{ $categoria->nombre_categoria }}
                </p>
            </div>
            <div>
                <a href="{{ route('categorias.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Volver al Listado
                </a>
            </div>
        </div>

        {{-- Tarjeta del Formulario --}}
        <div class="card bg-dark text-white shadow-lg border-secondary rounded-3">
            <div class="card-body p-4 p-md-5">
                
                @if ($errors->any())
                    <div class="alert alert-danger bg-black text-danger border-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('categorias.actualizar', $categoria->id_categoria) }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-warning">Nombre de la Categoría</label>
                            <input type="text" name="nombre_categoria" class="form-control bg-secondary text-white border-0" value="{{ old('nombre_categoria', $categoria->nombre_categoria) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-warning">Imagen de la Categoría</label>
                            
                            @if($categoria->imagen)
                                <div class="mb-2">
                                    <small class="text-white-50">Actual: </small>
                                    <img src="{{ $categoria->imagen }}" alt="Img" width="40" class="rounded">
                                </div>
                            @endif

                            <div class="input-group">
                                <input type="file" name="foto_archivo" class="form-control bg-secondary text-white border-0" accept="image/*">
                            </div>
                            <small class="text-white-50 mt-1 d-block">O actualizar URL: 
                                <input type="text" name="foto_url" class="form-control bg-secondary text-white border-0 mt-1" value="{{ old('foto_url', $categoria->imagen) }}" placeholder="https://ejemplo.com/imagen.jpg">
                            </small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-warning">Descripción</label>
                            <textarea name="descripcion" rows="3" class="form-control bg-secondary text-white border-0" required>{{ old('descripcion', $categoria->descripcion) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-warning">Estado</label>
                            <select name="estado" class="form-select bg-secondary text-white border-0" required>
                                <option value="Activo" {{ old('estado', $categoria->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado', $categoria->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary text-white px-4">Cancelar</a>
                            <button type="submit" class="btn btn-warning px-4 fw-bold text-black">Actualizar Categoría</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection