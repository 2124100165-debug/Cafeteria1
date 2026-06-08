@extends('Layouts.app')

@section('titulo', 'Registrar Cliente - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white shadow-lg border-secondary rounded-3">
                <div class="card-header border-bottom border-secondary text-center py-3">
                    <h3 class="text-warning fw-bold mb-0">Registrar Nuevo Cliente</h3>
                </div>
                <div class="card-body p-4">
                    {{-- Visualización de errores --}}
                    @if ($errors->any())
                        <div class="alert alert-danger bg-danger text-white border-0 mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('cliente.guardar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="estado" value="Activo">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Nombres</label>
                                <input type="text" name="nombres" class="form-control bg-dark text-white border-secondary" value="{{ old('nombres') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control bg-dark text-white border-secondary" value="{{ old('apellidos') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Confirmar Correo</label>
                                <input type="email" name="email_confirmation" class="form-control bg-dark text-white border-secondary" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Contraseña</label>
                                <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control bg-dark text-white border-secondary" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Teléfono</label>
                                <input type="text" name="telefono" class="form-control bg-dark text-white border-secondary" value="{{ old('telefono') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Dirección Completa</label>
                                <input type="text" name="direccion" class="form-control bg-dark text-white border-secondary" value="{{ old('direccion') }}">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-warning fw-bold">Foto de Perfil (Opcional)</label>
                            <input type="file" name="imagen" class="form-control bg-dark text-white border-secondary" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold px-4">Guardar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection