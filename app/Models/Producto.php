<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $primaryKey = 'id_producto';

    public $timestamps = false;

    protected $fillable = [
        'id_categoria',
        'nombre',
        'descripcion',
        'imagen',
        'estado',
    ];

    protected $casts = [
        'id_producto' => 'integer',
        'id_provider' => 'integer',
        'precio' => 'decimal:2'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON PROVEEDORES
    |--------------------------------------------------------------------------
    */

    public function proveedor()
    {
        return $this->belongsTo(
            Proveedor::class,
            'id_provider',
            'id_provider'
        );
    }
}