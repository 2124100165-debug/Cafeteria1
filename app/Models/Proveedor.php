<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model {
    use HasFactory, SoftDeletes;
    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    protected $fillable = ['nombre_empresa', 'contacto', 'telefono'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}