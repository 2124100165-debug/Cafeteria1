@extends('Layouts.app')

@section('titulo', 'Listado de Clientes - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dorado-kraneo mb-0 fw-bold">Clientes / Lista General</h2>
        <a href="{{ route('cliente.crear') }}" class="btn btn-warning fw-bold text-black">
            + Nuevo Cliente
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-lg rounded border border-dorado-kraneo">
        <table class="table table-dark table-striped table-hover align-middle mb-0">
            <thead class="table-black border-bottom border-dorado-kraneo">
                <tr class="text-dorado-kraneo">
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                    <tr>
                        <td class="text-dorado-kraneo fw-bold">#{{ $cliente->id_cliente }}</td>
                        <td>
                            <img src="{{ $cliente->imagen ? asset($cliente->imagen) : asset('imagen/default-user.png') }}" 
                                 class="rounded-circle border border-secondary" width="45" height="45" style="object-fit: cover;">
                        </td>
                        <td>{{ $cliente->nombres }}</td>
                        <td>{{ $cliente->apellidos }}</td>
                        <td class="text-white-50">{{ $cliente->email }}</td>
                        <td>
                            <span class="badge {{ $cliente->estado === 'Activo' ? 'bg-success' : 'bg-danger' }}">
                                {{ $cliente->estado }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Botón Ver --}}
                                <a href="{{ route('cliente.mostrar', $cliente->id_cliente) }}" class="btn btn-sm btn-info btn-uniforme">Ver</a>
                                
                                {{-- Botón Editar --}}
                                <a href="{{ route('cliente.edit', $cliente->id_cliente) }}" class="btn btn-sm btn-outline-warning btn-uniforme">Editar</a>
                                
                                {{-- Formulario Borrado Lógico --}}
                                <form action="{{ route('cliente.eliminarLog', $cliente->id_cliente) }}" method="POST"
                                      onsubmit="return confirm('¿Desactivar a este cliente?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-uniforme">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No hay registros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection