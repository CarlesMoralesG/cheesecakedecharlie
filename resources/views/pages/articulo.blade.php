@extends('layouts.app-master')

@section('content')

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
                    <a class="nav-link active" href="/cheesecakedecharlie/public/pedidos">Productos</a>
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
    <div class="contentArticulo">
        @foreach ( $articulo as $articulo)
            @php
                if ($articulo->IdCategoria == "1" || $articulo->IdCategoria == "2")
                {
                    $tarta = "50%;";
                    $contenido = "47%;";
                }
                elseif($articulo->IdCategoria == "3")
                {
                    $tarta = "40%;";
                    $contenido = "57%;";
                }
            @endphp
            <h1 style="margin-top: -10px;">{!! $articulo->DescripcionArticulo !!}</h1>
            <hr style="background-color:black; margin-top:-3px;">
            <div class="contentProducto" style="width:{!! $tarta !!}">
                    <img style="width: 100%; height: 450px;" src="{{asset($articulo->Imagen)}}" alt="{!! $articulo->DescripcionArticulo !!}">
            </div>
            <div class="contentCompra" style="width:{!! $contenido !!}">
                <h3>Descripción</h3>
                <p style="text-align:justify">{!! $articulo->Resumen !!}</p>
                <p style="text-align:justify">Precio: {!! $articulo->PrecioArticulo !!}€</p>
                <div class="botonCompra">
                    @auth
                        <form action="{{ route('addCesta') }}" method="POST">
                            @csrf
                            <div style="text-align:right; margin-right:15px;">
                                <button type="button" id="down" class="btn btn-primary">-</button>
                                <input type="number" value="1" id="cantidad" style="width: 10%;" name="Cantidad" readonly>
                                <button type="button" id="up" class="btn btn-primary">+</button>

                                <input type="hidden" name='IdUsuario' value="{{ auth()->user()->id }}">
                                <input type="hidden" name='FechaVenta' value="{{ date('d-m-Y H:i:s') }}">
                                <input type="hidden" name='Estado' value="1">

                                <input type="hidden" name='IdArticulo' value="{{ $articulo->IdArticulos }}">
                                <input type="hidden" name='Precio' value="{{ $articulo->PrecioArticulo }}">
                                <input type="hidden" name='IdPedido' value="1">
                                
                                <button type="submit" class="btn btn-primary" style="margin-left:10px; margin-top:10px;">Añadir a la cesta</button>
                                <a onclick="back()" class="btn btn-primary" style="margin-top:10px; width:100px">Atrás</a>
                            </div>
                        </form>
                    @endauth
                    @guest
                        <p style="float: right;"> Para poder comprar debes <a class="btn btn-primary" href="/cheesecakedecharlie/public/login">Iniciar sesión o Registrate</a></p>
                    @endguest
                </div>
            </div>
        @endforeach
    </div>
    <div class="blanco">
        
    </div>

    <script>
        function back(){
            history.back();
        }
        $('#up').click(function(e){
            e.preventDefault();
            var inc_value = $('#cantidad').val();
            var value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;
            if(value < 10 ){
                value ++;
                $('#cantidad').val(value);
            }
        });

        $('#down').click(function(e){
            e.preventDefault();
            var inc_value = $('#cantidad').val();
            var value = parseInt(inc_value, 0);
            value = isNaN(value) ? 0 : value;
            if(value > 1 ){
                value --;
                $('#cantidad').val(value);
            }
        });
    </script>


    <style>
        body{
            margin: 0;
            width: 100%;
            height: 100%;
            font-family: 'Lucida Console';
        }
        
        /* Títulos */
        .general-title{
            font-family: 'Lucida Console';
            position: relative;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .general-title > p{
            margin-top: 20px; 
            font-size: 52px;
        }

        .general-title > p > a{
            text-decoration:none;
            color: black;
        }

        /* Menú */
        .menu{
            position: relative;
            margin-bottom: 30px;
            width: 100%;
        }

        .navbar-nav,
        .mr-auto {
            flex: 0.88;
            margin: auto !important;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
        }

        /* Contenido */
        .contentArticulo{
            width: 83%;
            margin-left:8.2%;
        }

        .contentProducto{
            float: left;
        }

        .contentCompra{
            background-color:rgb(250, 213, 166, 0.3)!important;
            margin-left: 3%;
            float: left;
            padding: 12px;
            border-radius: 8%;
        }

        .content-footer{
            margin: 20px 10px;
            clear: both;
        }

        .blanco{
            clear: both;
        }

        /* Botones */
        .btn{
            background-color: burlywood !important;
            border-color: white !important;
        }
        .btn:hover{
            background-color: rgb(250, 213, 166) !important;
            border-color: white !important;
        }

        .dropdown-item.active{
            background-color: burlywood !important;
            border-color: white !important;
        }

        .dropdown-item.active:hover{
            background-color: rgb(250, 213, 166) !important;
            border-color: white !important;
        }

        @media screen and (max-width: 1000px) {
            .contentArticulo{
            width: 83%;
            margin-left:8.2%;
            display: grid;
            grid-template-columns: 1fr;
        }

        .contentProducto{
            width: 100% !important;
        }

        .contentCompra{
            background-color:rgb(250, 213, 166, 0.4)!important;
            width: 100% !important;
            float: left;
            margin-top: 10px; 
            margin-left: 0%; 
            padding: 12px;
            border-radius: 5%;
        }
        }
    </style>

@endsection