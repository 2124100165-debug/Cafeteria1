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

    {{-- Buscador en Tiempo Real --}}
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-black text-dorado-kraneo border-dorado-kraneo">
                    <i class="bi bi-search"></i>
                </span>
                <input 
                    type="text" 
                    id="buscarAdmin" 
                    class="form-control bg-dark text-white border-dorado-kraneo shadow-none" 
                    placeholder="Buscar por nombre, usuario, rol..."
                >
            </div>
        </div>
    </div>

    {{-- Tabla Responsiva de Bootstrap con estilo Kraneo --}}
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
                        {{-- ID: id_admin --}}
                        <td class="text-dorado-kraneo fw-bold">#{{ $admin->id_admin }}</td>
                        
                        {{-- Foto: imagen_url --}}
                        <td>
                            <img 
                                src="{{ $admin->imagen_url ?? asset('imagen/default-user.png') }}" 
                                alt="Perfil" 
                                class="rounded-circle border border-secondary shadow"
                                width="45" 
                                height="45"
                                style="object-fit: cover;"
                            >
                        </td>
                        <td class="fw-bold">{{ $admin->nombres }}</td>
                        <td>{{ $admin->apellidos }}</td>
                        <td class="text-warning">{{ $admin->usuario }}</td>
                        <td class="text-white-50">{{ $admin->email }}</td>
                        
                        {{-- Rol con estilo dinámico --}}
                        <td>
                            <span class="badge bg-secondary text-uppercase fs-7">
                                {{ $admin->rol }}
                            </span>
                        </td>
                        
                        {{-- Estado: Activo / Inactivo --}}
                        <td>
                            @if($admin->estado == 'Activo')
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
                        
                        {{-- Botones de Acción --}}
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="#" class="btn btn-sm btn-outline-warning">Editar</a>
                                <button type="button" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <p class="mb-0 fs-5">No hay personal registrado en la base de datos.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Enlace limpio al mismo archivo de JavaScript externo en la carpeta pública --}}
<script src="{{ asset('js/buscador.js') }}"></script>
@endsection
