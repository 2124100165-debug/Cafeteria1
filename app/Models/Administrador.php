<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    // Indicar explícitamente el nombre de la tabla
    protected $table = 'administradores';

    // Indicar explícitamente la clave primaria
    protected $primaryKey = 'id_admin';

    // Desactivar timestamps si no tienes campos 'created_at' y 'updated_at' en tu tabla
    public $timestamps = false; 

    // Campos que pueden ser asignados masivamente
    protected $fillable = ['nombres', 'apellidos', 'rol', 'usuario', 'email', 'password', 'imagen_url', 'estado'];
}