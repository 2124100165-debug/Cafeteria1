<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; // Requerido para la tarea

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

    public function guardar(Request $request)
    {
        // Se mantiene validación básica para el registro
        $request->validate([
            'nombres'     => 'required|max:100',
            'apellidos'   => 'required|max:100',
            'email'       => 'required|email|max:150|unique:clientes,email|confirmed', 
            'password'    => 'required|min:3|confirmed',
            'telefono'    => 'nullable|max:20',
            'direccion'   => 'nullable|max:255',
            'estado'      => 'required|in:Activo,Inactivo',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $cliente = new Cliente();
        $cliente->nombres   = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->email     = $request->input('email');
        $cliente->password  = Hash::make($request->input('password')); 
        $cliente->telefono  = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->estado    = $request->input('estado');

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/clientes'), $nombreImagen); 
            $cliente->imagen = 'imagenes/clientes/' . $nombreImagen;
        } else {
            $cliente->imagen = 'default-user.jpg';
        }

        $cliente->save();

        return redirect()->route('cliente.index')->with('status', '¡Cliente registrado con éxito!');
    }

    public function editar($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return redirect()->route('cliente.index')->with('error', 'Cliente no encontrado.');
        }
        return view('cliente.edit-cliente', compact('cliente'));
    }

    public function actualizar(Request $request, $id)
    {
        // 1. Validar que el ID exista (Requisito de la tarea)
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return redirect()->route('cliente.index')->with('error', 'Cliente no encontrado.');
        }

        // 2. Implementar validación con la clase Validator (Requisito de la tarea)
        $validator = Validator::make($request->all(), [
            'nombres'     => 'required|max:100',
            'apellidos'   => 'required|max:100',
            'email'       => 'required|email|max:150|unique:clientes,email,' . $id . ',id_cliente', 
            'password'    => 'nullable|min:3|confirmed',
            'telefono'    => 'nullable|max:20',
            'direccion'   => 'nullable|max:255',
            'estado'      => 'required|in:Activo,Inactivo',
            'imagen'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'password.confirmed' => 'Las contraseñas no coinciden.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // 3. Procesar actualización
        $cliente->nombres   = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->email     = $request->input('email');
        
        if ($request->filled('password')) {
            $cliente->password  = Hash::make($request->input('password')); 
        }
        
        $cliente->telefono  = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->estado    = $request->input('estado');

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/clientes'), $nombreImagen); 
            $cliente->imagen = 'imagenes/clientes/' . $nombreImagen;
        }

        $cliente->save();

        return redirect()->route('cliente.index')->with('status', '¡Cliente actualizado con éxito!');
    }

    public function mostrar($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return redirect()->route('cliente.index')->with('error', 'Cliente no encontrado.');
        }
        return view('cliente.Ver-cliente', compact('cliente'));
    }

    // Lógica de Borrado Lógico (Soft Delete)
    public function eliminarLog($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('clientes.index')->with('error', 'Cliente no encontrado.');
        }

        // Cambiamos el estado en lugar de borrar físicamente
        $cliente->estado = 'Inactivo';
        $cliente->save();

        return redirect()->route('cliente.index')->with('success', 'Cliente desactivado correctamente.');
    }
}

