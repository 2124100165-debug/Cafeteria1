<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended('/dashboard');
        }
        return view('auth.login');
    }

    /**
     * Procesa el inicio de sesión.
     */
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'contraseña' => 'required|string',
        ]);

        // Mapeamos a las credenciales requeridas por Laravel
        // 'password' es la llave interna de Laravel, pero se mapea a 'contraseña' en el modelo Administrador
        $credenciales = [
            'usuario'  => $request->usuario,
            'password' => $request->contraseña,
            'activo'   => 1                    
        ];

        // Verificar primero si el usuario existe pero está inactivo
        $admin = Administrador::where('usuario', $request->usuario)->first();
        if ($admin && $admin->activo != 1) {
            return back()->withErrors(['error' => 'Esta cuenta se encuentra desactivada.'])->withInput();
        }

        if (Auth::guard('admin')->attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // Manejo de errores detallado
        return back()->withErrors(['error' => 'Credenciales incorrectas o cuenta inactiva.'])->withInput();
    }

    /**
     * Cierra la sesión del administrador.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
       
        $request->session()->invalidate();
        $request->session()->regenerateToken();
       
        return redirect('/login');
    }
}
