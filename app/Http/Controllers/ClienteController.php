<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function listado()
    {
        $clientes = [
            (object) ['id_cliente' => 1, 'imagen' => '', 'nombres' => 'Alejandro', 'apellidos' => 'Fernández', 'email' => 'ale@gmail.com', 'telefono' => '33387658', 'direccion' => 'Calle Falsa 123'],
            (object) ['id_cliente' => 2, 'imagen' => '', 'nombres' => 'María', 'apellidos' => 'López', 'email' => 'maria@correo.com', 'telefono' => '33123456', 'direccion' => 'Av. Siempre Viva 45'],
        ];

        return view('cliente.list-client', compact('clientes'));
    }

    public function formulario()
    {
        return view('cliente.form-client');
    }
}