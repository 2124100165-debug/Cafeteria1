<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administrador extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'administradores'; 

    // Regla: Llave primaria personalizada
    protected $primaryKey = 'id_administrador';

    // Regla: Asignación masiva
    protected $fillable = ['nombre', 'email', 'password', 'rol'];

    // Regla: Ocultar datos sensibles (¡Muy importante para administradores!)
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];

    // Regla: Casts (si tuvieras fechas especiales o JSON)
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}