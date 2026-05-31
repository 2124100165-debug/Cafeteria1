@extends('layouts.app')

@section('titulo', 'Registro de Pedido')

@section('contenido')
<div class="container mt-4">
    <h2>Registrar Nuevo Pedido</h2>
    <hr>
    {{-- La action quedará lista para tu ruta de guardado --}}
    <form action="#" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-3">
                <label>id_cliente</label>
                <input type="number" name="id_cliente" class="form-control" placeholder="ID del cliente">
            </div>
            <div class="col-md-4 mb-3">
                <label>subtotal</label>
                <input type="number" step="0.01" name="subtotal" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>descuento_total</label>
                <input type="number" step="0.01" name="descuento_total" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>iva</label>
                <input type="number" step="0.01" name="iva" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>total</label>
                <input type="number" step="0.01" name="total" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>estado</label>
                <select name="estado" class="form-control">
                    <option value="Pendiente">Pendiente</option>
                    <option value="Preparando">Preparando</option>
                    <option value="Entregado">Entregado</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Registro</button>
        <a href="{{ route('pedido.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection