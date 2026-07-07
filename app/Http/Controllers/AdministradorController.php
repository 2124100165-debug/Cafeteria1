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
        // CARGA DUAL: Se usa 'required_without' para exigir al menos un método multimedia
        $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'usuario' => 'required|string|unique:administradores,usuario',
            'email' => 'required|email|unique:administradores,email',
            'email_confirmation' => 'required|same:email',
            'password' => 'required|string|min:6',
            'foto_archivo' => 'required_without:foto_url|nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_url' => 'required_without:foto_archivo|nullable|url',
        ], [
            'email_confirmation.same' => 'Los correos electrónicos introducidos no coinciden.',
            'foto_archivo.required_without' => 'Debes adjuntar un archivo de imagen o proporcionar una URL válida.',
            'foto_url.required_without' => 'Debes adjuntar un archivo de imagen o proporcionar una URL válida.',
        ]);

        $administrador = new Administrador();
        $administrador->nombres   = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->rol       = $request->input('rol');
        $administrador->usuario   = $request->input('usuario');
        $administrador->email     = $request->input('email');
        
        $administrador->contraseña = Hash::make($request->input('password')); 
        
        // CORREGIDO: Usamos la columna 'activo' de tu BD (1 = Activo)
        $administrador->activo    = 1; 
        
        // Si el usuario prefirió usar una URL directa, la asignamos de inmediato
        if ($request->filled('foto_url')) {
            $administrador->imagen_url = $request->input('foto_url');
        } else {
            // De lo contrario, un valor por defecto temporal para realizar el primer insert
            $administrador->imagen_url = 'imagenes/personal/producto_default.jpg';
        }

        $administrador->save(); // Primer save para obtener el id_admin generado

        // Si se subió un archivo físico local, este tiene prioridad y se procesa en el Storage
        if ($request->hasFile('foto_archivo')) {
            $file = $request->file('foto_archivo');
            
            // Estructura exacta del profe: tabla_id_numero.extension
            $nombre = 'administradores_' . $administrador->id_admin . '_1.' . $file->getClientOriginalExtension();
            
            // storeAs en la carpeta correspondiente en el disco 'public'
            $ruta = $file->storeAs('imagenes/personal', $nombre, 'public');
            
            // Genera la URL pública limpia vinculada al enlace simbólico
            $administrador->imagen_url = Storage::url($ruta);
            $administrador->save(); // Segundo save final solo si se sobrescribió con archivo
        }

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

        // CORREGIDO: Cambiada la validación de 'estado' a 'activo' (debe recibir 1 o 0 desde el select/input)
        $validator = Validator::make($request->all(), [
            'nombres'      => 'required|max:100',
            'apellidos'    => 'required|max:100',
            'email'        => 'required|email|max:150|unique:administradores,email,' . $id . ',id_admin',
            'usuario'      => 'required|max:50|unique:administradores,usuario,' . $id . ',id_admin',
            'rol'          => 'required|max:50',
            'activo'       => 'required|in:1,0', 
            'password'     => 'nullable|min:3',
            'foto_archivo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_url'     => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $administrador->nombres   = $request->input('nombres');
        $administrador->apellidos = $request->input('apellidos');
        $administrador->email     = $request->input('email');
        $administrador->usuario   = $request->input('usuario');
        $administrador->rol       = $request->input('rol');
        
        // CORREGIDO: Asignamos a la columna real 'activo'
        $administrador->activo    = $request->input('activo'); 

        if ($request->filled('password')) {
            $administrador->contraseña = Hash::make($request->input('password'));
        }

        // CARGA DUAL EN EDICIÓN: Prioridad al archivo subido, de lo contrario verifica la URL de texto
        if ($request->hasFile('foto_archivo')) {
            // Eliminar la foto física local vieja del Storage si existía
            $nombreAnterior = basename($administrador->imagen_url);
            if ($nombreAnterior && Storage::disk('public')->exists('imagenes/personal/' . $nombreAnterior)) {
                Storage::disk('public')->delete('imagenes/personal/' . $nombreAnterior);
            }

            $file = $request->file('foto_archivo');
            $nombre = 'administradores_' . $administrador->id_admin . '_1.' . $file->getClientOriginalExtension();
            $ruta = $file->storeAs('imagenes/personal', $nombre, 'public');
            
            $administrador->imagen_url = Storage::url($ruta);
        } elseif ($request->filled('foto_url')) {
            // Si no subió un archivo físico pero actualizó el campo de la URL externa
            $administrador->imagen_url = $request->input('foto_url');
        }

        $administrador->save();

        return redirect()->route('administrador.index')->with('success', '¡Empleado actualizado correctamente!');
    } 

    // Soft Delete: Cambia el estado a '0' (Inactivo) enviándolo al archivo muerto.
    public function eliminarLog($id_admin)
    {
        $administrador = Administrador::find($id_admin);

        if (!$administrador) {
            return redirect()->route('administrador.index')->with('error', 'Administrador no encontrado.');
        }

        // CORREGIDO: Cambiado de 'estado' a 'activo' asignando 0
        $administrador->activo = 0;
        $administrador->save();

        return redirect()->route('administrador.index')->with('success', 'El administrador ha sido enviado al archivo muerto.');
    }

    // Restaurar: Revierte el estado a '1' (Activo) regresándolo del archivo muerto.
    public function restaurar($id_admin)
    {
        $administrador = Administrador::find($id_admin);

        if (!$administrador) {
            return redirect()->route('administrador.archivo')->with('error', 'Administrador no encontrado.');
        }

        // CORREGIDO: Cambiado de 'estado' a 'activo' asignando 1
        $administrador->activo = 1;
        $administrador->save();

        return redirect()->route('administrador.archivo')->with('success', 'El administrador ha sido restaurado con éxito.');
    }

     // Destruir: Elimina permanentemente el registro del administrador y su imagen física local si existe.
    public function destruir($id_admin)
    {
        $administrador = Administrador::find($id_admin);

        if (!$administrador) {
            return redirect()->route('administrador.archivo')->with('error', 'Administrador no encontrado.');
        }

        $nombreAnterior = basename($administrador->imagen_url);
        if ($nombreAnterior && $nombreAnterior !== 'producto_default.jpg') {
            if (Storage::disk('public')->exists('imagenes/personal/' . $nombreAnterior)) {
                Storage::disk('public')->delete('imagenes/personal/' . $nombreAnterior);
            }
        }

        $administrador->delete();

        return redirect()->route('administrador.archivo')->with('success', 'Administrador eliminado permanentemente del sistema.');
    }
}