@extends('Layouts.app')

@section('titulo', 'Registrar Producto - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-black text-white border-dorado-kraneo border-2 shadow-lg">
                <div class="card-header border-bottom border-dorado-kraneo text-center py-3">
                    <h3 class="text-dorado-kraneo mb-0">Registrar Nuevo Producto</h3>
                </div>
                <div class="card-body p-4">
                    
                    <form action="{{ route('producto.guardar') }}" method="POST">

                        <div class="mb-3">
                            <label for="nombre" class="form-label text-dorado-kraneo fw-bold">Nombre del Producto</label>
                            <input type="text" class="form-control bg-dark text-white border-secondary" id="nombre" name="nombre" placeholder="Ej. Capuccino" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_categoria" class="form-label text-dorado-kraneo fw-bold">Categoría</label>
                                <select class="form-select bg-dark text-white border-secondary" id="id_categoria" name="id_categoria" required>
                                    <option value="1">Bebidas Calientes</option>
                                    <option value="2">Bebidas Frías</option>
                                    <option value="3">Especialidades</option>
                                    <option value="4">Repostería</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="precio" class="form-label text-dorado-kraneo fw-bold">Precio ($)</label>
                                <input type="number" step="0.01" class="form-control bg-dark text-white border-secondary" id="precio" name="precio" placeholder="0.00" required>
                            </div>
                        </div>

                        {{-- Imagen del Producto --}}
                        <div class="mb-3">
                            <label class="form-label text-dorado-kraneo fw-bold">Imagen del Producto</label>
                            <div class="input-group">
                                <input type="file" name="imagen_archivo" class="form-control bg-dark text-white border-secondary" accept="image/*">
                            </div>
                            <small class="text-white-50 mt-1 d-block">O ingresa una URL: 
                                <input type="text" name="imagen_url" class="form-control bg-dark text-white border-secondary mt-1" placeholder="https://ejemplo.com/imagen.jpg">
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="stock" class="form-label text-dorado-kraneo fw-bold">Stock Inicial</label>
                            <input type="number" class="form-control bg-dark text-white border-secondary" id="stock" name="stock" placeholder="Ej. 100" required>
                        </div>

                        {{-- Botones de Control --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('producto.index') }}" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold text-black">Guardar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection