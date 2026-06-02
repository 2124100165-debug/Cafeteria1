<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function listado()
    {
        // ⚡ ELOQUENT: Trae todos los proveedores reales
        $proveedores = Proveedor::all();

        return view('proveedores.list-prov', compact('proveedores'));
    }

    public function formulario()
    {
        return view('proveedores.form-prov');
    }
}