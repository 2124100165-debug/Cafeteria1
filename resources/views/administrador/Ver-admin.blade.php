@extends('Layouts.app')

@section('titulo', 'Detalles del Empleado - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="card bg-dark text-white border-dorado-kraneo shadow-lg">
        <div class="card-header border-bottom border-dorado-kraneo bg-black">
            <h3 class="text-dorado-kraneo mb-0">Expediente de Administrador: #{{ $administrador->id_admin }}</h3>
        </div>
        
        <div class="card-body p-4">
            <div class="row">
                {{-- Columna de Foto --}}
                <div class="col-md-3 text-center mb-4">
                    <img src="{{ $administrador->imagen_url ?? asset('imagen/default-user.png') }}" 
                         class="img-fluid rounded border border-dorado-kraneo" 
                         style="max-width: 200px;" alt="Foto">
                </div>

                {{-- Columna de Datos --}}
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-dorado-kraneo fw-bold">Nombres</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" value="{{ $administrador->nombres }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-dorado-kraneo fw-bold">Apellidos</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" value="{{ $administrador->apellidos }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-dorado-kraneo fw-bold">Usuario</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" value="{{ $administrador->usuario }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-dorado-kraneo fw-bold">Email</label>
                            <input type="email" class="form-control bg-secondary text-white border-0" value="{{ $administrador->email }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-dorado-kraneo fw-bold">Rol</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" value="{{ $administrador->rol }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-dorado-kraneo fw-bold">Estado</label>
                            <input type="text" class="form-control {{ $administrador->estado == 'Activo' ? 'bg-success' : 'bg-danger' }} text-white border-0" value="{{ $administrador->estado }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Botón de Regreso --}}
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('administrador.index') }}" class="btn btn-outline-warning fw-bold">
                    <i class="bi bi-arrow-left"></i> Volver al Listado
                </a>
            </div>
        </div>
    </div>
</div>
@endsection