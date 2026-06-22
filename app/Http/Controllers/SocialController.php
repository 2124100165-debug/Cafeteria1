<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Administrador;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    /**
     * Redirige al usuario al proveedor de autenticación (Google).
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Maneja el retorno (callback) del proveedor de autenticación.
     */
    public function callback()
    {
        try {
            $userSocial = Socialite::driver('google')->user();

            // 1. Buscar si el correo de la red social existe en la tabla de administradores
            // Nota: Se busca en el campo 'email', o en 'email_google' si agregaste esa columna.
            $admin = Administrador::where('email', $userSocial->getEmail())->first();

            if ($admin) {
                // 2. Verificar si el administrador está activo (1 = Activo)
                if ($admin->activo == 1) {
                    // 3. LOGUEAR MANUALMENTE EN EL GUARD 'admin'
                    Auth::guard('admin')->login($admin);
                   
                    return redirect()->intended('/dashboard');
                } else {
                    return redirect('/login')->withErrors(['error' => 'Cuenta de administrador inactiva.']);
                }
            }

            // Si no existe en la tabla de administradores, rechazar acceso
            return redirect('/login')->withErrors(['error' => 'No tienes permisos de administrador.']);
            
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Ocurrió un error al iniciar sesión con Google.']);
        }
    }
}
