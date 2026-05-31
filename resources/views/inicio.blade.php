@extends('layouts.app')

@section('titulo', 'Inicio | Kraneo Café')

@section('contenido')
<div class="row justify-content-center">
    <div class="col-md-10">
        
        <div id="carruselProductos" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carruselProductos" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carruselProductos" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carruselProductos" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner shadow-lg rounded">
                
                {{-- Producto 1 - Café --}}
                <div class="carousel-item active">
                    <img src="{{ asset('imagen/Principal/cafe.jpg') }}" class="d-block w-100 carousel-img" alt="Café Artesanal Especialidad">
                    <div class="carousel-caption d-none d-md-block carousel-caption-dark">
                        <h5 class="text-warning fw-bold">Café de Especialidad</h5>
                        <p>Granos seleccionados con un tostado perfecto.</p>
                    </div>
                </div>

                {{-- Producto 2 - Frappe --}}
                <div class="carousel-item">
                    <img src="{{ asset('imagen/Principal/frappe.jpg') }}" class="d-block w-100 carousel-img" alt="Métodos de Extracción">
                    <div class="carousel-caption d-none d-md-block carousel-caption-dark">
                        <h5 class="text-warning fw-bold">Métodos de Extracción</h5>
                        <p>Resaltamos las notas y aromas más puros de cada taza.</p>
                    </div>
                </div>

                {{-- Producto 3 - Postre --}}
                <div class="carousel-item">
                    <img src="{{ asset('imagen/Principal/postre.jpg') }}" class="d-block w-100 carousel-img" alt="Repostería Única">
                    <div class="carousel-caption d-none d-md-block carousel-caption-dark">
                        <h5 class="text-warning fw-bold">Acompañamientos Únicos</h5>
                        <p>El maridaje ideal con repostería recién horneada.</p>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carruselProductos" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carruselProductos" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>

        </div>
        
    </div>
</div>
@endsection