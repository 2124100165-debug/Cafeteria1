<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model {
    use HasFactory, SoftDeletes;
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $fillable = ['nombre_producto', 'id_categoria', 'estado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public function categoria() { return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria'); }
    public function presentaciones() { return $this->hasMany(ProductoPresentacion::class, 'id_producto', 'id_producto'); }
}