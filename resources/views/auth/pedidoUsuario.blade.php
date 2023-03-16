@extends('layouts.app-master')

@section('content')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <div class="general-title">
        <p><a href="/cheesecakedecharlie/public/home">Cheesecake de Charlie</a></p>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/cheesecakedecharlie/public/home">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/informacion">Información general</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/pedidos">Productos</a>
                    </li>

                    <!-- Si no esta logeado -->
                    @guest
                        <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/login">Iniciar sesión / Regístrate</a>
                        </li>
                    @endguest

                    <!-- Si esta logeado -->
                    @auth
                        <li class="nav-item dropdown">  
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                            Hola, {{ auth()->user()->Nombre }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- Cerrar sesión -->
                            <a class="dropdown-item" href="{{ route('showProfile', encrypt(auth()->user()->id)) }}">Perfil</a>
                            <a class="dropdown-item active" href="{{ route('showPedidos', encrypt(auth()->user()->id)) }}">Pedidos</a>
                            <a class="dropdown-item" href="/cheesecakedecharlie/public/logout">Logout</a>
                        </div>
                        </li>
                    @endauth

                    <!-- Icono compra -->
                    @auth
                        <a class="navbar-brand" href="{{ route('showCesta', encrypt(auth()->user()->id)) }}">
                        <i class="bi bi-bag"></i>
                        </a>
                    @endauth
                    @guest
                        <a class="navbar-brand" href="/cheesecakedecharlie/public/cesta">
                        <i class="bi bi-bag"></i>
                        </a>
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
<!-- Contenido -->
<div class="contentAdministrator">
    @include('partials.messagesLogin')
    <br>
    <div class="list">
        <h2 class="titlePedido">Pedidos</h2>
        <hr style="background-color:black; margin-top:-3px;">
        <br>
        <table class="table table-striped table-responsive-sm" id="PedidosList">
            <thead>
                <tr>
                    <th>Id Pedido</th>
                    <th>Estado</th>
                    <th>Fecha Entrega</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidoUsuario as $pedidoUsuarios)
                    <tr>
                        <td>{!! $pedidoUsuarios->IdPedido !!}</td>
                        <td>{!! $pedidoUsuarios->DescripcionEstado !!}</td>
                        <td>{!! $pedidoUsuarios->FechaRecibirPedido !!}</td>
                        <td style="text-align:center;">
                            <a href="{{ route('showDetallePedidos', encrypt($pedidoUsuarios->IdPedido)) }}" class="btn btn-green"><span class="fa fa-eye" title="Ver pedido"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#PedidosList').dataTable();
    });
</script>

<style>
    .titlePedido{
        font-family: 'Lucida Console';
        position: relative;
        display: flex;
        justify-content: center;
        width: 100%;
    }
</style>

@include('admins.style')
</div>

@endsection