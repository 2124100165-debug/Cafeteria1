<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
class AdministradorController extends Controller
{
    /**
     * Muestra el listado de todos los administradores.
     */
    public function listado()
    {
        $administradores = Administrador::all();
        return view('administrador.list-admin', compact('administradores'));
    }

    /**
     * Muestra el formulario para crear un nuevo administrador.
     */
    public function formulario()
    {
        return view('administrador.form-admin');
    }

    /**
     * Procesa y guarda un nuevo administrador.
     */
    public function guardar(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'usuario' => 'required|string|unique:administradores,usuario',
            'email' => 'required|email|unique:administradores,email',
            'email_confirmation' => 'required|same:email',
            'password' => 'required|string|min:6',
        ], [
            'email_confirmation.same' => 'Los correos electrónicos introducidos no coinciden.',
        ]);

        $administrador = new Administrador();
        $administrador->nombres   = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->rol       = $request->input('rol');
        $administrador->usuario   = $request->input('usuario');
        $administrador->email     = $request->input('email');
        $administrador->password  = Hash::make($request->input('password')); 
        $administrador->estado    = 'Activo';

        $administrador->save();

        return redirect()->route('administrador.index')->with('success', '¡Personal registrado con éxito!');
    }

    /**
     * Muestra el formulario de edición.
     */
    public function editar($id_admin)
    {
        $administrador = Administrador::find($id_admin);
        
        if (!$administrador) {
            return redirect()->route('administrador.index')->with('error', 'Administrador no encontrado.');
        }

        return view('administrador.edit-admin', compact('administrador'));
    }

    /**
     * Procesa la actualización de un administrador.
     */
    public function actualizar(Request $request, $id)
    {
        $administrador = Administrador::find($id);
        if (!$administrador) {
            return redirect()->route('administrador.index')->with('error', 'Administrador no encontrado.');
        }

        $validator = Validator::make($request->all(), [
            'nombres'      => 'required|max:100',
            'apellidos'    => 'required|max:100',
            'email'        => 'required|email|max:150|unique:administradores,email,' . $id . ',id_admin',
            'usuario'      => 'required|max:50|unique:administradores,usuario,' . $id . ',id_admin',
            'rol'          => 'required|max:50',
            'estado'       => 'required|in:Activo,Inactivo',
            'password'     => 'nullable|min:3',
            'foto_url'     => 'nullable|url',
            'foto_archivo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $administrador->nombres   = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->email     = $request->input('email');
        $administrador->usuario   = $request->input('usuario');
        $administrador->rol       = $request->input('rol');
        $administrador->estado    = $request->input('estado');

        if ($request->filled('password')) {
            $administrador->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('foto_archivo')) {
            $file = $request->file('foto_archivo');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/personal'), $nombreImagen);
            $administrador->imagen_url = 'imagenes/personal/' . $nombreImagen;
        } elseif ($request->filled('foto_url')) {
            $administrador->imagen_url = $request->input('foto_url');
        }

        $administrador->save();

        return redirect()->route('administrador.index')->with('status', '¡Empleado actualizado correctamente!');
    }
}