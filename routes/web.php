<?php

use Illuminate\Support\Facades\Route;

// 1. IMPORTACIÓN EXPLÍCITA DE CONTROLADORES
// 
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoPresentacionController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Str;

// Vista de inicio base (Pública)
Route::view('/', 'inicio')->name('inicio');
// Ruta para API de tipo de cambio (Pública)
Route::get('/api/datos', [ApiController::class, 'datos'])->name('api.datos');
// Rutas de Autenticación Públicas
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
// Rutas de Socialite (Acceso con Google)
Route::get('/auth/google', function () { return Socialite::driver('google')->redirect();})->name('google.login'); // Mantenemos el nombre que elegiste

Route::get('/auth/google/callback', function () {
    try {
        $googleUser = Socialite::driver('google')->user();
        
        // 1. Buscamos si el correo existe en tu tabla real 'administradores'
        $admin = Administrador::where('email', $googleUser->getEmail())->first();
        
        if (!$admin) {
            // OPCIÓN ESTRICTA: Si no existe, no lo dejamos registrarse solo. Lo mandamos al login con error.
            return redirect()->route('login')->with('error', 'El correo de Google no pertenece a un administrador autorizado.');
        }

        // 2. Validamos contra tu columna real 'activo' (1 = Activo, 0 = Inactivo)
        if ($admin->activo == 0) {
            return redirect()->route('login')->with('error', 'Esta cuenta administrativa se encuentra inactiva.');
        }

        // 3. LOGUEAR EN EL GUARD 'admin' QUE TIENEN TUS RUTAS PROTEGIDAS
        Auth::guard('admin')->login($admin);

        // Redirección exitosa al dashboard protegido
        return redirect()->route('dashboard')->with('success', '¡Autenticado con Google con éxito!');

    } catch (\Exception $e) {
        return redirect()->route('login')->with('error', 'Error al conectar con Google.');
    }
});

// 2. ACCESO RESTRINGIDO (Middleware de Autenticación con Guard 'admin')//
Route::middleware(['auth:admin'])->group(function () {
    
    // Vista de Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Ruta de Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        // 2.1 Módulo Administradores
    Route::get('/administrador', [AdministradorController::class, 'listado'])->name('administrador.index');
    Route::get('/administrador/crear', [AdministradorController::class, 'formulario'])->name('administrador.crear');
    Route::post('/administrador/guardar', [AdministradorController::class, 'guardar'])->name('administrador.guardar');
    Route::get('/administrador/editar/{id}', [AdministradorController::class, 'editar'])->name('administrador.editar');
    Route::post('/administrador/actualizar/{id}', [AdministradorController::class, 'actualizar'])->name('administrador.actualizar');
    Route::post('/administrador/eliminarLog/{id}', [AdministradorController::class, 'eliminarLog'])->name('administrador.eliminarLog'); // Ruta para eliminar lógicamente (soft delete)
    Route::get('/administrador/mostrar/{id}', [AdministradorController::class, 'ver'])->name('administrador.mostrar');// Ruta para ver detalles del administrador
    Route::post('/administrador/storage-link', function () {Artisan::call('storage:link'); return 'Enlace simbólico creado exitosamente.';})->name('administrador.storage-link'); // Ruta para crear el enlace simbólico de almacenamiento (si es necesario)


// 2.2 Módulo Clientes
   // 2.2 Módulo Clientes
    Route::get('/clientes', [ClienteController::class, 'listado'])->name('cliente.index');
    Route::get('/clientes/crear', [ClienteController::class, 'formulario'])->name('cliente.crear');
    Route::post('/clientes/guardar', [ClienteController::class, 'guardar'])->name('cliente.guardar');
    Route::get('/clientes/{id}/editar', [ClienteController::class, 'editar'])->name('cliente.edit');
    Route::post('/clientes/actualizar/{id}', [ClienteController::class, 'actualizar'])->name('cliente.actualizar');
    Route::get('/clientes/mostrar/{id}', [ClienteController::class, 'ver'])->name('cliente.mostrar');
    Route::post('/clientes/eliminarLog/{id}', [ClienteController::class, 'eliminarLog'])->name('cliente.eliminarLog');
    Route::post('/clientes/storage-link', function () {Artisan::call('storage:link'); return 'Enlace simbólico creado exitosamente.';})->name('cliente.storage-link'); // Ruta para crear el enlace simbólico de almacenamiento (si es necesario)

    // 2.3 Módulo Proveedores
    Route::get('/proveedores', [ProveedorController::class, 'listado'])->name('proveedor.index');
    Route::get('/proveedores/crear', [ProveedorController::class, 'formulario'])->name('proveedor.crear');
    Route::post('/proveedores/guardar', [ProveedorController::class, 'guardar'])->name('proveedor.guardar');
    Route::get('/proveedores/mostrar/{id}', [ProveedorController::class, 'mostrar'])->name('proveedor.mostrar');
    Route::post('/proveedores/eliminar/{id}', [ProveedorController::class, 'eliminar'])->name('proveedor.eliminar');

    // 2.4 Módulo Categorías
    Route::get('/categorias', [CategoriaController::class, 'listado'])->name('categorias.index');
    Route::get('/categorias/crear', [CategoriaController::class, 'formulario'])->name('categorias.crear');
    Route::post('/categorias/guardar', [CategoriaController::class, 'guardar'])->name('categorias.guardar');
    Route::get('/categorias/editar/{id}', [CategoriaController::class, 'editar'])->name('categorias.editar');
    Route::post('/categorias/actualizar/{id}', [CategoriaController::class, 'actualizar'])->name('categorias.actualizar');
    Route::post('/categorias/eliminarLog/{id}', [CategoriaController::class, 'eliminarLog'])->name('categorias.eliminarLog');
    Route::get('/categorias/mostrar/{id}', [CategoriaController::class, 'mostrar'])->name('categorias.mostrar');

    // 2.5 Módulo Productos
    Route::get('/productos', [ProductoController::class, 'listado'])->name('producto.index');
    Route::get('/productos/crear', [ProductoController::class, 'formulario'])->name('producto.crear');
    Route::post('/productos/guardar', [ProductoController::class, 'guardar'])->name('producto.guardar');
    Route::get('/productos/mostrar/{id}', [ProductoController::class, 'mostrar'])->name('producto.mostrar');
    Route::post('/productos/eliminar/{id}', [ProductoController::class, 'eliminar'])->name('producto.eliminar');

    // 2.6 Módulo Pedidos
    Route::get('/pedidos', [PedidoController::class, 'listado'])->name('pedido.index');
    Route::get('/pedidos/crear', [PedidoController::class, 'formulario'])->name('pedido.crear');
    Route::post('/pedidos/guardar', [PedidoController::class, 'guardar'])->name('pedido.guardar');
    Route::get('/pedidos/mostrar/{id}', [PedidoController::class, 'mostrar'])->name('pedido.mostrar');
    Route::post('/pedidos/eliminar/{id}', [PedidoController::class, 'eliminar'])->name('pedido.eliminar');

    // 2.7 Módulo Pagos
    Route::get('/pagos', [PagoController::class, 'listado'])->name('pagos.index');
    Route::get('/pagos/crear', [PagoController::class, 'formulario'])->name('pagos.crear');
    Route::post('/pagos/guardar', [PagoController::class, 'guardar'])->name('pagos.guardar');

    // 2.8 Módulo Detalles
    Route::get('/detalles-pedidos', [DetallePedidoController::class, 'listado'])->name('detalle_pedidos.index');
    Route::get('/detalles-pedidos/crear', [DetallePedidoController::class, 'formulario'])->name('detalle_pedidos.crear');

    // 2.9 Módulo Presentaciones
    Route::get('/presentaciones-productos', [ProductoPresentacionController::class, 'listado'])->name('producto_presentaciones.index');
    Route::get('/presentaciones-productos/crear', [ProductoPresentacionController::class, 'formulario'])->name('producto_presentaciones.crear');
});