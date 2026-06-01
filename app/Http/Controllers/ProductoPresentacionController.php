<?php

namespace App\Http\Controllers;

use App\Models\ProductoPresentacion;
use Illuminate\Http\Request;

class ProductoPresentacionController extends Controller
{
    public function listado()
    {
        return view('presentaciones_productos.list-preprod');
    }

    public function formulario()
    {
        return view('presentaciones_productos.form-preProd');
    }
}