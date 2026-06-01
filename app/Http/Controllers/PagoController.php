<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function listado()
    {
        $pagos = [
            (object) ['id_pago' => 101, 'id_pedido' => 1, 'fecha_pago' => '2026-05-29 10:00', 'metodo_pago' => 'Tarjeta', 'monto' => 150.50, 'estado' => 'Aprobado'],
            (object) ['id_pago' => 102, 'id_pedido' => 2, 'fecha_pago' => '2026-05-29 11:30', 'metodo_pago' => 'PayPal', 'monto' => 85.00, 'estado' => 'Pendiente'],
        ];

        return view('pagos.list-pago', compact('pagos'));
    }

    public function formulario()
    {
        return view('pagos.form-pago');
    }

    public function guardar(Request $request)
    {
        return redirect()->back();
    }
}