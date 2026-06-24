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
     * Nota: Añadimos stateless() porque las APIs no dependen de sesiones tradicionales.
     */
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Maneja el retorno (callback) de Google y responde en formato API (JSON).
     */
    public function callback()
    {
        try {
            // Usamos stateless() para capturar al usuario sin conflictos de sesión
            $userSocial = Socialite::driver('google')->stateless()->user();

            // 1. Buscar si el correo de la red social existe en la tabla de administradores
            $admin = Administrador::where('email', $userSocial->getEmail())->first();

            if ($admin) {
                // 2. CORRECCIÓN: Validamos contra tu columna real 'estado' y su valor 'Activo'
                if ($admin->estado === 'Activo') {
                    
                    // 3. LOGUEAR MANUALMENTE EN EL GUARD 'admin'
                    Auth::guard('admin')->login($admin);
                   
                    // RESPUESTA TIPO API: Retornamos un JSON con éxito (Esta es tu evidencia)
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Autenticación exitosa mediante API de Google',
                        'admin' => [
                            'id' => $admin->id_admin,
                            'nombre' => $admin->nombres . ' ' . $admin->apellidos,
                            'usuario' => $admin->usuario,
                            'email' => $admin->email,
                            'rol' => $admin->rol
                        ]
                    ], 200);

                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Cuenta de administrador inactiva.'
                    ], 403);
                }
            }

            // Si no existe en la tabla de administradores, rechazar acceso en formato JSON
            return response()->json([
                'status' => 'error',
                'message' => 'No tienes permisos de administrador.'
            ], 401);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrió un error en la API al iniciar sesión con Google.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}