<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function listado()
    {
        // ⚡ ELOQUENT: Trae todas las categorías reales
        $categorias = Categoria::all();

        return view('categorias.list-cat', compact('categorias'));
    }

    public function formulario()
    {
        return view('categorias.form-cat');
    }
}