@extends('layouts.app')

@section('titulo', 'Listado de Presentaciones')

@section('contenido')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Presentaciones de Productos</h2>
        <a href="{{ route('producto_presentaciones.crear') }}" class="btn btn-success">+ Nueva Presentación</a>
    </div>

    <table class="table table-striped table-hover border">
        <thead class="table-dark">
            <tr>
                <th>id_presentacion</th>
                <th>id_producto</th>
                <th>nombre_presentacion</th>
                <th>precio</th>
                <th>stock</th>
                <th>estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>Chico</td>
                <td>35.00</td>
                <td>20</td>
                <td><span class="badge bg-success">Activo</span></td>
                <td>
                    <a href="#" class="btn btn-sm btn-warning">Editar</a>
                    <button class="btn btn-sm btn-danger">Borrar</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection