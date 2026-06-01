<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function listado()
    {
        return view('pedido.list-ped');
    }

    public function formulario()
    {
        return view('pedido.form-ped');
    }
}