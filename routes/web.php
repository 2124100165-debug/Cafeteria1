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

// 1. Administrador (Busca: administrador.crear / administrador.index)
Route::get('/administradores', [AdministradorController::class, 'listado'])->name('administrador.index');
Route::get('/administradores/crear', [AdministradorController::class, 'formulario'])->name('administrador.crear');

// 2. Cliente (Busca: cliente.crear / cliente.index)
Route::get('/clientes', [ClienteController::class, 'listado'])->name('cliente.index');
Route::get('/clientes/crear', [ClienteController::class, 'formulario'])->name('cliente.crear');

// 3. Proveedores (Busca: proveedor.crear / proveedor.index)
Route::get('/proveedores', [ProveedorController::class, 'listado'])->name('proveedor.index');
Route::get('/proveedores/crear', [ProveedorController::class, 'formulario'])->name('proveedor.crear');

// 4. Categorías (Busca: categoria.crear / categoria.index)
Route::get('/categorias', [CategoriaController::class, 'listado'])->name('categoria.index');
Route::get('/categorias/crear', [CategoriaController::class, 'formulario'])->name('categoria.crear');

// 5. Productos (Busca: producto.crear / producto.index)
Route::get('/productos', [ProductoController::class, 'listado'])->name('producto.index');
Route::get('/productos/crear', [ProductoController::class, 'formulario'])->name('producto.crear');

// 6. Pedido (Busca: pedido.crear / pedido.index)
Route::get('/pedidos', [PedidoController::class, 'listado'])->name('pedido.index');
Route::get('/pedidos/crear', [PedidoController::class, 'formulario'])->name('pedido.crear');

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