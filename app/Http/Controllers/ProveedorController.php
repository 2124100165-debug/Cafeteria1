<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function listado()
    {
        $proveedores = [
            (object) ['id_proveedor' => 1, 'nombre' => 'Distribuidora Central', 'contacto' => 'Juan Pérez', 'telefono' => '3334445555', 'empresa' => 'Café de Altura S.A.'],
            (object) ['id_proveedor' => 2, 'nombre' => 'Insumos Kraneo', 'contacto' => 'Ana López', 'telefono' => '3311223344', 'empresa' => 'Granos Premium S.A.'],
        ];

        return view('proveedores.list-prov', compact('proveedores'));
    }

    public function formulario()
    {
        return view('proveedores.form-prov');
    }
}