<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $primaryKey = 'id_provider';

    public $timestamps = false;

    protected $fillable = [
        'nombre_empresa',
        'contacto_nombre',
        'telefono',
        'direccion',
        'rfc'
    ];

    protected $casts = [
        'id_provider' => 'integer'
    ];

   

    public function productos()
    {
        return $this->hasMany(
            Producto::class,
            'id_provider',
            'id_provider'
        );
    }
}