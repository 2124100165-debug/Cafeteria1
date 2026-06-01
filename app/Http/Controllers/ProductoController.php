<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listado()
    {
        $productos = [
            (object) ['id_producto' => 1, 'nombre' => 'Capuccino', 'categoria' => 'Bebidas Calientes', 'precio' => 45.00, 'stock' => 50],
            (object) ['id_producto' => 2, 'nombre' => 'Frappé Moka', 'categoria' => 'Bebidas Frías', 'precio' => 65.50, 'stock' => 10],
        ];

        return view('productos.list-prod', compact('productos'));
    }

    public function formulario()
    {
        return view('productos.form-Prod');
    }
}