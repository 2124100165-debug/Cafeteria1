@extends('Layouts.app')

@section('titulo', 'Registrar Detalle de Pedido | Kraneo Café')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Registrar Nuevo Detalle</h4>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="id_pedidos" class="form-label">ID Pedido</label>
                            <input type="number" class="form-control" id="id_pedidos" name="id_pedidos" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_presentacion" class="form-label">ID Presentación</label>
                            <input type="number" class="form-control" id="id_presentacion" name="id_presentacion" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required placeholder="Ej. Café Americano (Grande)">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="precio_original_unitario" class="form-label">Precio Unitario ($)</label>
                            <input type="number" step="0.01" class="form-control" id="precio_original_unitario" name="precio_original_unitario" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="descuento_porcentaje" class="form-label">Descuento (%)</label>
                            <input type="number" step="0.01" class="form-control" id="descuento_porcentaje" name="descuento_porcentaje" max="60" placeholder="0.00">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="descuento_monto" class="form-label">Monto Descuento ($)</label>
                            <input type="number" step="0.01" class="form-control" id="descuento_monto" name="descuento_monto" readonly placeholder="0.00">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="subtotal" class="form-label">Subtotal ($)</label>
                            <input type="number" step="0.01" class="form-control" id="subtotal" name="subtotal" readonly required placeholder="0.00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="2" placeholder="Ej. Sin azúcar, extra espuma..."></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-secondary">Limpiar</button>
                        <button type="submit" class="btn btn-warning text-dark fw-bold">Guardar Detalle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection