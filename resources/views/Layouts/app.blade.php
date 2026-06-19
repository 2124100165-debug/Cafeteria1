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

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="kraneo-body">

    <header class="kraneo-header container">
        <img src="{{ asset('imagen/logo.png') }}"
             alt="Logo Kraneo Café"
             class="kraneo-logo">

        <h1 class="kraneo-title">Kraneo Café</h1>

        <p class="kraneo-subtitle">
            Café artesanal con estilo único
        </p>
    </header>

    <nav class="navbar navbar-expand-lg kraneo-navbar">
        <div class="container-fluid px-4">

            <button class="navbar-toggler navbar-dark bg-dark"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link kraneo-link" href="/">
                            Inicio
                        </a>
                    </li>

                    @php
                        $menus = [
                            'Administrador'  => 'administrador',
                            'Cliente'        => 'cliente',
                            'Proveedores'    => 'proveedor',
                            'Categorías'     => 'categorias',
                            'Productos'      => 'producto',
                            'Pedido'         => 'pedido',
                            'Pagos'          => 'pagos',
                            'Detalles'       => 'detalle_pedidos',
                            'Presentaciones' => 'producto_presentaciones'
                        ];
                    @endphp

                    @foreach($menus as $label => $route)

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle kraneo-link"
                           href="#"
                           data-bs-toggle="dropdown">

                            {{ $label }}
                        </a>

                        <ul class="dropdown-menu kraneo-dropdown">

                            <li>
                                <a class="dropdown-item kraneo-dropdown-item"
                                   href="{{ route($route.'.crear') }}">
                                    Nuevo / Registro
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item kraneo-dropdown-item"
                                   href="{{ route($route.'.index') }}">
                                    Ver Listado
                                </a>
                            </li>

                        </ul>

                    </li>

                    @endforeach

                </ul>

            </div>

        </div>
    </nav>

    <!-- PANEL DE GEOLOCALIZACIÓN -->
    <div class="container mt-3">

        <div class="card shadow api-card">

            <div class="card-header api-header">

                <i class="bi bi-geo-alt-fill"></i>
                Información de Ubicación, Clima y Tipo de Cambio

            </div>

            <div class="card-body info-api">

                <div class="row text-center">

                    <!-- UBICACIÓN -->
                    <div class="col-md-4">

                        <h5>
                            <i class="bi bi-globe-americas"></i>
                            Ubicación
                        </h5>

                        <p>
                            <strong>Ciudad:</strong>
                            <span id="ciudad">Cargando...</span>
                        </p>

                        <p>
                            <strong>Estado:</strong>
                            <span id="estado">Cargando...</span>
                        </p>

                        <p>
                            <strong>País:</strong>
                            <span id="pais">Cargando...</span>
                        </p>

                    </div>

                    <!-- CLIMA -->
                    <div class="col-md-4">

                        <h5>
                            <i class="bi bi-cloud-sun-fill"></i>
                            Clima
                        </h5>

                        <p>
                            <strong>Temperatura:</strong>
                            <span id="temp">--</span> °C
                        </p>

                        <p>
                            <strong>Humedad:</strong>
                            <span id="humedad">--</span> %
                        </p>

                        <p>
                            <strong>Probabilidad de lluvia:</strong>
                            <span id="lluvia">--</span>
                        </p>

                    </div>

                    <!-- TIPO DE CAMBIO -->
                    <div class="col-md-4">

                        <h5>
                            <i class="bi bi-currency-dollar"></i>
                            Tipo de Cambio
                        </h5>

                        <p>
                            <strong>1 USD → MXN:</strong>
                            $<span id="tipoCambio">--</span>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <main class="container kraneo-main">
        @yield('contenido')
    </main>

    <footer class="kraneo-footer">
        <p>© 2026 Kraneo Café - Sistema de Gestión de Base de Datos</p>
    </footer>

</body>
</html>