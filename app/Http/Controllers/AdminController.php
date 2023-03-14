<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\Articulos;
use App\Models\LineasPedido;
use App\Models\Pedido;
use App\Http\Request\RegisterRequest;
use App\Http\Request\ArticuloRequest;

class AdminController extends Controller
{
    // PEDIDOS

        // Mostrar pagina pedidos
        public function pedidos()
        {
            $pedidos = Pedido::join('EstadoPedido', 'Pedido.Estado', '=', 'EstadoPedido.IdEstadoPedido')
                            ->get();
            return view('admins.pedidos.adminPedidos', ['pedidos' => $pedidos]);
        }
        
        // Mostrar el contenido del pedido
        public function lineasPedido(Request $request)
        {
            $lineasPedido = LineasPedido::join('Pedido', 'Pedido.IdPedido', '=', 'LineasPedido.IdPedido')
                                        ->join('Articulos', 'Articulos.IdArticulos', '=', 'LineasPedido.IdArticulo')
                                        ->join('Categoria', 'Categoria.IdCategoria', '=', 'Articulos.IdCategoria')
                                        ->join('EstadoPedido', 'Pedido.Estado', '=', 'EstadoPedido.IdEstadoPedido')
                                        ->where('LineasPedido.IdPedido', '=', $request->IdPedido)
                                        ->get();
            return view('admins.pedidos.lineasPedido', ['lineasPedido' => $lineasPedido]);
        }

        // Actualizar estado de un pedido
        public function updatePedido(Request $request)
        {
            $updatePedido = Pedido::where('IdPedido', '=', $request->IdPedido);
            $dataPedido = $request->only('IdPedido', 'Estado');
            $updatePedido->update($dataPedido);
            return redirect()->to('/adminPedidos')->with('success', 'Pedido actualizado correctamente!');
        }


        // Eliminar un Pedido
        public function deletePedido(Request $request)
        {
            $eliminarLineasPedido = LineasPedido::where('IdPedido', $request->IdPedido)->delete();
            $eliminarPedido = Pedido::where('IdPedido', $request->IdPedido)->delete();
            return redirect()->to('/adminPedidos')->with('success', 'Pedido eliminado correctamente!');
        }

    // TARTAS

        // Mostrar pagina tartas
        public function tartas()
        {
            $tartas = Articulos::get();
            return view('admins.tartas.adminTartas', ['tartas' => $tartas]);
        }

        // AÑADIR

        // Mostrar formulario para añadir tarta
        public function showaddTarta()
        {
            return view('admins.tartas.addTarta');
        }

        // Añadir tarta
        public function addTarta(Request $request)
        {   
            $tartas = new Articulos();
            $dataTarta = $request->only('IdCategoria','DescripcionArticulo', 'Resumen', 'PrecioArticulo', 'Imagen', 'Tamanyo', 'Esfavorito', 'IndBaja');

            $file = $request->file('Imagen');
            $destinationPath = 'images/tartas/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('Imagen')->move($destinationPath, $filename);
            $request->Imagen = $destinationPath . $filename;

            $request->validate([
                'IdCategoria' => 'required',
                'DescripcionArticulo' => 'required',
                'Resumen' => 'required',
                'PrecioArticulo' => 'required',
                'Tamanyo' => 'required',
                'Esfavorito' => 'required',
                'IndBaja' => 'required'
            ]);

            $request->all();
            $dataTarta['Imagen']=$request->Imagen;

            $tartas->create($dataTarta);
  
            return redirect()->to('/adminTartas')->with('success', '¡Se ha creado la tarta correctamente!');
        }

        // EDITAR

        // Mostrar página editar Tarta
        public $tarta;

        public function showeditTarta(Request $request)
        {
            $tarta = Articulos::where('IdArticulos', $request->IdArticulos)->get();
            return view('admins.tartas.editTarta', ['tarta' => $tarta]);
        }

        // Editar el Tarta
        public function editTarta(Request $request)
        {
            $tarta = Articulos::where('IdArticulos', $request->IdArticulos);
            $dataTarta = $request->only('IdArticulos','IdCategoria','DescripcionArticulo', 'Resumen', 'PrecioArticulo', 'Imagen', 'Tamanyo', 'Esfavorito', 'IndBaja');
            
            if($request->hasFile('Imagen'))
            {
                $file = $request->file('Imagen');
                $destinationPath = 'images/tartas/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('Imagen')->move($destinationPath, $filename);
                $request->Imagen = $destinationPath . $filename;
                $request->validate([
                    'IdCategoria' => 'required',
                    'DescripcionArticulo' => 'required',
                    'Resumen' => 'required',
                    'PrecioArticulo' => 'required',
                    'Tamanyo' => 'required',
                    'Esfavorito' => 'required',
                    'IndBaja' => 'required'
                ]);

                $request->all();
                $dataTarta['Imagen']=$request->Imagen;
            }
            else
            {
                $request->validate([
                    'IdCategoria' => 'required',
                    'DescripcionArticulo' => 'required',
                    'Resumen' => 'required',
                    'PrecioArticulo' => 'required',
                    'Tamanyo' => 'required',
                    'Esfavorito' => 'required',
                    'IndBaja' => 'required'
                ]);
                $dataTarta= $request->except('Imagen');
            }

            $tarta->update($dataTarta);
  
            return redirect()->to('/adminTartas')->with('success', '¡Se ha editado la tarta correctamente!');
        }

        // ELIMINAR

        // Eliminar la tarta
        public function deleteTarta(Request $request)
        {
            $tarta = Articulos::where('IdArticulos', $request->IdArticulos);
            $data = $request->only('IndBaja', 'Esfavorito');
            $data['IndBaja'] = "1";
            $data['Esfavorito'] = "0";
            $tarta->update($data);
            return redirect()->to('/adminTartas')->with('success', 'Tarta dada de baja correctamente!');
        }

        // HABILITAR

        // Habilitar la tarta
        public function availableTarta(Request $request)
        {
            $idTarta = $request->IdArticulos;
            $tarta = Articulos::where('IdArticulos', $request->IdArticulos);
            $data = $request->only('IndBaja');
            $data['IndBaja'] = "0";
            $tarta->update($data);
            return redirect()->to('/adminTartas')->with('success', '¡Tarta dada de alta correctamente!');
        }

    // DIY

        // Mostrar pagina DIY
        public function DIY()
        {
            $DIY = Articulos::get();
            return view('admins.DIY.adminDIY', ['DIY' => $DIY]);
        }

        // AÑADIR

        // Mostrar formulario para añadir DIY
        public function showaddDIY()
        {
            return view('admins.DIY.addDIY');
        }

        // Añadir DIY
        public function addDIY(Request $request)
        {   
            $DIY = new Articulos();
            $dataDIY = $request->only('IdCategoria','DescripcionArticulo', 'Resumen', 'PrecioArticulo', 'Imagen', 'Tamanyo', 'Esfavorito', 'IndBaja');

            $file = $request->file('Imagen');
            $destinationPath = 'images/DIY/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('Imagen')->move($destinationPath, $filename);
            $request->Imagen = $destinationPath . $filename;

            $request->validate([
                'IdCategoria' => 'required',
                'DescripcionArticulo' => 'required',
                'Resumen' => 'required',
                'PrecioArticulo' => 'required',
                'Tamanyo' => 'required',
                'Esfavorito' => 'required',
                'IndBaja' => 'required'
            ]);

            $request->all();
            $dataDIY['Imagen']=$request->Imagen;

            $DIY->create($dataDIY);
  
            return redirect()->to('/adminDIY')->with('success', '¡Se ha creado la DIY correctamente!');
        }

        // EDITAR

        // Mostrar página editar DIY
        public $DIY;

        public function showeditDIY(Request $request)
        {
            $DIY = Articulos::where('IdArticulos', $request->IdArticulos)->get();
            return view('admins.DIY.editDIY', ['DIY' => $DIY]);
        }

        // Editar el DIY
        public function editDIY(Request $request)
        {
            $DIY = Articulos::where('IdArticulos', $request->IdArticulos);
            $dataDIY = $request->only('IdArticulos','IdCategoria','DescripcionArticulo', 'Resumen', 'PrecioArticulo', 'Imagen', 'Tamanyo', 'Esfavorito', 'IndBaja');
            
            if($request->hasFile('Imagen'))
            {
                $file = $request->file('Imagen');
                $destinationPath = 'images/DIY/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('Imagen')->move($destinationPath, $filename);
                $request->Imagen = $destinationPath . $filename;
                $request->validate([
                    'IdCategoria' => 'required',
                    'DescripcionArticulo' => 'required',
                    'Resumen' => 'required',
                    'PrecioArticulo' => 'required',
                    'Tamanyo' => 'required',
                    'Esfavorito' => 'required',
                    'IndBaja' => 'required'
                ]);

                $request->all();
                $dataDIY['Imagen']=$request->Imagen;
            }
            else
            {
                $request->validate([
                    'IdCategoria' => 'required',
                    'DescripcionArticulo' => 'required',
                    'Resumen' => 'required',
                    'PrecioArticulo' => 'required',
                    'Tamanyo' => 'required',
                    'Esfavorito' => 'required',
                    'IndBaja' => 'required'
                ]);
                $dataDIY = $request->except('Imagen');
            }

            $DIY->update($dataDIY);
  
            return redirect()->to('/adminDIY')->with('success', '¡Se ha editado la DIY correctamente!');
        }

        // ELIMINAR

        // Eliminar la DIY
        public function deleteDIY(Request $request)
        {
            $DIY = Articulos::where('IdArticulos', $request->IdArticulos);
            $data = $request->only('IndBaja', 'Esfavorito');
            $data['IndBaja'] = "1";
            $data['Esfavorito'] = "0";
            $DIY->update($data);
            return redirect()->to('/adminDIY')->with('success', 'DIY dada de baja correctamente!');
        }

        // HABILITAR

        // Habilitar la DIY
        public function availableDIY(Request $request)
        {
            $idDIY = $request->IdArticulos;
            $DIY = Articulos::where('IdArticulos', $request->IdArticulos);
            $data = $request->only('IndBaja');
            $data['IndBaja'] = "0";
            $DIY->update($data);
            return redirect()->to('/adminDIY')->with('success', 'DIY dada de alta correctamente!');
        }

    // ROPA

        // Mostrar pagina Ropa
        public function Ropa()
        {
            $ropa = Articulos::get();
            return view('admins.ropa.adminRopa', ['ropa' => $ropa]);
        }

        // AÑADIR

        // Mostrar formulario para añadir Ropa
        public function showaddRopa()
        {
            return view('admins.ropa.addRopa');
        }

        // Añadir Ropa
        public function addRopa(Request $request)
        {   
            $Ropa = new Articulos();
            $dataRopa = $request->only('IdCategoria','DescripcionArticulo', 'Resumen', 'PrecioArticulo', 'StockArticulo', 'Imagen', 'Talla', 'Esfavorito', 'IndBaja');

            $file = $request->file('Imagen');
            $destinationPath = 'images/ropa/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('Imagen')->move($destinationPath, $filename);
            $request->Imagen = $destinationPath . $filename;

            $request->validate([
                'IdCategoria' => 'required',
                'DescripcionArticulo' => 'required',
                'Resumen' => 'required',
                'PrecioArticulo' => 'required',
                'Talla' => 'required',
                'Esfavorito' => 'required',
                'IndBaja' => 'required'
            ]);

            $request->all();
            $dataRopa['Imagen']=$request->Imagen;

            $Ropa->create($dataRopa);
    
            return redirect()->to('/adminRopa')->with('success', '¡Se ha creado el artículo correctamente!');
        }

        // EDITAR

        // Mostrar página editar Ropa
        public $Ropa;

        public function showeditRopa(Request $request)
        {
            $ropa = Articulos::where('IdArticulos', $request->IdArticulos)->get();
            return view('admins.ropa.editRopa', ['ropa' => $ropa]);
        }

        // Editar la Ropa
        public function editRopa(Request $request)
        {
            $Ropa = Articulos::where('IdArticulos', $request->IdArticulos);
            $dataRopa = $request->only('IdArticulos','IdCategoria','DescripcionArticulo', 'Resumen', 'PrecioArticulo', 'StockArticulo', 'Imagen', 'Talla', 'Esfavorito', 'IndBaja');
            
            if($request->hasFile('Imagen'))
            {
                $file = $request->file('Imagen');
                $destinationPath = 'images/ropa/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('Imagen')->move($destinationPath, $filename);
                $request->Imagen = $destinationPath . $filename;
                $request->validate([
                    'IdCategoria' => 'required',
                    'DescripcionArticulo' => 'required',
                    'Resumen' => 'required',
                    'PrecioArticulo' => 'required',
                    'StockArticulo' => 'required',
                    'Talla' => 'required',
                    'Esfavorito' => 'required',
                    'IndBaja' => 'required'
                ]);

                $request->all();
                $dataRopa['Imagen']=$request->Imagen;
            }
            else
            {
                $request->validate([
                    'IdCategoria' => 'required',
                    'DescripcionArticulo' => 'required',
                    'Resumen' => 'required',
                    'PrecioArticulo' => 'required',
                    'StockArticulo' => 'required',
                    'Talla' => 'required',
                    'Esfavorito' => 'required',
                    'IndBaja' => 'required'
                ]);
                $dataRopa= $request->except('Imagen');
            }

            $Ropa->update($dataRopa);
    
            return redirect()->to('/adminRopa')->with('success', '¡Se ha editado el artículo correctamente!');
        }

        // ELIMINAR

        // Eliminar la Ropa
        public function deleteRopa(Request $request)
        {
            $Ropa = Articulos::where('IdArticulos', $request->IdArticulos);
            $data = $request->only('IndBaja', 'Esfavorito');
            $data['IndBaja'] = "1";
            $data['Esfavorito'] = "0";
            $Ropa->update($data);
            return redirect()->to('/adminRopa')->with('success', 'Artículo dado de baja correctamente!');
        }

        // HABILITAR

        // Habilitar la Ropa
        public function availableRopa(Request $request)
        {
            $idRopa = $request->IdArticulos;
            $Ropa = Articulos::where('IdArticulos', $request->IdArticulos);
            $data = $request->only('IndBaja');
            $data['IndBaja'] = "0";
            $Ropa->update($data);
            return redirect()->to('/adminRopa')->with('success', 'Artículo dado de alta correctamente!');
        }

    // USUARIOS

        // Mostrar pagina usuarios
        public function usuarios()
        {
            $usuarios = Usuarios::get();
            return view('admins.usuarios.adminUsuarios', ['usuarios' => $usuarios]);
        }

        // AÑADIR

        // Mostrar página añadir usuarios
        public function showaddUsuario()
        {
            return view('admins.usuarios.addUsuario');
        }

        // Añadir el usuario
        public function addUsuario(RegisterRequest $request)
        {
            $user = Usuarios::create($request->validated());
            return redirect()->to('/adminUsuarios')->with('success', '¡Se ha creado el usuario correctamente!');
        }

        // EDITAR

        // Mostrar página editar usuario
        public $usuario;

        public function showeditUsuario(Request $request)
        {
            $usuario = Usuarios::find($request->id);
            return view('admins.usuarios.editUsuario', ['usuario' => $usuario]);
        }

        // Editar el usuario
        public function editUsuario(Request $request)
        {
            $usuario = Usuarios::find($request->id);
            $data = $request->only('id','Nombre', 'Apellido', 'Telefono', 'Direccion', 'CodigoPostal', 'Provincia', 'Idioma', 'Poblacion');
            if(trim($request->password) == '')
            {
                $request->validate([
                    'Nombre' => 'required|max:100',
                    'Apellido' => 'required|max:100',
                    'Direccion' => 'required|max:200',
                    'CodigoPostal' => 'required|min:5|max:5',
                    'Telefono' => 'required|min:9|max:9',
                    'Poblacion' => 'required|max:100'
                ]);
                $data= $request->except('password');
            }
            else
            {
                $request->validate([
                    'Nombre' => 'required|max:100',
                    'Apellido' => 'required|max:100',
                    'password' => 'required|min:6|max:50',
                    'Direccion' => 'required|max:5|max:200',
                    'CodigoPostal' => 'required|min:5|max:5',
                    'Telefono' => 'required|min:9|max:9',
                    'Poblacion' => 'required|max:100'
                ]);

                $request->all();
                $data['password']=$request->password;
            }
            $usuario->update($data);
            return back()->withInput()->with('success', '¡Usuario modificado correctamente!');
        }

        // ELIMINAR

        // Eliminar el usuario
        public function deleteUsuario(Request $request)
        {
            $eliminarLineasPedido = LineasPedido::where('IdUsuario', $request->id)->delete();
            $eliminarPedido = Pedido::where('IdUsuario', $request->id)->delete();
            $usuario = Usuarios::where('id', $request->id)->delete();
            
            return redirect()->to('/adminUsuarios')->with('success', '¡Usuario eliminado correctamente!');
        }

}
