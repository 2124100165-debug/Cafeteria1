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

    // CRÍTICO: Desactiva el mapeo automático que genera el error "Unknown column 'password'"
    public static $passwordAttributeMapping = false;

    protected $fillable = [
        'nombres', 
        'apellidos', 
        'rol', 
        'usuario', 
        'email', 
        'contraseña', 
        'imagen_url', 
        'activo' // Cambiado para que coincida con tu base de datos (activo en vez de estado)
    ];

    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    public function getAuthPasswordName()
    {
        return 'contraseña';
    }
}