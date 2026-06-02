<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administradores';

    protected $primaryKey = 'id_admin';

    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'rol',
        'usuario',
        'email',
        'password',
        'imagen_url',
        'estado'
    ];

    protected $hidden = [
        'password'
    ];
}