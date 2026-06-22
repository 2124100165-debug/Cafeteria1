<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Pedido;

class AdminController extends Controller
{
    /**
     * Muestra la pantalla del Dashboard Administrativo.
     */
    public function index()
    {
        // Obtener estadísticas rápidas para poblar el dashboard y hacerlo premium
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $totalClientes = Cliente::count();
        $totalPedidos = Pedido::count();

        return view('dashboard', compact('totalProductos', 'totalCategorias', 'totalClientes', 'totalPedidos'));
    }
}
