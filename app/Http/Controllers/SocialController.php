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
     * Maneja el retorno (callback) de Google.
     */
    public function callback()
    {
        try {
            $userSocial = Socialite::driver('google')->user();

            // 1. Buscar si el correo de la red social existe en la tabla administradores
            $admin = Administrador::where('email', $userSocial->getEmail())->first();

            if ($admin) {
                // 2. Validamos contra tu columna real 'activo' (1 = Activo)
                if ($admin->activo == 1) {
                    
                    // 3. CORRECCIÓN CLAVE: Loguear especificando el guard 'admin'
                    Auth::guard('admin')->login($admin);
                   
                    // Redirige al dashboard principal con un mensaje de éxito
                    return redirect()->route('dashboard')->with('success', 'Autenticación exitosa mediante Google');

                } else {
                    return redirect()->route('login')->with('error', 'Esta cuenta administrativa se encuentra inactiva.');
                }
            }

            // Si no existe en la tabla de administradores, rechazar acceso
            return redirect()->route('login')->with('error', 'El correo de Google no pertenece a un administrador autorizado.');
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Ocurrió un error al iniciar sesión con Google: ' . $e->getMessage());
        }
    }
}