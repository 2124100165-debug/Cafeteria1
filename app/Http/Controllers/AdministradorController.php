<?php

namespace App\Http\Controllers;

use App\Models\Administrador; // Importa su modelo
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function listado()
    {
        $administradores = [
            (object) ['id_admin' => 1, 'imagen_url' => '', 'nombres' => 'Carlos', 'apellidos' => 'Mendoza', 'usuario' => 'cmendoza', 'email' => 'carlos@kraneocafe.com', 'rol' => 'Administrador', 'estado' => 'Activo'],
            (object) ['id_admin' => 2, 'imagen_url' => '', 'nombres' => 'Ana', 'apellidos' => 'García', 'usuario' => 'agarcia', 'email' => 'ana@kraneocafe.com', 'rol' => 'Barista', 'estado' => 'Inactivo'],
        ];

        return view('administrador.list-admin', compact('administradores'));
    }

    public function formulario()
    {
        return view('administrador.form-admin');
    }
}