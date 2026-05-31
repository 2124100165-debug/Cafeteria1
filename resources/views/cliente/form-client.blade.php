@extends('Layouts.app')

@section('titulo', 'Registrar Cliente - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-black text-white border-dorado-kraneo border-2 shadow-lg">
                <div class="card-header border-bottom border-dorado-kraneo text-center py-3">
                    <h3 class="text-dorado-kraneo mb-0">Registrar Nuevo Cliente</h3>
                </div>
                <div class="card-body p-4">
                    {{-- CORRECCIÓN: Se cambió a GET y apunta al índice para evitar error 404 --}}
                    <form action="{{ route('cliente.index') }}" method="GET">

                        <div class="row">
                            {{-- Campo: Nombres --}}
                            <div class="col-md-6 mb-3">
                                <label for="nombres" class="form-label text-dorado-kraneo fw-bold">Nombres</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="nombres" name="nombres" placeholder="Ej. Alejandro" required>
                            </div>

                            {{-- Campo: Apellidos --}}
                            <div class="col-md-6 mb-3">
                                <label for="apellidos" class="form-label text-dorado-kraneo fw-bold">Apellidos</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="apellidos" name="apellidos" placeholder="Ej. Fernández" required>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Campo: email --}}
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label text-dorado-kraneo fw-bold">Correo Electrónico</label>
                                <input type="email" class="form-control bg-dark text-white border-secondary" id="email" name="email" placeholder="ale@gmail.com" required>
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

                        <div class="row">
                            {{-- Campo: telefono --}}
                            <div class="col-md-6 mb-3">
                                <label for="telefono" class="form-label text-dorado-kraneo fw-bold">Teléfono / Celular</label>
                                <input type="tel" class="form-control bg-dark text-white border-secondary" id="telefono" name="telefono" placeholder="Ej. 33387658">
                            </div>

                            {{-- Campo: direccion --}}
                            <div class="col-md-6 mb-3">
                                <label for="direccion" class="form-label text-dorado-kraneo fw-bold">Dirección Completa</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="direccion" name="direccion" placeholder="Calle, Número, Colonia...">
                            </div>
                        </div>

                        <hr class="border-secondary my-4">
                        <h5 class="text-dorado-kraneo mb-3">Foto de Perfil del Cliente (Opcional)</h5>

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="imagen" class="form-label text-white-50 fs-7">Subir archivo de imagen (JPG, PNG)</label>
                                <input type="file" class="form-control bg-dark text-white border-secondary" id="imagen" name="imagen" accept=".jpg,.jpeg,.png">
                            </div>
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                            <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold text-black">Guardar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection