<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Http\Request\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\LineasPedido;
use App\Models\Pedido;

class ProfileController extends Controller
{
    public function show()
    {
        if(!Auth::check())
        {
            return redirect()->to('/home');
        }

        return view('auth.profile');
    }

    public function showPedidos(Request $request)
    {
        $pedidoUsuario = Pedido::join('EstadoPedido', 'EstadoPedido.IdEstadoPedido', '=', 'Pedido.Estado')
        ->where('Pedido.Estado', '!=', '1')
        ->where('Pedido.IdUsuario', '=', decrypt($request->IdUsuario))
        ->get();
        return view('auth.pedidoUsuario', ['pedidoUsuario' => $pedidoUsuario]);
    }

    public function showDetallePedidos(Request $request, $IdPedido)
    {
        $detallePedido = LineasPedido::join('Pedido', 'Pedido.IdPedido', '=', 'LineasPedido.IdPedido')
        ->join('Articulos', 'Articulos.IdArticulos', '=', 'LineasPedido.IdArticulo')
        ->join('Categoria', 'Categoria.IdCategoria', '=', 'Articulos.IdCategoria')
        ->where('LineasPedido.IdPedido', '=', decrypt($request->IdPedido))
        ->get();
        return view('auth.detallePedidoUsuario', ['detallePedido' => $detallePedido]);
    }

    public function editProfile(Request $request)
    {
        $user = Usuarios::find(decrypt($request->id));
        $data = $request->only('Nombre', 'Apellido', 'Telefono', 'Direccion', 'CodigoPostal', 'Provincia', 'Poblacion');
        if(trim($request->password) == '')
        {
            $request->validate([
                'Nombre' => 'required',
                'Apellido' => 'required',
                'Direccion' => 'required',
                'CodigoPostal' => 'required|min:5|max:5',
                'Telefono' => 'required|min:9|max:9',
                'Poblacion' => 'required'
            ]);
            $data= $request->except('password');
        }
        else
        {
            $request->validate([
                'Nombre' => 'required',
                'Apellido' => 'required',
                'password' => 'required|min:6',
                'Direccion' => 'required',
                'CodigoPostal' => 'required|min:5|max:5',
                'Telefono' => 'required|min:9|max:9',
                'Poblacion' => 'required'
            ]);

            $request->all();
            $data['password']=$request->password;
        }
        $user->update($data);
        return redirect()->to('/profile')->with('success', '¡Usuario modificado correctamente!');
    }
}
