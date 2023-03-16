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
@auth
    <div class="contentPedido">
        <h2 class="titlePedido">Detalle Pedido</h2>
        <hr style="background-color:black; margin-top:-3px;">
        @include('partials.messagesLogin')
        <div class="cart-table">
            @foreach ($detallePedido as $detallePedido)
                <div class="card">
                    <div class="row g-0">
                        <div class="col-sm-3 position-relative">
                            <img class="card-img-top"src="{{asset($detallePedido->Imagen)}}" alt="{!! $detallePedido->DescripcionArticulo !!}">
                        </div>
                        <div class="col-sm-4">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a class="link-dark text-decoration-none"  href="/cheesecakedecharlie/public/articulo/{!! encrypt($detallePedido->IdArticulos) !!}" >{!! $detallePedido->DescripcionArticulo !!} </a>
                                </h5>
                                <p class="card-text"><span style="color: grey;">{!! $detallePedido->DescripcionCategoria !!} {!! $detallePedido->Tamanyo !!}</span></p>
                                <p class="card-text">Precio unidad: <span style="color: grey;">{!! $detallePedido->Precio !!}€</span></p>
                                <p class="card-text">Cantidad: <span style="color: grey;">{!! $detallePedido->Cantidad !!}</span></p>
                                <label for="Comentario">Comentarios</label>
                                <br>
                                <textarea id="Comentario" name="Comentario" rows="4" cols="40" disabled style="resize:none">{!! $detallePedido->Comentario !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <br>
        </div>
        <br>
        <a onclick="back()" class="btn btn-primary" style="margin-top:10px; width:100px; color:white;">Atrás</a>
    </div>
    @endauth

<script>
    function back(){
        history.back();
    }
    $(document).ready(function(){
        $('#DetallePedidosList').dataTable();
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
    .card{
        margin-left: 16px;
        margin: 0 auto;
        margin-bottom: 20px;
    }

    .card-text{
        text-align: justify; 
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@include('admins.style')
</div>

@endsection