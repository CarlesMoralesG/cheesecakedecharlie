<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulos;

class HomeController extends Controller
{
    public function index()
    {
        $favorito = Articulos::where('Esfavorito', 1)->get();
        return view('pages.index', ['favorito' => $favorito]);
    }
}
