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
        // Trae todos los clientes reales desde MySQL
        $clientes = Cliente::all();

        return view('cliente.list-cliente', compact('clientes'));
    }

    // Guarda los datos mapeados exactamente como tu phpMyAdmin
    public function guardar(Request $request)
    {
        // A. Validación (Frena correos duplicados antes de que MySQL lance error)
        $request->validate([
            'nombres'    => 'required|max:100',
            'apellidos'  => 'required|max:100',
            'email'      => 'required|email|max:150|unique:clientes,email', // Evita clones
            'password'   => 'required|min:3',
            'telefono'   => 'nullable|max:20',
            'direccion'  => 'nullable|max:255',
            'estado'     => 'required|in:Activo,Inactivo',
            'foto_archivo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            // Mensaje personalizado en español
            'email.unique' => 'El correo electrónico "' . $request->input('email') . '" ya pertenece a un cliente registrado.'
        ]);

        // B. Crear instancia del Modelo Eloquent
        $cliente = new Cliente();

        // C. Mapeo EXACTO con las columnas de tu BD (nombres, apellidos, email, password...)
        $cliente->nombres   = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->email     = $request->input('email');
        $cliente->password  = $request->input('password'); // Puedes usar bcrypt() si lo requieres cifrado
        $cliente->telefono  = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->estado    = $request->input('estado');

        // 📸 PROCESAMIENTO DUAL DE LA IMAGEN DEL CLIENTE
        if ($request->hasFile('foto_archivo')) {
            $file = $request->file('foto_archivo');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/clientes'), $nombreImagen); 
            $cliente->imagen = 'imagenes/clientes/' . $nombreImagen; // Guarda la ruta local
        } elseif ($request->input('foto_url')) {
            $cliente->imagen = $request->input('foto_url'); // Guarda la URL de internet
        } else {
            $cliente->imagen = 'default-user.jpg'; // Imagen genérica si va vacío
        }

        // D. Guardar en la Base de Datos
        $cliente->save();

        // Redirige al listado usando el alias en singular definido en tu app.blade.php
        return redirect()->route('cliente.index')->with('success', '¡Cliente registrado con éxito en el sistema!');
    }
}