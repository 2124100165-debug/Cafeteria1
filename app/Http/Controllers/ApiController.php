<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function datos()
    {
        $tipoCambio = Http::get('API_EXCHANGE')->json();

        return response()->json($tipoCambio);
    }
}