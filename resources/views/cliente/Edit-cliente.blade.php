@extends('Layouts.app')

@section('titulo', 'Editar Cliente - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white shadow-lg border-secondary rounded-3">
                <div class="card-header border-bottom border-secondary text-center py-3">
                    <h3 class="text-warning fw-bold mb-0">Editar Cliente: {{ $cliente->nombres }}</h3>
                </div>
                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger bg-danger text-white border-0 mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('cliente.actualizar', $cliente->id_cliente) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Nombres</label>
                                <input type="text" name="nombres" class="form-control bg-dark text-white border-secondary" value="{{ old('nombres', $cliente->nombres) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Apellidos</label>
                                <input type="text" name="apellidos" class="form-control bg-dark text-white border-secondary" value="{{ old('apellidos', $cliente->apellidos) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label text-warning fw-bold">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" value="{{ old('email', $cliente->email) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Nueva Contraseña</label>
                                <input type="password" name="password" class="form-control bg-dark text-white border-secondary" placeholder="Opcional">
                                <small class="text-secondary">Deja en blanco para no cambiar</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control bg-dark text-white border-secondary" placeholder="Repetir contraseña">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Teléfono</label>
                                <input type="text" name="telefono" class="form-control bg-dark text-white border-secondary" value="{{ old('telefono', $cliente->telefono) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-warning fw-bold">Dirección</label>
                                <input type="text" name="direccion" class="form-control bg-dark text-white border-secondary" value="{{ old('direccion', $cliente->direccion) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-warning fw-bold">Estado</label>
                            <select name="estado" class="form-select bg-dark text-white border-secondary" required>
                                <option value="Activo" {{ old('estado', $cliente->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado', $cliente->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-warning fw-bold">Foto de Perfil</label>
                            @if($cliente->imagen)
                                <div class="mb-2">
                                    <img src="{{ asset($cliente->imagen) }}" alt="Foto actual" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="imagen" class="form-control bg-dark text-white border-secondary" accept="image/*">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary px-4">Cancelar</a>
                            <button type="submit" class="btn btn-warning fw-bold px-4">Actualizar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection