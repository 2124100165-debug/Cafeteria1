@extends('Layouts.app')

@section('titulo', 'Detalle de Pedidos | Kraneo Café')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Listado de Detalles de Pedidos</h4>
                <a href="#" class="btn btn-warning btn-sm text-dark fw-bold">Nuevo Detalle</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>ID Pedido</th>
                                <th>ID Present.</th>
                                <th>Producto</th>
                                <th>Cant.</th>
                                <th>Precio Unit.</th>
                                <th>Desc. %</th>
                                <th>Desc. $</th>
                                <th>Subtotal</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí iría tu foreach de Laravel -->
                            <tr>
                                <td>1</td>
                                <td>1</td>
                                <td>3</td>
                                <td>Café Americano (Grande)</td>
                                <td>2</td>
                                <td>$60.00</td>
                                <td>10.00%</td>
                                <td>$12.00</td>
                                <td><strong>$108.00</strong></td>
                                <td>Sin azúcar</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">Editar</button>
                                    <button class="btn btn-sm btn-outline-danger">Borrar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection