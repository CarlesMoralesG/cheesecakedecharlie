<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulos;

class CompraController extends Controller
{
    public function show()
    {
        return view('pages.diy');
    }

    public function showArticulo(Request $request)
    {
        $articulo = Articulos::where('IdArticulos', decrypt($request->IdArticulos))->get();
        return view('pages.articulo', ['articulo' => $articulo]);
    }
}
