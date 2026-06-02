<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $primaryKey = 'id_cliente';

    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'email',
        'password',
        'telefono',
        'direccion',
        'imagen',
        'estado'
    ];

    protected $hidden = [
        'password'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cliente');
    }
}