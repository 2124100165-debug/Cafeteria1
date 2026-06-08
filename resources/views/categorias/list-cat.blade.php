@extends('Layouts.app')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-11">

        {{-- Encabezado del Listado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-warning mb-0 fw-bold">Listado de Categorías</h2>
                <p class="text-muted small mb-0">Secciones activas del menú en la base de datos</p>
            </div>
            <div>
                <a href="{{ route('categorias.crear') }}" class="btn btn-warning fw-bold btn-sm">
                    <i class="bi bi-plus-lg"></i> Nueva Categoría
                </a>
            </div>
        </div>

        {{-- Mensajes de Notificación --}}
        @if(session('status'))
            <div class="alert alert-success bg-success text-white border-0 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        {{-- Tabla de Datos Estilo Oscuro --}}
        <div class="card bg-dark text-white shadow-lg border-secondary rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0 align-middle">
                        <thead class="table-black border-bottom border-secondary text-warning">
                            <tr>
                                <th class="ps-4 py-3">ID</th>
                                <th class="py-3">Foto</th>
                                <th class="py-3">Nombre de la Categoría</th>
                                <th class="py-3">Descripción</th>
                                <th class="py-3">Estado</th>
                                <th class="text-center pe-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categorias as $categoria)
                                <tr>
                                    {{-- ID Categoría --}}
                                    <td class="ps-4 fw-bold text-light">#{{ $categoria->id_categoria }}</td>
                                    
                                    {{-- Miniatura Circular --}}
                                    <td>
                                        @if($categoria->imagen)
                                            <img src="{{ asset($categoria->imagen) }}" 
                                                 alt="Imagen" 
                                                 style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%; border: 2px solid #ffcc00;">
                                        @else
                                            <div style="width: 45px; height: 45px; border-radius: 50%; background-color: #333; display: flex; align-items: center; justify-content: center; border: 2px solid #555;">
                                                <i class="bi bi-image" style="color: #888;"></i>
                                            </div>
                                        @endif
                                    </td>
                                    
                                    {{-- Nombre --}}
                                    <td class="fw-semibold text-warning">
                                        {{ $categoria->nombre_categoria ?? $categoria->nombre }}
                                    </td>
                                    
                                    {{-- Descripción --}}
                                    <td class="text-white w-50">{{ $categoria->descripcion }}</td>
                                    
                                    {{-- Estado --}}
                                    <td>
                                        @if(($categoria->estado ?? 'Activo') == 'Activo')
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    
                                    {{-- Acciones --}}
                                    <td class="text-center pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('categorias.editar', $categoria->id_categoria) }}" 
                                               class="btn btn-warning btn-sm fw-bold px-3 shadow-sm" title="Editar">
                                                <i class="bi bi-pencil-fill me-1"></i> Editar
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" title="Borrar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-folder-x display-4 d-block mb-3"></i>
                                        No hay categorías registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection