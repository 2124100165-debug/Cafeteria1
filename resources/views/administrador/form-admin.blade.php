@extends('Layouts.app')

@section('titulo', 'Registrar Personal - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-black text-white border-dorado-kraneo border-2 shadow-lg">
                <div class="card-header border-bottom border-dorado-kraneo text-center py-3">
                    <h3 class="text-dorado-kraneo mb-0">Crear Nuevo Personal</h3>
                </div>
                <div class="card-body p-4">
                    {{-- CORRECCIÓN: Se cambió a método GET y se apunta al index para evitar errores de ruta --}}
                    <form action="{{ route('administrador.index') }}" method="GET">
                        
                        <div class="row">
                            {{-- Campo: Nombres --}}
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label text-dorado-kraneo fw-bold">Nombres</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="nombres" name="nombres" placeholder="Ej. Carlos Alberto" required>
                            </div>

                            {{-- Campo: Apellidos --}}
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label text-dorado-kraneo fw-bold">Apellidos</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="apellidos" name="apellidos" placeholder="Ej. Mendoza Ruiz" required>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Campo: email --}}
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label text-dorado-kraneo fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" placeholder="carlos@kraneocafe.com" required>
                            </div>

                            {{-- Campo: usuario --}}
                            <div class="col-md-6 mb-3">
                                <label for="usuario" class="form-label text-dorado-kraneo fw-bold">Nombre de Usuario</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="usuario" name="usuario" placeholder="Ej. cmendoza" required>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Campo: password --}}
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label text-dorado-kraneo fw-bold">Contraseña</label>
                                <input type="password" class="form-control bg-dark text-white border-secondary" id="password" name="password" placeholder="********" required>
                            </div>

                            {{-- Campo: password_confirmation --}}
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label text-dorado-kraneo fw-bold">Confirmar Contraseña</label>
                                <input type="password" class="form-control bg-dark text-white border-secondary" id="password_confirmation" name="password_confirmation" placeholder="********" required>
                            </div>
                        </div>

                        {{-- Campo: Rol --}}
                        <div class="mb-3">
                            <label for="rol" class="form-label text-dorado-kraneo fw-bold">Rol o Puesto en la Cafetería</label>
                            <div class="input-group">
                                <span class="input-group-text bg-black text-dorado-kraneo border-secondary">
                                    <i class="bi bi-person-badge-fill"></i>
                                </span>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="rol" name="rol" placeholder="Ej: Barista, Mesero" required>
                            </div>
                        </div>

                        <hr class="border-secondary my-4">
                        
                        {{-- Botones de Acción --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                            <a href="{{ route('administrador.index') }}" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold text-black">Guardar Personal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection