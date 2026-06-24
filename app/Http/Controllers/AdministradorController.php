<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Storage; // Para borrar y gestionar la URL pública de los archivos

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
            'foto_archivo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // RÚBRICA: Requerido en crear
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
        
        // Imagen por default antes de guardar para obtener el ID generado
        $administrador->imagen_url = 'imagenes/personal/producto_default.jpg';

        $administrador->save(); // Primer save para obtener el id_admin

        // IGUAL AL EJEMPLO DE CLASE (CORREGIDO PARA STORAGE)
        if ($request->hasFile('foto_archivo')) {
            $file = $request->file('foto_archivo');
            
            // Estructura exacta del profe: tabla_id_numero.extension
            $nombre = 'administradores_' . $administrador->id_admin . '_1.' . $file->getClientOriginalExtension();
            
            // storeAs en la carpeta correspondiente en el disco 'public'
            $ruta = $file->storeAs('imagenes/personal', $nombre, 'public');
            
            // Genera la URL pública limpia vinculada al enlace simbólico
            $administrador->imagen_url = Storage::url($ruta);
        }

        $administrador->save(); // Segundo save final

        return redirect()->route('administrador.index')->with('success', '¡Personal registrado con éxito!');
    }

    public function ver($id_admin)
    {
        $administrador = Administrador::find($id_admin);
        
        if (!$administrador) {
            return redirect()->route('administrador.index')->with('error', 'Administrador no encontrado.');
        }
        return view('administrador.Ver-admin', compact('administrador'));
    }
    
    public function editar($id_admin)
    {
        $administrador = Administrador::find($id_admin);
        
        if (!$administrador) {
            return redirect()->route('administrador.index')->with('error', 'Administrador no encontrado.');
        }

        return view('administrador.edit-admin', compact('administrador'));
    }

   
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
            'foto_archivo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // RÚBRICA: Opcional en editar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $administrador->nombres   = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->email     = $request->input('email');
        $administrador->usuario   = $request->input('usuario');
        $administrador->rol       = $request->input('rol');
        $administrador->estado    = $request->input('estado'); // Corregido para que respete lo enviado en la edición

        if ($request->filled('password')) {
            $administrador->password = Hash::make($request->input('password'));
        }

        
        if ($request->hasFile('foto_archivo')) {
            // Eliminar la foto vieja física del Storage usando el nombre del archivo
            $nombreAnterior = basename($administrador->imagen_url);
            if ($nombreAnterior && Storage::disk('public')->exists('imagenes/personal/' . $nombreAnterior)) {
                Storage::disk('public')->delete('imagenes/personal/' . $nombreAnterior);
            }

            $file = $request->file('foto_archivo');
            $nombre = 'administradores_' . $administrador->id_admin . '_1.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('imagenes/personal', $nombre, 'public');
            
            //  Genera la URL pública limpia vinculada al enlace simbólico
            $administrador->imagen_url = Storage::url($ruta);
        }

        $administrador->save();

        return redirect()->route('administrador.index')->with('success', '¡Empleado actualizado correctamente!');
    } 

    //Soft Delete: Cambia el estado a 'Inactivo' enviándolo al archivo muerto.//

    public function eliminarLog($id_admin)
    {
        $administrador = Administrador::find($id_admin);

        if (!$administrador) {
            return redirect()->route('administrador.index')->with('error', 'Administrador no encontrado.');
        }

        $administrador->estado = 'Inactivo';
        $administrador->save();

        return redirect()->route('administrador.index')->with('success', 'El administrador ha sido enviado al archivo muerto.');
    }

    //Restaurar: Revierte el estado a 'Activo' regresándolo del archivo muerto.//
    public function restaurar($id_admin)
    {
        $administrador = Administrador::find($id_admin);

        if (!$administrador) {
            return redirect()->route('administrador.archivo')->with('error', 'Administrador no encontrado.');
        }

        $administrador->estado = 'Activo';
        $administrador->save();

        return redirect()->route('administrador.archivo')->with('success', 'El administrador ha sido restaurado con éxito.');
    }

    
     //Hard Delete: Elimina definitivamente el registro de la BD y purga su archivo de imagen.//
    
    public function destruir($id_admin)
    {
        $administrador = Administrador::find($id_admin);

        if (!$administrador) {
            return redirect()->route('administrador.archivo')->with('error', 'Administrador no encontrado.');
        }

        // Limpieza de almacenamiento físico
        $nombreAnterior = basename($administrador->imagen_url);
        if ($nombreAnterior && $nombreAnterior !== 'producto_default.jpg') {
            if (Storage::disk('public')->exists('imagenes/personal/' . $nombreAnterior)) {
                Storage::disk('public')->delete('imagenes/personal/' . $nombreAnterior);
            }
        }

        // Ejecución del Hard Delete real en la tabla
        $administrador->delete();

        return redirect()->route('administrador.archivo')->with('success', 'Administrador eliminado permanentemente del sistema.');
    }
}