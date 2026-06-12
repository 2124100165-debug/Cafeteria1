@extends('Layouts.app')

@section('titulo', 'Listado de Administradores - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    {{-- Encabezado del Listado --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dorado-kraneo mb-0">Personal / Administradores</h2>
        <a href="{{ route('administrador.crear') }}" class="btn btn-warning fw-bold text-black">
            + Nuevo Administrador
        </a>
    </div>

    {{-- Buscador --}}
    <div class="mb-4">
        <form action="{{ route('administrador.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="buscar" class="form-control bg-dark text-white border-secondary" 
                   placeholder="Buscar por nombre, usuario o email..." value="{{ request('buscar') }}">
            <button type="submit" class="btn btn-outline-warning">Buscar</button>
            @if(request('buscar'))
                <a href="{{ route('administrador.index') }}" class="btn btn-outline-secondary">Limpiar</a>
            @endif
        </form>
    </div>

    {{-- Mensajes de Notificación --}}
    @if(session('success'))
        <div class="alert alert-success bg-success text-white border-0 mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla Responsiva --}}
    <div class="table-responsive shadow-lg rounded border border-dorado-kraneo">
        <table class="table table-dark table-striped table-hover align-middle mb-0">
            <thead class="table-black border-bottom border-dorado-kraneo">
                <tr class="text-dorado-kraneo">
                    <th scope="col" class="py-3">ID</th>
                    <th scope="col" class="py-3">Foto</th>
                    <th scope="col" class="py-3">Nombres</th>
                    <th scope="col" class="py-3">Apellidos</th>
                    <th scope="col" class="py-3">Usuario</th>
                    <th scope="col" class="py-3">Email</th>
                    <th scope="col" class="py-3">Rol</th>
                    <th scope="col" class="py-3">Estado</th>
                    <th scope="col" class="py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($administradores as $admin)
                    <tr>
                        <td class="text-dorado-kraneo fw-bold">#{{ $admin->id_admin }}</td>
                        <td>
                            <img src="{{ $admin->imagen_url ?? asset('imagen/default-user.png') }}" 
                                 alt="Perfil" class="rounded-circle border border-secondary shadow"
                                 width="45" height="45" style="object-fit: cover;">
                        </td>
                        <td class="fw-bold">{{ $admin->nombres }}</td>
                        <td>{{ $admin->apellidos }}</td>
                        <td class="text-warning">{{ $admin->usuario }}</td>
                        <td class="text-white-50">{{ $admin->email }}</td>
                        <td>
                            <span class="badge bg-secondary text-uppercase fs-7">
                                {{ $admin->rol }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $admin->estado == 'Activo' ? 'bg-success' : 'bg-danger' }}">
                                {{ $admin->estado }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Botón Editar --}}
                                <a href="{{ route('administrador.editar', $admin->id_admin) }}" class="btn btn-sm btn-warning text-black fw-bold">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>

                                {{-- Botón Ver --}}
                                <a href="{{ route('administrador.mostrar', $admin->id_admin) }}" class="btn btn-sm btn-info text-black fw-bold">
                                    <i class="bi bi-eye"></i> Ver
                                </a>

                                {{-- Formulario Eliminar (Soft Delete) --}}
                                <form action="{{ route('administrador.eliminarLog', $admin->id_admin) }}" method="POST" 
                                      onsubmit="return confirm('¿Estás seguro de enviar a este administrador a la papelera?');">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger fw-bold">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <p class="mb-0 fs-5">No hay personal activo registrado.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection