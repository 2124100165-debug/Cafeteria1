<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use Notifiable;

    protected $table = 'administradores';
    protected $primaryKey = 'id_admin';
    public $timestamps = false; 

    protected $fillable = [
        'nombres', 
        'apellidos', 
        'rol', 
        'usuario', 
        'email', 
        'contraseña', // Tu columna en phpMyAdmin
        'imagen_url', 
        'activo'      // Tu columna en phpMyAdmin
    ];

    /**
     * OBLIGATORIO DE LA RÚBRICA:
     * Le indica a Laravel que la columna que almacena el hash de la clave se llama 'contraseña'.
     */
    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    /**
     * SOLUCIÓN AL ERROR: 
     * Sobrescribimos el nombre de la columna para el sistema de Hash automatizado de Laravel.
     * Esto evita que intente hacer un UPDATE a la columna inexistente 'password'.
     */
    public function getAuthPasswordName()
    {
        return 'contraseña';
    }
}