<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function listado()
    {
        $categorias = Categoria::all();
        return view('categorias.list-cat', compact('categorias'));
    }

    public function formulario()
    {
        return view('categorias.form-cat');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|max:100|unique:categorias,nombre_categoria',
            'descripcion'      => 'nullable|max:255',
            'estado'           => 'required|in:Activo,Inactivo',
            'foto_archivo'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_url'         => 'nullable|url'
        ]);

        $categoria = new Categoria();
        $categoria->nombre_categoria = $request->input('nombre_categoria');
        $categoria->descripcion      = $request->input('descripcion');
        $categoria->estado           = $request->input('estado');

        if ($request->hasFile('foto_archivo')) {
            $file = $request->file('foto_archivo');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/categorias'), $nombreImagen); 
            $categoria->imagen = 'imagenes/categorias/' . $nombreImagen;
        } else {
            $categoria->imagen = $request->input('foto_url');
        }

        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoría creada con éxito.');
    }

    public function editar($id_categoria)
    {
        $categoria = Categoria::find($id_categoria);
        if (!$categoria) {
            return redirect()->route('categorias.index')->with('error', 'Categoría no encontrada.');
        }
        return view('categorias.Edit-cat', compact('categoria'));
    }

    public function actualizar(Request $request, $id_categoria)
    {
        $categoria = Categoria::find($id_categoria);
        
        if (!$categoria) {
            return redirect()->route('categorias.index')->with('error', 'Categoría no encontrada.');
        }

        $request->validate([
            'nombre_categoria' => 'required|max:100|unique:categorias,nombre_categoria,' . $categoria->id_categoria . ',id_categoria',
            'descripcion'      => 'nullable|max:255',
            'estado'           => 'required|in:Activo,Inactivo',
            'foto_archivo'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'foto_url'         => 'nullable'
        ]);

        $categoria->nombre_categoria = $request->input('nombre_categoria');
        $categoria->descripcion      = $request->input('descripcion');
        $categoria->estado           = $request->input('estado');

        if ($request->hasFile('foto_archivo')) {
            $file = $request->file('foto_archivo');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/categorias'), $nombreImagen); 
            $categoria->imagen = 'imagenes/categorias/' . $nombreImagen;
        } elseif ($request->filled('foto_url')) {
            $categoria->imagen = $request->input('foto_url');
        }

        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada con éxito.');
    }
     
    /**
     * Método para mostrar detalles (GET)
     */
    public function mostrar($id)
    {
        $categoria = Categoria::find($id);
        
        if (!$categoria) {
            return redirect()->route('categorias.index')->with('error', 'Categoría no encontrada.');
        }

        return view('categorias.Ver-cat', compact('categoria'));
    }

    /**
     * Método para eliminar (Renombrado a 'eliminar' para coincidir con tu ruta)
     */
    public function eliminarLog($id)
    {
        $categoria = Categoria::find($id);
        
        if (!$categoria) {
            return redirect()->route('categorias.index')->with('error', 'Categoría no encontrada.');
        }

        // LÍNEA 118: ESTO ES EL BORRADO LÓGICO

        $categoria->estado = 'Inactivo';
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada con éxito.');
    }
}