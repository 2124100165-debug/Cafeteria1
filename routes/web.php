<?php

use Illuminate\Support\Facades\Route;

// =========================================================================
// 1. IMPORTACIÓN EXPLÍCITA DE CONTROLADORES
// =========================================================================
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoPresentacionController;
use App\Http\Controllers\ProveedorController;

// Vista de inicio base (Cascarón principal)
Route::view('/', 'inicio')->name('inicio');

// =========================================================================
// 2. REGISTRO DE RUTAS MEDIANTE CONTROLADORES ACOPLADOS A TU MENÚ DINÁMICO
// =========================================================================
// Listado de administradores (GET)
Route::get('/administrador', [AdministradorController::class, 'listado'])->name('administrador.index');

// Formulario para crear (GET)
Route::get('/administrador/crear', [AdministradorController::class, 'formulario'])->name('administrador.crear');

// 🛠️ ACCIÓN DE GUARDAR (Debe ser POST obligatoriamente)
Route::post('/administrador/guardar', [AdministradorController::class, 'guardar'])->name('administrador.guardar');


// Módulo de Clientes (Se usa 'cliente' en singular para coincidir con tu app.blade.php)
Route::get('/clientes', [ClienteController::class, 'listado'])->name('cliente.index');
Route::get('/clientes/crear', [ClienteController::class, 'formulario'])->name('cliente.crear');
Route::post('/clientes/guardar', [ClienteController::class, 'guardar'])->name('cliente.guardar');

// 3. Proveedores (Busca: proveedor.crear / proveedor.index)
Route::get('/proveedores', [ProveedorController::class, 'listado'])->name('proveedor.index');
Route::get('/proveedores/crear', [ProveedorController::class, 'formulario'])->name('proveedor.crear');
Route::post('/proveedores/guardar', [ProveedorController::class, 'guardar'])->name('proveedor.guardar');



// =========================================================================
// MÓDULO DE CATEGORÍAS (VERIFICACIÓN FINAL)
// =========================================================================

// 1. Debe llamarse 'categorias.index' para que funcione el listado y el botón "Ver Listado"
Route::get('/categorias', [CategoriaController::class, 'listado'])->name('categorias.index');

// 2. Debe llamarse 'categorias.crear' para alimentar la barra de navegación dinámica sin errores
Route::get('/categorias/crear', [CategoriaController::class, 'formulario'])->name('categorias.crear');

// 3. Debe llamarse 'categorias.guardar' para que coincida con el action de tu formulario POST
Route::post('/categorias/guardar', [CategoriaController::class, 'guardar'])->name('categorias.guardar');

// 5. Productos (Busca: producto.crear / producto.index)
Route::get('/productos', [ProductoController::class, 'listado'])->name('producto.index');
Route::get('/productos/crear', [ProductoController::class, 'formulario'])->name('producto.crear');
Route::post('/productos/guardar', [ProductoController::class, 'guardar'])->name('producto.guardar');


// 6. Pedido (Busca: pedido.crear / pedido.index)
Route::get('/pedidos', [PedidoController::class, 'listado'])->name('pedido.index');
Route::get('/pedidos/crear', [PedidoController::class, 'formulario'])->name('pedido.crear');
Route::post('/pedidos/guardar', [PedidoController::class, 'guardar'])->name('pedido.guardar');

// 7. Pagos (Busca: pagos.crear / pagos.index)
Route::get('/pagos', [PagoController::class, 'listado'])->name('pagos.index');
Route::get('/pagos/crear', [PagoController::class, 'formulario'])->name('pagos.crear');
Route::post('/pagos/guardar', [PagoController::class, 'guardar'])->name('pagos.guardar');

// 8. Detalles (Busca: detalle_pedidos.crear / detalle_pedidos.index)
Route::get('/detalles-pedidos', [DetallePedidoController::class, 'listado'])->name('detalle_pedidos.index');
Route::get('/detalles-pedidos/crear', [DetallePedidoController::class, 'formulario'])->name('detalle_pedidos.crear');

// 9. Presentaciones (Busca: producto_presentaciones.crear / producto_presentaciones.index)
Route::get('/presentaciones-productos', [ProductoPresentacionController::class, 'listado'])->name('producto_presentaciones.index');
Route::get('/presentaciones-productos/crear', [ProductoPresentacionController::class, 'formulario'])->name('producto_presentaciones.crear');