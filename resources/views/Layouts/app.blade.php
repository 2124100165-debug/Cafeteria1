<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Kraneo Café')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="kraneo-body">
    <header class="kraneo-header container">
        <img src="{{ asset('imagen/logo.png') }}" alt="Logo Kraneo Café" class="kraneo-logo">
        <h1 class="kraneo-title">Kraneo Café</h1>
        <p class="kraneo-subtitle">Café artesanal con estilo único</p>
    </header>

    <nav class="navbar navbar-expand-lg kraneo-navbar">
        <div class="container-fluid px-4">
            <button class="navbar-toggler navbar-dark bg-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link kraneo-link" href="/">Inicio</a></li>
                    
                    {{-- Dropdowns para cada tabla --}}
                    @php
                        //  CORREGIDO: Se cambiaron los nombres a plural ('categorias') 
                        // para que coincidan exactamente con tus alias de Route::get/post en web.php
                        $menus = [
                            'Administrador'  => 'administrador',
                            'Cliente'        => 'cliente',
                            'Proveedores'    => 'proveedor',
                            'Categorías'     => 'categorias', //  Cambiado de 'categoria' a 'categorias'
                            'Productos'      => 'producto',
                            'Pedido'         => 'pedido',
                            'Pagos'          => 'pagos',
                            'Detalles'       => 'detalle_pedidos',
                            'Presentaciones' => 'producto_presentaciones'
                        ];
                    @endphp

                    @foreach($menus as $label => $route)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle kraneo-link" href="#" data-bs-toggle="dropdown">{{ $label }}</a>
                        <ul class="dropdown-menu kraneo-dropdown">
                            {{-- Buscará correctamente 'categorias.crear' y 'categorias.index' --}}
                            <li><a class="dropdown-item kraneo-dropdown-item" href="{{ route($route.'.crear') }}">Nuevo / Registro</a></li>
                            <li><
                            <li><a class="dropdown-item kraneo-dropdown-item" href="{{ route($route.'.index') }}">Ver Listado</a></li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <main class="container kraneo-main">
        @yield('contenido')
    </main>

    <footer class="kraneo-footer">
        <p>© 2026 Kraneo Café - Sistema de Gestión de Base de Datos</p>
    </footer>
</body>
</html>