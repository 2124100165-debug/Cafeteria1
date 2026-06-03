@extends('Layouts.app')

@section('titulo', 'Registrar Proveedor | Kraneo Café')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Registrar Nuevo Proveedor</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('proveedor.guardar') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre_empresa" class="form-label">Nombre de la Empresa</label>
                        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" placeholder="Ej. Distribuidora Café Premium" required>
                    </div>

                    <div class="mb-3">
                        <label for="contacto_nombre" class="form-label">Nombre del Contacto</label>
                        <input type="text" class="form-control" id="contacto_nombre" name="contacto_nombre" placeholder="Ej. Carlos Slim" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej. 5512345678" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rfc" class="form-label">RFC</label>
                            <input type="text" class="form-control" id="rfc" name="rfc" placeholder="Ej. DCP950101AAA" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ej. CDMX" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('proveedor.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning text-dark fw-bold">Guardar Proveedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection