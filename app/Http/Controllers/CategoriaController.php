<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function listado()
    {
        $categorias = [
            (object) ['id_categoria' => 1, 'imagen' => 'heladas.jpg', 'nombre_categoria' => 'Bebidas Heladas', 'descripcion' => 'Frappés, smoothies y cafés con hielo.', 'estado' => 'Activo'],
            (object) ['id_categoria' => 2, 'imagen' => 'reposteria.png', 'nombre_categoria' => 'Repostería', 'descripcion' => 'Pasteles, galletas y pan dulce artesanal.', 'estado' => 'Activo'],
        ];

        return view('categorias.list-cat', compact('categorias'));
    }

    public function formulario()
    {
        return view('categorias.form-cat');
    }
}