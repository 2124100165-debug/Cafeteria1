<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'inicio')->name('inicio');

// 1. Administrador
Route::view('/administrador', 'administrador.list-admin')->name('administrador.index');
Route::view('/administrador/crear', 'administrador.form-admin')->name('administrador.crear');

Route::get('/administrador', function () {
    // Datos falsos para ver cómo queda la tabla
    $administradores = [
        (object) ['id_admin' => 1, 'imagen_url' => '', 'nombres' => 'Carlos', 'apellidos' => 'Mendoza', 'usuario' => 'cmendoza', 'email' => 'carlos@kraneocafe.com', 'rol' => 'Administrador', 'estado' => 'Activo'],
        (object) ['id_admin' => 2, 'imagen_url' => '', 'nombres' => 'Ana', 'apellidos' => 'García', 'usuario' => 'agarcia', 'email' => 'ana@kraneocafe.com', 'rol' => 'Barista', 'estado' => 'Inactivo'],
    ];

    return view('administrador.list-admin', compact('administradores'));
})->name('administrador.index');

// 2. Cliente
Route::view('/cliente', 'cliente.list-client')->name('cliente.index');
Route::view('/cliente/crear', 'cliente.form-client')->name('cliente.crear');

Route::get('/cliente', function () {
    // Datos de prueba para la vista de clientes
    $clientes = [
        (object) ['id_cliente' => 1, 'imagen' => '', 'nombres' => 'Alejandro', 'apellidos' => 'Fernández', 'email' => 'ale@gmail.com', 'telefono' => '33387658', 'direccion' => 'Calle Falsa 123'],
        (object) ['id_cliente' => 2, 'imagen' => '', 'nombres' => 'María', 'apellidos' => 'López', 'email' => 'maria@correo.com', 'telefono' => '33123456', 'direccion' => 'Av. Siempre Viva 45'],
    ];

    return view('cliente.list-client', compact('clientes'));
})->name('cliente.index');

// 3. Proveedores
Route::view('/proveedor', 'proveedores.list-prov')->name('proveedor.index');
Route::view('/proveedor/crear', 'proveedores.form-prov')->name('proveedor.crear');

Route::get('/proveedor', function () {
    // Datos falsos para el listado
    $proveedores = [
        (object) ['id_proveedor' => 1, 'nombre' => 'Distribuidora Central', 'contacto' => 'Juan Pérez', 'telefono' => '3334445555', 'empresa' => 'Café de Altura S.A.'],
        (object) ['id_proveedor' => 2, 'nombre' => 'Insumos Kraneo', 'contacto' => 'Ana López', 'telefono' => '3311223344', 'empresa' => 'Granos Premium S.A.'],
    ];

    return view('proveedores.list-prov', compact('proveedores'));
})->name('proveedor.index');

// 4. Categorías
Route::view('/categoria', 'categorias.list-cat')->name('categoria.index');
Route::view('/categoria/crear', 'categorias.form-cat')->name('categoria.crear');

Route::get('/categoria', function () {
    // Datos de prueba para el listado de categorías
    $categorias = [
        (object) [
            'id_categoria' => 1, 
            'imagen' => 'heladas.jpg', 
            'nombre_categoria' => 'Bebidas Heladas', 
            'descripcion' => 'Frappés, smoothies y cafés con hielo.', 
            'estado' => 'Activo'
        ],
        (object) [
            'id_categoria' => 2, 
            'imagen' => 'reposteria.png', 
            'nombre_categoria' => 'Repostería', 
            'descripcion' => 'Pasteles, galletas y pan dulce artesanal.', 
            'estado' => 'Activo'
        ],
    ];

    return view('categorias.list-cat', compact('categorias'));
})->name('categoria.index');

// 5. Productos
Route::view('/productos', 'productos.list-prod')->name('producto.index');
Route::view('/productos/crear', 'productos.form-Prod')->name('producto.crear');

Route::get('/productos', function () {
    // Estos son los datos de prueba
    $productos = [
        (object) ['id_producto' => 1, 'nombre' => 'Capuccino', 'categoria' => 'Bebidas Calientes', 'precio' => 45.00, 'stock' => 50],
        (object) ['id_producto' => 2, 'nombre' => 'Frappé Moka', 'categoria' => 'Bebidas Frías', 'precio' => 65.50, 'stock' => 10], // Stock bajo para probar la alerta
    ];

    //6.- Aquí enviamos la variable $productos a la vista
    return view('productos.list-prod', compact('productos'));
})->name('producto.index');
// 6. Pedido
Route::view('/pedido', 'pedido.list-ped')->name('pedido.index');
Route::view('/pedido/crear', 'pedido.form-ped')->name('pedido.crear');

// 7. Pagos
Route::view('/pagos', 'pagos.list-pago')->name('pagos.index');
Route::view('/pagos/crear', 'pagos.form-pago')->name('pagos.crear');

// Define la ruta aunque solo sea para que el "cascarón" no se rompa
Route::post('/pagos/guardar', function () {
    return redirect()->back(); // Esto hace que el formulario recargue la página en lugar de romperse
})->name('pagos.guardar');

Route::get('/pagos', function () {
    // Definimos datos de prueba (simulando registros de la base de datos)
    $pagos = [
        (object) ['id_pago' => 101, 'id_pedido' => 1, 'fecha_pago' => '2026-05-29 10:00', 'metodo_pago' => 'Tarjeta', 'monto' => 150.50, 'estado' => 'Aprobado'],
        (object) ['id_pago' => 102, 'id_pedido' => 2, 'fecha_pago' => '2026-05-29 11:30', 'metodo_pago' => 'PayPal', 'monto' => 85.00, 'estado' => 'Pendiente'],
    ];

    return view('pagos.list-pago', compact('pagos'));
})->name('pagos.index');

//8. detalles_ pedido
// Rutas exclusivas para maquetación (sin lógica ni envío de datos)
Route::view('/detalle-pedidos', 'detallesPed.list-detPed')->name('detalle_pedidos.index');
Route::view('/detalle-pedidos/crear', 'detallesPed.form-detPed')->name('detalle_pedidos.crear');
// 9. Presentaciones
Route::view('/producto_presentaciones', 'presentaciones_productos.list-preprod')->name('producto_presentaciones.index');
Route::view('/producto_presentaciones/crear', 'presentaciones_productos.form-preProd')->name('producto_presentaciones.crear');