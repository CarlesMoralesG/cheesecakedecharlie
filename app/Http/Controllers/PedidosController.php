<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulos;

class PedidosController extends Controller
{
    public function articulos()
    {
        $articulos = Articulos::where('IndBaja', 0)->get();
        return view('pages.pedidos', ['articulos' => $articulos]);
    }
}
