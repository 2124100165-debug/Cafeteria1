<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function listado()
    {
        return view('pedido.list-ped');
    }

    public function formulario()
    {
        return view('pedido.form-ped');
    }

     public function guardar(Request $request)
    {
        $pedido = new Pedido();
        $pedido->id_cliente = $request->input('id_cliente');
        $pedido->fecha = $request->input('fecha');
        $pedido->subtotal = $request->input('subtotal');
        $pedido->descuento_total = $request->input('descuento_total');
        $pedido->iva = $request->input('iva');
        $pedido->total = $request->input('total');
        $pedido->estado = $request->input('estado');
        $pedido->save();

        //return redirect()->route('pedido.index')->with('success', 'Pedido creado exitosamente.');
       return json_encode(['success' => true, 'message' => 'Pedido creado exitosamente.']);
       
    }
}