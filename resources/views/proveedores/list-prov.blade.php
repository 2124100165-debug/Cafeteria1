@extends('Layouts.app')

@section('titulo', 'Listado de Proveedores - Kraneo Café')

@section('contenido')

<div class="container mt-4">

    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dorado-kraneo mb-0">
            Proveedores / Lista General
        </h2>

        <a href="{{ route('proveedor.crear') }}"
           class="btn btn-warning fw-bold text-black">
            + Nuevo Proveedor
        </a>
    </div>

    {{-- Buscador --}}
    <div class="row mb-3">
        <div class="col-md-4">

            <div class="input-group">

                <span class="input-group-text
                             bg-black
                             text-dorado-kraneo
                             border-dorado-kraneo">

                    <i class="bi bi-search"></i>

                </span>

                <input type="text"
                       id="buscarProveedor"
                       class="form-control
                              bg-dark
                              text-white
                              border-dorado-kraneo
                              shadow-none"

                       placeholder="Buscar por nombre, empresa...">

            </div>

        </div>
    </div>

    {{-- Tabla --}}
    <div class="table-responsive shadow-lg rounded border border-dorado-kraneo">

        <table class="table
                      table-dark
                      table-striped
                      table-hover
                      align-middle
                      mb-0">

            <thead class="table-black border-bottom border-dorado-kraneo">

                <tr class="text-dorado-kraneo">

                    <th scope="col" class="py-3">ID</th>
                    <th scope="col" class="py-3">Nombre</th>
                    <th scope="col" class="py-3">Contacto</th>
                    <th scope="col" class="py-3">Teléfono</th>
                    <th scope="col" class="py-3">Empresa</th>
                    <th scope="col" class="py-3 text-center">Acciones</th>

                </tr>

            </thead>

            <tbody>

                @forelse($proveedores as $proveedor)

                    <tr>

                        {{-- ID --}}
                        <td class="text-dorado-kraneo fw-bold">
                            #{{ $proveedor->id_provider }}
                        </td>

                        {{-- Nombre --}}
                        <td class="fw-bold text-white">
                            {{ $proveedor->contacto_nombre }}
                        </td>

                        {{-- Contacto --}}
                        <td class="text-white-50">
                            {{ $proveedor->contacto_nombre }}
                        </td>

                        {{-- Teléfono --}}
                        <td class="text-warning fw-bold">
                            {{ $proveedor->telefono }}
                        </td>

                        {{-- Empresa --}}
                        <td class="text-white-50">
                            {{ $proveedor->nombre_empresa }}
                        </td>

                        {{-- Acciones --}}
                        <td class="text-center">

                            <div class="btn-group" role="group">

                                <button type="button"
                                        class="btn btn-sm btn-outline-warning">
                                    Editar
                                </button>

                                <button type="button"
                                        class="btn btn-sm btn-outline-danger">
                                    Eliminar
                                </button>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6"
                            class="text-center py-5 text-muted">

                            <p class="mb-0 fs-5">
                                No hay proveedores registrados.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<script src="{{ asset('js/buscador.js') }}"></script>

@endsection