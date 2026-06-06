<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    public function listado()
    {
        //ELOQUENT: Trae todos los administradores reales
        $administradores = Administrador::all();

        return view('administrador.list-admin', compact('administradores'));
    }

    public function formulario()
    {
        return view('administrador.form-admin');
    }

    // AGREGAMOS LA FUNCIÓN QUE FALTA:
    public function guardar(Request $request)
    {
        // A. Validar la doble confirmación del correo electrónico
        $request->validate([
            'email' => 'required|email',
            'email_confirmation' => 'required|same:email', // Obliga a que coincidan
            'foto_archivo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'email_confirmation.same' => 'Los correos electrónicos introducidos no coinciden.',
        ]);

        // B. Crear la instancia del modelo
        $administrador = new Administrador();

        // C. Asignar valores usando los nombres exactos de tu Base de Datos
        $administrador->nombres    = $request->input('nombres');
        $administrador->apellidos  = $request->input('apellidos');
        $administrador->rol        = $request->input('rol');
        $administrador->usuario    = $request->input('usuario');
        $administrador->email      = $request->input('email');
        $administrador->password   = $request->input('password'); // Tal cual tu tabla
        $administrador->estado     = 'Activo';

        // D. Procesar la imagen (Subida física o URL de Internet)
        if ($request->hasFile('foto_archivo')) {
            $imagen = $request->file('foto_archivo');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('imagenes/personal'), $nombreImagen); 
            $administrador->imagen_url = 'imagenes/personal/' . $nombreImagen;
        } elseif ($request->input('foto_url')) {
            $administrador->imagen_url = $request->input('foto_url');
        } else {
            $administrador->imagen_url = 'carlos.jpg'; // Tu valor default
        }

        // E. Guardar en MySQL
        $administrador->save();

        // F. Redireccionar al listado de administradores
        return redirect()->route('administrador.index')->with('success', '¡Personal registrado con éxito!');
    }
// para editar los datos del formulario de administradores
        Public function editar(Request $request)
}