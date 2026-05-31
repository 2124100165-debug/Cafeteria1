@extends('Layouts.app')

@section('titulo', 'Listado de Pagos - Kraneo Café')

@section('contenido')
<div class="container mt-4">
    {{-- Encabezado del Módulo --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dorado-kraneo mb-0">Historial de Transacciones</h2>
        <a href="{{ route('pagos.crear') }}" class="btn btn-warning fw-bold text-black">
            + Registrar Pago
        </a>
    </div>

    {{-- Tabla de Historial con el estilo de Kraneo Café --}}
    <div class="table-responsive shadow-lg rounded border border-dorado-kraneo border-2">
        <table class="table table-dark table-striped table-hover align-middle mb-0">
            <thead class="table-black border-bottom border-dorado-kraneo">
                <tr class="text-dorado-kraneo">
                    <th scope="col" class="py-3 ps-3">ID Pago</th>
                    <th scope="col" class="py-3">ID Pedido</th>
                    <th scope="col" class="py-3">Fecha y Hora</th>
                    <th scope="col" class="py-3">Método</th>
                    <th scope="col" class="py-3">Monto</th>
                    <th scope="col" class="py-3 text-center">Estado</th>
                    <th scope="col" class="py-3 text-center pe-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pagos as $pago)
                    <tr>
                        <td class="text-dorado-kraneo fw-bold ps-3">#{{ $pago->id_pago }}</td>
                        <td class="fw-bold text-white-50">#{{ $pago->id_pedido }}</td>
                        <td>{{ $pago->fecha_pago }}</td>
                        <td>
                            {{-- Iconos rápidos o texto estilizado según el método --}}
                            @if($pago->metodo_pago === 'Tarjeta')
                                <i class="bi bi-credit-card-2-back text-warning me-1"></i> Tarjeta
                            @elseif($pago->metodo_pago === 'PayPal')
                                <i class="bi bi-paypal text-info me-1"></i> PayPal
                            @else
                                <i class="bi bi-cash text-success me-1"></i> Efectivo
                            @endif
                        </td>
                        <td class="fw-bold text-warning">${{ number_format($pago->monto, 2) }}</td>
                        <td class="text-center">
                            @if($pago->estado === 'Aprobado')
                                <span class="badge bg-success px-3 py-2 text-uppercase" style="letter-spacing: 0.5px;">Aprobado</span>
                            @else
                                <span class="badge bg-warning text-black px-3 py-2 text-uppercase" style="letter-spacing: 0.5px;">Pendiente</span>
                            @endif
                        </td>
                        <td class="text-center pe-3">
                            <div class="btn-group" role="group">
                                <a href="#" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-eye"></i> Detalle
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-exclamation-circle fs-2 d-block mb-2 text-dorado-kraneo"></i>
                            <p class="mb-0 fs-5">No se encontraron registros de pagos en el sistema.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection