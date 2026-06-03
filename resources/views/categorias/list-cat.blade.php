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
                {{-- 🛠️ CORREGIDO: Se agregó la 's' para cambiar 'categoria.crear' por 'categorias.crear' --}}
                <a href="{{ route('categorias.crear') }}" class="btn btn-warning fw-bold btn-sm">
                    <i class="bi bi-plus-lg"></i> Nueva Categoría
                </a>
            </div>
        </div>

        {{-- El resto de tu tabla hacia abajo se queda exactamente igual --}}

        {{-- Mensajes de Notificación de la Base de Datos --}}
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
                                <th class="py-3">Imagen</th>
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
                                    
                                    {{-- Miniatura o texto de la imagen (Protegido si no viene en la simulación) --}}
                                    <td>
                                        <span class="badge bg-secondary p-2">
                                            <i class="bi bi-image"></i> {{ $categoria->imagen ?? 'sin_imagen.jpg' }}
                                        </span>
                                    </td>
                                    
                                    {{-- Nombre (Soporta 'nombre_categoria' o 'nombre') --}}
                                    <td class="fw-semibold text-warning">
                                        {{ $categoria->nombre_categoria ?? $categoria->nombre }}
                                    </td>
                                    
                                    {{-- Descripción --}}
                                    <td class="text-white w-50">{{ $categoria->descripcion }}</td>
                                    
                                    {{-- Estado con Badge Dinámico --}}
                                    <td>
                                        @if(($categoria->estado ?? 'Activo') == 'Activo')
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    
                                    {{-- Botones de Control --}}
                                    <td class="text-center pe-4">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-warning" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" title="Borrar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                {{-- En caso de que la simulación o la BD estén vacías --}}
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-folder-x display-4 d-block mb-3"></i>
                                        No hay categorías registradas en la base de datos todavía.
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