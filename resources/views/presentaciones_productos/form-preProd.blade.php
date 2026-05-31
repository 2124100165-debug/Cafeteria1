@extends('layouts.app')

@section('titulo', 'Registro de Presentación')

@section('contenido')
<div class="container mt-4">
    <h2>Registrar Presentación</h2>
    <hr>
    <form action="#" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>id_producto</label>
                <input type="number" name="id_producto" class="form-control" placeholder="ID del producto asociado">
            </div>
            <div class="col-md-6 mb-3">
                <label>nombre_presentacion</label>
                <input type="text" name="nombre_presentacion" class="form-control" placeholder="Ej: Chico, Mediano, Grande">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>precio</label>
                <input type="number" step="0.01" name="precio" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>stock</label>
                <input type="number" name="stock" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>estado</label>
                <select name="estado" class="form-control">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Presentación</button>
        <a href="{{ route('producto_presentaciones.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection