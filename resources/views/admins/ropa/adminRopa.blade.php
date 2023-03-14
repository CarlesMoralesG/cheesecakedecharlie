@extends('layouts.app-master')

@section('admin')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

<div class="general-title">
    <p><a href="adminPedidos">Cheesecake de Charlie</a></p>
</div>

<div class="menu">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">

            <!-- Botón menú -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Elementos del menu colapsable -->
            <div class="collapse navbar-collapse" id="menuPrincipal">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="adminPedidos">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminTartas">Tartas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminDIY">DIY</a>
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link active" href="adminRopa">Ropa</a>
                    </li>
                    -->
                    <li class="nav-item">
                        <a class="nav-link" href="adminUsuarios">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- Contenido -->
<div class="contentAdministrator">
    <a class="btn btn-primary" id="create" href="addRopa" role="button">Añadir Artículo</a>
    <br>
    @include('partials.messagesLogin')
    <br>
    <div class="list">
        <table class="table table-striped table-responsive-sm" id="RopaList">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Talla</th>
                    <th>Favorito</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($ropa as $ropas)
                    @if ( $ropas->IdCategoria == 3)
                        <tr>
                            <td>{!! $ropas->DescripcionArticulo !!}</td>
                            <td>{!! $ropas->StockArticulo !!}</td>
                            <td>{!! $ropas->Talla !!}</td>
                            @if ( $ropas->Esfavorito == 1)
                                <td>Sí</td>
                            @elseif ($ropas->Esfavorito == 0)
                                <td>No</td> 
                            @endif
                            <td style="text-align:center;">
                                <a href="editRopa/{!! $ropas->IdArticulos !!}" class="btn btn-green"><span class="fa fa-edit"></span></a>
                                @if($ropas->IndBaja == 0)
                                    <a href="deleteRopa/{!! $ropas->IdArticulos !!}" class="btn btn-green"><span class="fa fa-times" title="Deshabilitar Artículo"></span></a>
                                @else
                                    <a href="availableRopa/{!! $ropas->IdArticulos !!}" class="btn btn-green"><span class="fa fa-check" title="Habilitar Artículo"></span></a>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#RopaList').dataTable();
    });
</script>

@include('admins.style')

@endsection