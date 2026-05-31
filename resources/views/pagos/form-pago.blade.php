@extends('Layouts.app')

@section('titulo', 'Registrar Pago | Kraneo Café')

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Tarjeta con el estilo rudo de Kraneo Café: Fondo negro, borde dorado y sombra --}}
            <div class="card bg-black text-white border-dorado-kraneo border-2 shadow-lg">
                <div class="card-header border-bottom border-dorado-kraneo text-center py-3">
                    <h3 class="text-dorado-kraneo mb-0">Registrar Nuevo Pago</h3>
                </div>
                <div class="card-body p-4">
                    {{-- CORRECCIÓN 1: Enlazamos a la ruta real en plural 'pagos.guardar' --}}
                    <form action="{{ route('pagos.guardar') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_pedidos" class="form-label text-dorado-kraneo fw-bold">ID Pedido Asociado</label>
                                <input type="number" class="form-control bg-dark text-white border-secondary" id="id_pedidos" name="id_pedidos" placeholder="Ej. 1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="metodo_pago" class="form-label text-dorado-kraneo fw-bold">Método de Pago</label>
                                <select class="form-select bg-dark text-white border-secondary" id="metodo_pago" name="metodo_pago" required onchange="toggleTarjetaCampos(this.value)">
                                    <option value="Tarjeta" selected>Tarjeta</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="PayPal">PayPal</option>
                                </select>
                            </div>
                        </div>

                        {{-- CAMPOS DINÁMICOS PARA TARJETA --}}
                        <div id="campos_tarjeta" class="p-3 mb-3 rounded border border-secondary bg-dark-eval">
                            <div class="mb-3">
                                <label for="nombre_tarjeta" class="form-label text-white-50">Nombre en la Tarjeta</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="nombre_tarjeta" name="nombre_tarjeta" placeholder="Ej. Juan Pérez">
                            </div>

                            <div class="mb-3">
                                <label for="numero_tarjeta" class="form-label text-white-50">Número de Tarjeta</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="numero_tarjeta" name="numero_tarjeta" placeholder="Ej. 4111111111111111">
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_expiration" class="form-label text-white-50">Fecha de Expiración</label>
                                    <input type="text" class="form-control bg-dark text-white border-secondary" id="fecha_expiration" name="fecha_expiration" placeholder="MM/AA">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cvv" class="form-label text-white-50">CVV</label>
                                    <input type="text" class="form-control bg-dark text-white border-secondary" id="cvv" name="cvv" placeholder="123">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="numero_transaccion" class="form-label text-dorado-kraneo fw-bold">Número de Transacción</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="numero_transaccion" name="numero_transaccion" placeholder="Ej. TXN001">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fecha_pago" class="form-label text-dorado-kraneo fw-bold">Fecha y Hora de Pago</label>
                                <input type="datetime-local" class="form-control bg-dark text-white border-secondary" id="fecha_pago" name="fecha_pago" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="monto" class="form-label text-dorado-kraneo fw-bold">Monto ($)</label>
                                <input type="number" step="0.01" class="form-control bg-dark text-white border-secondary" id="monto" name="monto" placeholder="0.00" required>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="estado_pago" class="form-label text-dorado-kraneo fw-bold">Estado del Pago</label>
                                <select class="form-select bg-dark text-white border-secondary" id="estado_pago" name="estado_pago" required>
                                    <option value="Aprobado">Aprobado</option>
                                    <option value="Pendiente">Pendiente</option>
                                </select>
                            </div>
                        </div>

                        {{-- Botones de Acción --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            {{-- CORRECCIÓN 2: Cambiado 'pago.index' por el plural 'pagos.index' --}}
                            <a href="{{ route('pagos.index') }}" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-warning text-dark fw-bold">Guardar Pago</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleTarjetaCampos(metodo) {
        const divTarjeta = document.getElementById('campos_tarjeta');
        if (metodo === 'Tarjeta') {
            divTarjeta.style.display = 'block';
        } else {
            divTarjeta.style.display = 'none';
        }
    }

    // Inicializar el estado al cargar la página por primera vez
    document.addEventListener("DOMContentLoaded", function() {
        toggleTarjetaCampos(document.getElementById('metodo_pago').value);
    });
</script>
@endsection