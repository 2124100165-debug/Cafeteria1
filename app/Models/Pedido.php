<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model {
    use HasFactory, SoftDeletes;
    protected $table = 'pedido';
    protected $primaryKey = 'id_pedidos';
    protected $fillable = ['id_cliente', 'fecha', 'subtotal', 'descuento_total', 'iva', 'total', 'estado'];
    protected $hidden = ['deleted_at'];
    protected $casts = ['fecha' => 'datetime', 'subtotal' => 'decimal:2', 'total' => 'decimal:2', 'iva' => 'decimal:2'];
    
    public function cliente() { return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente'); }
    public function detalles() { return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedidos'); }
    public function pagos() { return $this->hasMany(Pago::class, 'id_pedido', 'id_pedidos'); }
}