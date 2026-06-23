<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador; 

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión administrativo.
     */
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended('/dashboard');
        }
        return view('auth.login');
    }

    /**
     * Procesa la autenticación manual nativa.
     */
    public function login(Request $request) 
    {
        // Validación obligatoria basada en las etiquetas 'contraseña' de tu vista Blade
        $request->validate([
            'usuario'    => 'required|string',
            'contraseña' => 'required|string',
        ]);

        // Paso 7 de la tarea: Buscar previamente si la cuenta existe pero está desactivada
        $admin = Administrador::where('usuario', $request->usuario)->first();
        if ($admin && (int)$admin->activo === 0) {
            return back()->withErrors(['status' => 'Esta cuenta se encuentra desactivada.'])->withInput();
        }

        // Estructura EXACTA exigida por tu profesor en las especificaciones del PDF
        // Laravel usará 'password' para la contraseña que escribió el usuario, 
        // e irá a buscar la columna física 'activo' con valor 1 a la base de datos.
        $credenciales = [
            'usuario'  => $request->usuario,
            'password' => $request->contraseña, 
            'activo'   => 1                    
        ];

        // Intento de inicio de sesión nativo utilizando el Guard configurado
        if (Auth::guard('admin')->attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // Manejo de errores general requerido por la tarea
        return back()->withErrors(['error' => 'Credenciales incorrectas o cuenta inactiva.'])->withInput();
    }

    /**
     * Cierra la sesión de forma segura destruyendo los tokens de sesión.
     */
    public function logout(Request $request) 
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}