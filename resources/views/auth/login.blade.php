@extends('layouts.app')

@section('titulo', 'Iniciar Sesión - Kraneo Café')

@section('contenido')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card bg-black text-white border-dorado-kraneo border-2 shadow-lg">
                <div class="card-header border-bottom border-dorado-kraneo text-center py-4">
                    <h3 class="text-dorado-kraneo mb-0 font-montserrat fw-bold">
                        <i class="bi bi-shield-lock-fill"></i> Acceso Administrativo
                    </h3>
                </div>
                <div class="card-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger bg-dark text-danger border-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="usuario" class="form-label text-dorado-kraneo fw-bold">Usuario</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-dorado-kraneo">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" class="form-control bg-dark text-white border-secondary" id="usuario" name="usuario" value="{{ old('usuario') }}" placeholder="Ingresa tu usuario" required autofocus>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-dorado-kraneo fw-bold">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-dark border-secondary text-dorado-kraneo">
                                    <i class="bi bi-key-fill"></i>
                                </span>
                                
                                <input type="password" class="form-control bg-dark text-white border-secondary" id="password" name="contraseña" placeholder="Ingresa tu contraseña" required>
                                
                                <button class="btn btn-outline-secondary bg-dark border-secondary text-dorado-kraneo" type="button" id="togglePassword">
                                    <i class="bi bi-eye-fill" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-warning fw-bold text-black py-2">
                                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                            </button>
                        </div>

                        <div class="text-center my-4 position-relative">
                            <hr class="text-secondary opacity-25">
                            <span class="position-absolute top-50 start-50 translate-middle bg-black px-3 text-muted small fw-semibold" style="letter-spacing: 1px;">Ó</span>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ url('/login/google') }}" class="btn btn-outline-light d-flex align-items-center justify-content-center py-2 fw-semibold">
                                <i class="bi bi-google me-2 text-danger"></i> Continuar con Google
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');
        const eyeIcon = document.querySelector('#eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Cambia el tipo de input entre password y text
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Alterna el icono del ojo abierto / cerrado
            if (type === 'text') {
                eyeIcon.classList.remove('bi-eye-fill');
                eyeIcon.classList.add('bi-eye-slash-fill');
            } else {
                eyeIcon.classList.remove('bi-eye-slash-fill');
                eyeIcon.classList.add('bi-eye-fill');
            }
        });
    });
</script>
@endpush