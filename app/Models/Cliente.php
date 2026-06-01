<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model {
    use HasFactory, SoftDeletes;
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    protected $fillable = ['nombre', 'email', 'telefono', 'direccion'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public function pedidos() { return $this->hasMany(Pedido::class, 'id_cliente', 'id_cliente'); }
}