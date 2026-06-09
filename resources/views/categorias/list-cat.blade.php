@extends('Layouts.app')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-11">

        {{-- Encabezado --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-warning mb-0 fw-bold">Listado de Categorías</h2>
                <p class="text-muted small mb-0">Gestión de secciones del menú</p>
            </div>
            <a href="{{ route('categorias.crear') }}" class="btn btn-warning fw-bold btn-sm shadow-sm">
                <i class="bi bi-plus-lg"></i> Nueva Categoría
            </a>
        </div>

        {{-- Mensajes de Notificación --}}
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Tabla de Datos --}}
        <div class="card bg-dark text-white shadow-lg border-secondary rounded-3">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle">
                    <thead class="text-warning border-bottom border-secondary">
                        <tr>
                            <th class="ps-4 py-3">ID</th>
                            <th class="py-3">Foto</th>
                            <th class="py-3">Nombre</th>
                            <th class="py-3">Descripción</th>
                            <th class="py-3">Estado</th>
                            <th class="text-center pe-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $categoria)
                            <tr>
                                <td class="ps-4 fw-bold text-light">#{{ $categoria->id_categoria }}</td>
                                <td>
                                    @if($categoria->imagen)
                                        <img src="{{ asset($categoria->imagen) }}" style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%; border: 2px solid #ffcc00;">
                                    @else
                                        <div class="bg-secondary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; border-radius: 50%;">
                                            <i class="bi bi-image text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="fw-semibold text-warning">{{ $categoria->nombre_categoria }}</td>
                                <td class="text-white">{{ Str::limit($categoria->descripcion, 50) }}</td>
                                <td>
                                    <span class="badge {{ $categoria->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $categoria->estado }}
                                    </span>
                                </td>
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('categorias.editar', $categoria->id_categoria) }}" class="btn btn-warning btn-sm fw-bold btn-uniforme">Editar</a>
                                        <a href="{{ route('categorias.mostrar', $categoria->id_categoria) }}" class="btn btn-info btn-sm fw-bold btn-uniforme">Ver</a>
                                        
                                        <form action="{{ route('categorias.eliminarLog', $categoria->id_categoria) }}" method="POST" onsubmit="return confirm('¿Está seguro de desactivar esta categoría?');">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm fw-bold btn-uniforme">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x d-block display-6 mb-2"></i> No hay categorías registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection