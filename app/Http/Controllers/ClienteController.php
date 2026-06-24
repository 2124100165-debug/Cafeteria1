<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; // Fachada para la limpieza opcional de fotos viejas

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

    public function ver($id)
{
    $cliente = Cliente::find($id);
    
    if (!$cliente) {
        return redirect()->route('cliente.index')->with('error', 'Cliente no encontrado.');
    }

    return view('cliente.Ver-cliente', compact('cliente'));
}

    public function guardar(Request $request)
    {
        $request->validate([
            'nombres'     => 'required|max:100',
            'apellidos'   => 'required|max:100',
            'email'       => 'required|email|max:150|unique:clientes,email|confirmed', 
            'password'    => 'required|min:3|confirmed',
            'telefono'    => 'nullable|max:20',
            'direccion'   => 'nullable|max:255',
            'estado'      => 'required|in:Activo,Inactivo',
            'imagen'      => 'required|image|mimes:jpeg,png,jpg|max:2048' // Cambiado a required
        ]);

        $cliente = new Cliente();
        $cliente->nombres   = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->email     = $request->input('email');
        $cliente->password  = Hash::make($request->input('password')); 
        $cliente->telefono  = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->estado    = $request->input('estado');
        
        $cliente->imagen    = 'imagenes/clientes/producto_default.jpg';
        $cliente->save();

        // Guardar archivo con el ID generado por el primer save
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            
            $nombreImagen = 'clientes_' . $cliente->id_cliente . '_1.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('imagenes/clientes', $nombreImagen, 'public');
            $cliente->imagen = url('storage/' . $ruta);
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
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return redirect()->route('cliente.index')->with('error', 'Cliente no encontrado.');
        }

        // Validación con Validator
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

        $cliente->nombres   = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->email     = $request->input('email');
        
        if ($request->filled('password')) {
            $cliente->password  = Hash::make($request->input('password')); 
        }
        
        $cliente->telefono  = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->estado    = $request->input('estado');

        // Procesar cambio de imagen siguiendo el formato de clase
        if ($request->hasFile('imagen')) {
            // Opcional: Borrar archivo viejo físico de storage si existe para optimizar espacio
            $nombreAnterior = basename($cliente->imagen);
            if ($nombreAnterior && Storage::disk('public')->exists('imagenes/clientes/' . $nombreAnterior)) {
                Storage::disk('public')->delete('imagenes/clientes/' . $nombreAnterior);
            }

            $file = $request->file('imagen');
            $nombreImagen = 'clientes_' . $cliente->id_cliente . '_1.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('imagenes/clientes', $nombreImagen, 'public');
            
            $cliente->imagen = url('storage/' . $ruta);
        }

        $cliente->save();

        return redirect()->route('cliente.index')->with('status', '¡Cliente actualizado con éxito!');
    }
}