<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineasPedido;
use App\Models\Pedido;

class CestaController extends Controller
{
    public function showCesta(Request $request)
    {
        $cesta = LineasPedido::join('Pedido', 'Pedido.IdPedido', '=', 'LineasPedido.IdPedido')
                ->join('Articulos', 'Articulos.IdArticulos', '=', 'LineasPedido.IdArticulo')
                ->join('Categoria', 'Categoria.IdCategoria', '=', 'Articulos.IdCategoria')
                ->where('Pedido.Estado', '=', '1')
                ->where('LineasPedido.IdUsuario', '=', decrypt($request->IdUsuario))
                ->get();
        return view('pages.cesta', ['cesta' => $cesta]);
    }
    
    public function addCesta(Request $request)
    {
        if(Pedido::where('IdUsuario', '=', $request->IdUsuario)->where('Estado', '=', 1)->exists())
        {
            // Creamos LineaPedido
            $IdPedido = Pedido::where('IdUsuario', '=', $request->IdUsuario)->where('Estado', '=', 1)->value('IdPedido');
            $dataLineasPedido = $request->only('IdPedido', 'IdArticulo', 'IdUsuario', 'Cantidad', 'Precio');
            $request->validate([
                'IdPedido' => 'required',
                'IdArticulo' => 'required',
                'IdUsuario' => 'required',
                'Cantidad' => 'required',
                'Precio' => 'required'
            ]);
            $dataLineasPedido['IdPedido'] = $IdPedido;
            $LineasPedido = LineasPedido::create($dataLineasPedido);

            return redirect()->to('/pedidos')->with('success', '¡Producto añadido correctamente!');
        }
        else
        {
           //Creamos pedido
           $dataPedido = $request->only('IdUsuario', 'FechaVenta', 'Estado');
           $request->validate([
                'IdUsuario' => 'required',
                'FechaVenta' => 'required',
                'Estado' => 'required'
           ]);
           $Pedido = Pedido::create($dataPedido);

           // Creamos LineaPedido
           $IdPedido = Pedido::latest('IdPedido')->value('IdPedido');
           $dataLineasPedido = $request->only('IdPedido', 'IdArticulo', 'IdUsuario', 'Cantidad', 'Precio');
           $request->validate([
               'IdPedido' => 'required',
               'IdArticulo' => 'required',
               'IdUsuario' => 'required',
               'Cantidad' => 'required',
               'Precio' => 'required'
           ]);
           $dataLineasPedido['IdPedido'] = $IdPedido;
           $LineasPedido = LineasPedido::create($dataLineasPedido);

           return redirect()->to('/pedidos')->with('success', '¡Producto añadido correctamente!');
        }
    }

    public function deleteCesta(Request $request)
    {
        $cesta = LineasPedido::where('IdLineaPedido', '=', $request->IdLineaPedido)->delete();
        return redirect()->route('showCesta', [encrypt(auth()->user()->id)])->with('success', 'Artículo eliminado correctamente!');
    }

    public function guardarCesta(Request $request)
    {
        $dataCesta = LineasPedido::where('IdLineaPedido', '=', $request->IdLineaPedido);
        $dataGuardarCesta = $request->only('Cantidad','Comentario');
        $request->validate([
            'Comentario' => 'max:180'  
        ]);
        $dataCesta->update($dataGuardarCesta);
  
        return redirect()->route('showCesta', [encrypt(auth()->user()->id)])->with('success', '¡Se ha guardado la información correctamente!');
    }
}
