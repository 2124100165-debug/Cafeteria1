@extends('layouts.app')

@section('titulo', 'Listado de Pedidos')

@section('contenido')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Listado de Pedidos</h2>
        <a href="{{ route('pedido.crear') }}" class="btn btn-success">+ Nuevo Pedido</a>
    </div>

    <table class="table table-striped table-hover border">
        <thead class="table-dark">
            <tr>
                <th>id_pedidos</th>
                <th>id_cliente</th>
                <th>fecha</th>
                <th>subtotal</th>
                <th>descuento_total</th>
                <th>iva</th>
                <th>total</th>
                <th>estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Cuando conectes la BD, aquí pondrás: @foreach($pedidos as $p) --}}
            <tr>
                <td>1</td>
                <td>1</td>
                <td>2026-05-27 22:31:36</td>
                <td>120.00</td>
                <td>12.00</td>
                <td>17.28</td>
                <td>125.28</td>
                <td><span class="badge bg-info">Entregado</span></td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">Editar</a>
                    <button class="btn btn-sm btn-danger">Borrar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection