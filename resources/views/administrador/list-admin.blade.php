@extends('Layouts.app')

@section('titulo', 'Listado de Administradores - Kraneo Café')

@section('contenido')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dorado-kraneo mb-0">Personal / Administradores</h2>
        <a href="{{ route('administrador.crear') }}" class="btn btn-warning fw-bold text-black">
            + Nuevo Administrador
        </a>
    </div>

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

    @if(session('success'))
        <div class="alert alert-success bg-success text-white border-0 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive shadow-lg rounded border border-dorado-kraneo">
        <table class="table table-dark table-striped table-hover align-middle mb-0">

            <thead class="table-black border-bottom border-dorado-kraneo">
                <tr class="text-dorado-kraneo">
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($administradores as $admin)
                    <tr>
                        <td class="text-dorado-kraneo fw-bold">#{{ $admin->id_admin }}</td>

                        <td>
                            <img src="{{ $admin->imagen_url ?? asset('imagen/default-user.png') }}"
                                 class="rounded-circle border"
                                 width="45" height="45" style="object-fit: cover;">
                        </td>

                        <td class="fw-bold">{{ $admin->nombres }}</td>
                        <td>{{ $admin->apellidos }}</td>
                        <td class="text-warning">{{ $admin->usuario }}</td>
                        <td class="text-white-50">{{ $admin->email }}</td>

                        <td>
                            <span class="badge bg-secondary text-uppercase">
                                {{ $admin->rol }}
                            </span>
                        </td>

                        {{-- ESTADO CORREGIDO: Conectado con la columna 'activo' de la base de datos (1 / 0) --}}
                        <td>
                            @if($admin->activo == 1)
                                <span class="badge bg-success text-white">
                                    Activo
                                </span>
                            @else
                                <span class="badge bg-danger text-white">
                                    Inactivo
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('administrador.editar', $admin->id_admin) }}"
                                   class="btn btn-sm btn-warning text-black fw-bold">
                                    Editar
                                </a>

                                <a href="{{ route('administrador.mostrar', $admin->id_admin) }}"
                                   class="btn btn-sm btn-info text-black fw-bold">
                                    Ver
                                </a>

                                <form action="{{ route('administrador.eliminarLog', $admin->id_admin) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar?');">
                                    @csrf
                                    <button class="btn btn-sm btn-danger fw-bold">
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            No hay personal registrado
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection