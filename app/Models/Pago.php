<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model {

    use HasFactory;
    protected $table = 'pagos';
    protected $primaryKey = 'id_pagos';
    protected $fillable = ['id_pedido', 'monto', 'fecha_pago', 'metodo_pago'];
    protected $casts = ['fecha_pago' => 'datetime', 'monto' => 'decimal:2'];
    public function pedido() { return $this->belongsTo(Pedido::class, 'id_pedido', 'id_pedidos'); }

}