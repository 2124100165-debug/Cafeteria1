<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function listado()
    {
        // ⚡ ELOQUENT: Trae todas las categorías reales
        $categorias = Categoria::all();

        return view('categorias.list-cat', compact('categorias'));
    }

    public function formulario()
    {
        return view('categorias.form-cat');
    }

    // 🚀 FUNCIÓN COMPLETA PARA GUARDAR CATEGORÍAS (CON FILTRO ANTI-DUPLICADOS)
    public function guardar(Request $request)
    {
        // A. Validación optimizada (Evita colapsar la BD con excepciones de clave única)
        $request->validate([
            'nombre_categoria' => 'required|max:100|unique:categorias,nombre_categoria',
            'descripcion'      => 'nullable|max:255',
            'estado'           => 'required|in:Activo,Inactivo',
            'foto_archivo'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            // Mensaje personalizado en español para tus alertas Blade
            'nombre_categoria.unique' => 'La categoría "' . $request->input('nombre_categoria') . '" ya se encuentra registrada en Kraneo Café.'
        ]);

        // B. Crear instancia
        $categoria = new Categoria();

        // C. Mapeo EXACTO con tu phpMyAdmin
        $categoria->nombre_categoria = $request->input('nombre_categoria');
        $categoria->descripcion      = $request->input('descripcion');
        $categoria->estado           = $request->input('estado'); // Dinámico desde tu select

        // 📸 PROCESAMIENTO DUAL DE LA IMAGEN DE LA CATEGORÍA
        if ($request->hasFile('foto_archivo')) {
            $file = $request->file('foto_archivo');
            $nombreImagen = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagenes/categorias'), $nombreImagen); 
            $categoria->imagen = 'imagenes/categorias/' . $nombreImagen;
        } elseif ($request->input('foto_url')) {
            $categoria->imagen = $request->input('foto_url');
        } else {
            $categoria->imagen = 'bebidas.jpg'; // Imagen genérica si no suben nada
        }

        // D. Guardar en MySQL de forma segura
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', '¡Categoría creada con éxito!');
    }
}