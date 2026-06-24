@extends('layouts.app')

@section('titulo', 'Panel Administrativo - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    {{-- Tarjeta de Bienvenida --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-black border-dorado-kraneo border-2 shadow-lg">
                <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h2 class="text-dorado-kraneo mb-1 font-montserrat fw-bold">
                            <i class="bi bi-speedometer2"></i> Panel de Control
                        </h2>
                        <p class="text-white-50 mb-0">
                            Bienvenido al área administrativa de Kraneo Café.
                        </p>
                    </div>
                    <div class="text-end bg-dark p-3 rounded border border-secondary shadow-sm">
                        <span class="text-white-50 d-block small">Administrador Autenticado</span>
                        <h5 class="text-dorado-kraneo mb-0 fw-bold">
                            <i class="bi bi-person-circle"></i> 
                            {{ Auth::guard('admin')->user()->nombres }} {{ Auth::guard('admin')->user()->apellidos }}
                        </h5>
                        <span class="badge bg-warning text-black text-uppercase mt-1 small">
                            {{ Auth::guard('admin')->user()->rol }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Métricas / Estadísticas Rápidas --}}
    <div class="row g-4 mb-5">
        {{-- Productos --}}
        <div class="col-md-3">
            <div class="card bg-black text-white border-secondary h-100 shadow-sm metric-card">
                <div class="card-body d-flex align-items-center">
                    <div class="fs-1 text-dorado-kraneo me-3">
                        <i class="bi bi-cup-hot-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-white-50 mb-1">Productos</h6>
                        <h3 class="mb-0 fw-bold">{{ $totalProductos }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categorías --}}
        <div class="col-md-3">
            <div class="card bg-black text-white border-secondary h-100 shadow-sm metric-card">
                <div class="card-body d-flex align-items-center">
                    <div class="fs-1 text-dorado-kraneo me-3">
                        <i class="bi bi-tags-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-white-50 mb-1">Categorías</h6>
                        <h3 class="mb-0 fw-bold">{{ $totalCategorias }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Clientes --}}
        <div class="col-md-3">
            <div class="card bg-black text-white border-secondary h-100 shadow-sm metric-card">
                <div class="card-body d-flex align-items-center">
                    <div class="fs-1 text-dorado-kraneo me-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-white-50 mb-1">Clientes</h6>
                        <h3 class="mb-0 fw-bold">{{ $totalClientes }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pedidos --}}
        <div class="col-md-3">
            <div class="card bg-black text-white border-secondary h-100 shadow-sm metric-card">
                <div class="card-body d-flex align-items-center">
                    <div class="fs-1 text-dorado-kraneo me-3">
                        <i class="bi bi-cart-fill"></i>
                    </div>
                    <div>
                        <h6 class="text-white-50 mb-1">Pedidos Realizados</h6>
                        <h3 class="mb-0 fw-bold">{{ $totalPedidos }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Acciones Rápidas del Sistema --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-black border-dorado-kraneo border-2 shadow-lg">
                <div class="card-header border-bottom border-secondary py-3">
                    <h5 class="text-dorado-kraneo mb-0 font-montserrat fw-bold">
                        <i class="bi bi-gear-fill"></i> Accesos Rápidos
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 text-center">
                        <div class="col-6 col-md-3">
                            <a href="{{ route('producto.index') }}" class="btn btn-outline-warning w-100 py-3">
                                <i class="bi bi-cup-hot fs-3 d-block mb-2"></i>
                                Gestionar Productos
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('pedido.index') }}" class="btn btn-outline-warning w-100 py-3">
                                <i class="bi bi-cart fs-3 d-block mb-2"></i>
                                Gestionar Pedidos
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('cliente.index') }}" class="btn btn-outline-warning w-100 py-3">
                                <i class="bi bi-people fs-3 d-block mb-2"></i>
                                Gestionar Clientes
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger w-100 py-3">
                                    <i class="bi bi-box-arrow-right fs-3 d-block mb-2"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection