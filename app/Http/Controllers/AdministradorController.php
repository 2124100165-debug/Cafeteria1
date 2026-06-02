<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function listado()
    {
        // ⚡ ELOQUENT: Trae todos los administradores reales
        $administradores = Administrador::all();

        return view('administrador.list-admin', compact('administradores'));
    }

    public function formulario()
    {
        return view('administrador.form-admin');
    }
}