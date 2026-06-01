<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model {
    
    use HasFactory;
    protected $table = 'detalle_pedidos';
    protected $primaryKey = 'id_detalle';
    protected $fillable = ['id_pedido', 'id_presentacion', 'cantidad', 'precio_unitario', 'subtotal'];
    protected $casts = ['precio_unitario' => 'decimal:2', 'subtotal' => 'decimal:2'];
    public function pedido() { return $this->belongsTo(Pedido::class, 'id_pedido', 'id_pedidos'); }
}