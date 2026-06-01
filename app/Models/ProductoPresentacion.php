<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoPresentacion extends Model {
    use HasFactory, SoftDeletes;
    protected $table = 'producto_presentaciones';
    protected $primaryKey = 'id_presentacion';
    protected $fillable = ['id_producto', 'nombre_presentacion', 'precio', 'stock', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = ['precio' => 'decimal:2'];
    public function producto() { return $this->belongsTo(Producto::class, 'id_producto', 'id_producto'); }
}