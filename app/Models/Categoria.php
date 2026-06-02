<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $primaryKey = 'id_categoria';

    public $timestamps = false;

    protected $fillable = [
        'nombre_categoria',
        'imagen',
        'descripcion',
        'estado'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }
}