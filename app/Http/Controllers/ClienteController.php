<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
   

    public function formulario()
    {
        return view('cliente.form-cliente');
    }

  
    public function listado()
    {
        $clientes = Cliente::all();

        return view('cliente.list-cliente', compact('clientes'));
    }
}