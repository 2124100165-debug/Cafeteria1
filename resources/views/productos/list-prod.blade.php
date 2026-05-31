@extends('Layouts.app')

@section('titulo', 'Listado de Productos - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    {{-- Encabezado y subtítulo --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="text-dorado-kraneo mb-0 fw-bold">Inventario de Productos</h2>
            <p class="subtitulo-kraneo">Gestión de productos disponibles en el menú</p>
        </div>
        <div>
            <a href="{{ route('producto.crear') }}" class="btn btn-warning fw-bold text-black">
                <i class="bi bi-plus-lg"></i> Nuevo Producto
            </a>
        </div>
    </div>

    {{-- Tabla de Productos --}}
    <div class="table-responsive shadow-lg rounded border border-dorado-kraneo border-2">
        <table class="table table-dark table-striped table-hover align-middle mb-0">
            <thead class="table-black border-bottom border-dorado-kraneo">
                <tr class="text-dorado-kraneo">
                    <th scope="col" class="py-3 ps-3">ID</th>
                    <th scope="col" class="py-3">Nombre</th>
                    <th scope="col" class="py-3">Categoría</th>
                    <th scope="col" class="py-3">Precio</th>
                    <th scope="col" class="py-3 text-center">Stock</th>
                    <th scope="col" class="py-3 text-center pe-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                    <tr>
                        <td class="text-dorado-kraneo fw-bold ps-3">#{{ $producto->id_producto }}</td>
                        <td class="fw-bold text-white">{{ $producto->nombre }}</td>
                        <td class="text-white-50">{{ $producto->categoria }}</td>
                        <td class="fw-bold text-warning">${{ number_format($producto->precio, 2) }}</td>
                        
                        {{-- Lógica de Stock: Alerta visual si es menor a 20 --}}
                        <td class="text-center">
                            @if($producto->stock < 20)
                                <span class="badge bg-danger text-white px-3 py-2">
                                    <i class="bi bi-exclamation-triangle-fill"></i> {{ $producto->stock }} pzas
                                </span>
                            @else
                                <span class="badge bg-dark border border-secondary text-white px-3 py-2">
                                    {{ $producto->stock }} pzas
                                </span>
                            @endif
                        </td>

                        <td class="text-center pe-3">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="#" class="btn btn-outline-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger" title="Eliminar">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam display-4 d-block mb-3"></i>
                            No hay productos agregados al menú.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection