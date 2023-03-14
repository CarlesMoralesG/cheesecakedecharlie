<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineasPedido;
use App\Models\Pedido;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $count = 0;
        $totalCesta = 0;
        $contarCesta = LineasPedido::join('Pedido', 'Pedido.IdPedido', '=', 'LineasPedido.IdPedido')
                ->join('Articulos', 'Articulos.IdArticulos', '=', 'LineasPedido.IdArticulo')
                ->join('Categoria', 'Categoria.IdCategoria', '=', 'Articulos.IdCategoria')
                ->where('Pedido.Estado', '=', '1')
                ->where('LineasPedido.IdUsuario', '=', decrypt($request->IdUsuario))
                ->get();
        foreach ($contarCesta as $contarCesta){
            $totalPedido = $contarCesta->Precio*$contarCesta->Cantidad;
            $count++;
            $totalCesta += $totalPedido;
        }
        return view('pages.checkout', ['totalCesta' => $totalCesta]);
    }

    public function view(){
        return view('pages.checkout');
    }

    public function success(Request $request){
        $checkoutPedido = Pedido::where('IdUsuario', decrypt($request->IdUsuario))
                                ->where('Estado', '1');
        $guardarInfoCheckOut = $request->only('FechaVenta', 'FechaRecibirPedido', 'Estado', 'Nombre', 'Apellido', 'Correo', 'Telefono', 'Direccion', 'CodigoPostal', 'Poblacion');
        $checkoutPedido->update($guardarInfoCheckOut);
        return redirect()->to('/pedidos')->with('success', '¡Pedido creado correctamente!');
    }
}
