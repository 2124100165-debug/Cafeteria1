<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Administrador extends Authenticatable
{
    use Notifiable;

    // Indicar explícitamente el nombre de la tabla
    protected $table = 'administradores';

    // Indicar explícitamente la clave primaria
    protected $primaryKey = 'id_admin';

    // Desactivar timestamps si no tienes campos 'created_at' y 'updated_at' en tu tabla
    public $timestamps = false; 

    // Campos que pueden ser asignados masivamente
    protected $fillable = [
        'nombres', 
        'apellidos', 
        'rol', 
        'usuario', 
        'email', 
        'password', 
        'contraseña', 
        'imagen_url', 
        'estado', 
        'activo'
    ];

    /**
     * IMPORTANTE: Laravel busca el campo 'password'.
     * Como usamos 'contraseña', debemos indicárselo explícitamente.
     */
    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    /**
     * Mapear la propiedad virtual 'password' a la columna real 'contraseña'
     */
    public function getPasswordAttribute()
    {
        return $this->contraseña;
    }

    public function setPasswordAttribute($value)
    {
        $this->contraseña = $value;
    }

    /**
     * Mapear la propiedad virtual 'estado' a la columna real 'activo'
     */
    public function getEstadoAttribute()
    {
        return $this->activo == 1 ? 'Activo' : 'Inactivo';
    }

    public function setEstadoAttribute($value)
    {
        $this->activo = ($value === 'Activo' || $value == 1) ? 1 : 0;
    }
}