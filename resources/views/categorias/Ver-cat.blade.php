@extends('layouts.app')

@section('contenido')
<div class="container mt-4">
    <div class="card bg-dark text-light border-warning shadow-lg">
        <div class="card-header bg-dark border-warning">
            <h3 class="mb-0 text-warning">
                Expediente de Categoría: #{{ $categoria->id_categoria }}
            </h3>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @if($categoria->imagen)
                        <img src="{{ asset($categoria->imagen) }}" class="categoria-foto img-fluid rounded" alt="Imagen">
                    @else
                        <div class="bg-secondary p-5 rounded">Sin Imagen</div>
                    @endif
                </div>
                <div class="col-md-8">
                    <label class="text-secondary fw-bold">Nombre</label>
                    <div class="bg-secondary text-white p-2 rounded mb-3">
                        {{ $categoria->nombre_categoria }}
                    </div>

                    <label class="text-secondary fw-bold">Descripción</label>
                    <div class="bg-secondary text-white p-2 rounded mb-3">
                        {{ $categoria->descripcion ?? 'Sin descripción' }}
                    </div>

                    <label class="text-secondary fw-bold">Estado</label>
                    <div class="p-2 rounded {{ $categoria->estado == 'Activo' ? 'bg-success' : 'bg-danger' }} text-white d-inline-block">
                        {{ $categoria->estado }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-dark border-warning d-flex justify-content-end">
            <a href="{{ route('categorias.index') }}" class="btn btn-outline-warning">Volver al Listado</a>
        </div>
    </div>
</div>
@endsection