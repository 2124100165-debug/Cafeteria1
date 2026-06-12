@extends('Layouts.app')

@section('titulo', 'Detalle del Cliente - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white shadow-lg border-dorado-kraneo">
                <div class="card-header border-bottom border-dorado-kraneo d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-dorado-kraneo fw-bold">Perfil del Cliente #{{ $cliente->id_cliente }}</h4>
                    <a href="{{ route('cliente.index') }}" class="btn btn-sm btn-outline-secondary">Volver al listado</a>
                </div>
                
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            {{-- Ajustado: Verificamos que la imagen exista en la BD --}}
                            <img src="{{ $cliente->imagen ? asset($cliente->imagen) : asset('imagen/default-user.png') }}" 
                                 class="img-fluid rounded-circle border border-dorado-kraneo shadow"
                                 style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        
                        <div class="col-md-8">
                            <h3 class="fw-bold">{{ $cliente->nombres }} {{ $cliente->apellidos }}</h3>
                            <p class="text-white-50"><i class="bi bi-envelope"></i> {{ $cliente->email }}</p>
                            
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                {{-- Aquí aseguramos que llame a las columnas correctas de tu tabla --}}
                                <span class="badge bg-secondary p-2 fs-6">
                                    Tel: {{ $cliente->telefono ?? 'Sin número' }}
                                </span>
                                <span class="badge bg-secondary p-2 fs-6">
                                    Dir: {{ $cliente->direccion ?? 'Sin dirección' }}
                                </span>
                                <span class="badge {{ $cliente->estado === 'Activo' ? 'bg-success' : 'bg-danger' }} p-2 fs-6">
                                    Estado: {{ $cliente->estado }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection