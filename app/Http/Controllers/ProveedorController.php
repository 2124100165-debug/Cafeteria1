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

     public function guardar(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor->nombre_empresa = $request->input('nombre_empresa');
        $proveedor->contacto_nombre = $request->input('contacto_nombre');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->rfc = $request->input('rfc');
        $proveedor->save();

        return redirect()->route('proveedor.index')->with('success', 'Proveedor creado exitosamente.');
    }

}