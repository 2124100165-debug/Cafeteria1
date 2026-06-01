<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    public function listado()
    {
        return view('detallesPed.list-detPed');
    }

    public function formulario()
    {
        return view('detallesPed.form-detPed');
    }
}