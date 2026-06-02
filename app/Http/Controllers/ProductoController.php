<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Importación crucial del modelo Eloquent
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function listado()
    {
        // ⚡ ELOQUENT: Va a la base de datos y trae todos los registros de la tabla 'productos'
        $productos = Producto::all();

        return view('productos.list-prod', compact('productos'));
    }

    public function formulario()
    {
        return view('productos.form-Prod');
    }
}