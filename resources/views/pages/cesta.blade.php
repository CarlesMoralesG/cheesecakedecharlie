@extends('layouts.app-master')

@section('content')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    @php
        $count = 0;
        $totalCesta = 0;
    @endphp

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
                                <a class="dropdown-item" href="/cheesecakedecharlie/public/logout">Logout</a>
                            </div>
                            </li>
                        @endauth

                        <!-- Icono compra -->
                        @auth
                            <a class="navbar-brand" href="{{ route('showCesta', encrypt(auth()->user()->id)) }}">
                                <i styel="font-family:Arial" class="bi bi-bag"></i>
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
    <div class="contentCesta">
        <h2 class="titleCesta">Tu Cesta</h2>
        <hr style="background-color:black; margin-top:-3px;">
        @include('partials.messagesLogin')
        <div class="cart-table">
            @foreach ($cesta as $cesta)
                @php
                    $totalPedido = $cesta->Precio*$cesta->Cantidad;
                @endphp
                <div class="card">
                    <div class="row g-0">
                        <div class="col-sm-3 position-relative">
                            <img class="card-img-top"src="{{asset($cesta->Imagen)}}" alt="{!! $cesta->DescripcionArticulo !!}">
                        </div>
                        <div class="col-sm-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a class="link-dark text-decoration-none"  href="/cheesecakedecharlie/public/articulo/{!! encrypt($cesta->IdArticulos) !!}" >{!! $cesta->DescripcionArticulo !!} </a>
                                </h5>
                                <p class="card-text"><span style="color: grey;">{!! $cesta->DescripcionCategoria !!} {!! $cesta->Tamanyo !!}</span></p>
                                <p class="card-text">Precio unidad: <span style="color: grey;">{!! $cesta->Precio !!}€</span></p>
                                <form action="{{ route('guardarCesta') }}" action="POST">
                                    @csrf
                                    <input type="hidden" name="IdLineaPedido" value="{!! $cesta->IdLineaPedido !!}">
                                    <div class="cantidad">
                                        <span>Unidades: </span><select name="Cantidad" id="Cantidad">
                                            <option style="color: grey" value="{!! $cesta->Cantidad !!}">{!! $cesta->Cantidad !!}</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="margin-left:10px; margin-top:10px;">Guardar</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer text-end" id="papelera">
                            <a style="text-decoration:none; color:burlywood" href="/cheesecakedecharlie/public/deleteCesta/{!! $cesta->IdLineaPedido !!}"><i class="fa fa-trash-o fa-2x"></i></a><br>
                        </div>
                    </div>
                </div>
                <br>
                @php
                    $count++;
                    $totalCesta += $totalPedido;
                @endphp
            @endforeach
            @if($count == 0)
                <div class="cestaVacia">
                    <p>La cesta está vacía :(</p>
                </div>
            @endif 
            <div class="card">
                <div class="card-header titleCesta" style="font-size:30px">
                    Total cesta
                </div>
                <div class="card-body" style="position: relative; display: flex;">
                    @if ($count > 0)
                        <div id="totalCesta">
                            <p class="card-text btn btn-primary" style="width:200px; font-size: 22px; margin-right:40px;">Total: {!! $totalCesta !!}€</p>
                        </div>
                    @else
                        <div id="totalCestaSola">
                            <p class="card-text btn btn-primary" style="width:200px; font-size: 22px; margin-right:40px;">Total: {!! $totalCesta !!}€</p>
                        </div>
                    @endif
                    @if ($count > 0)
                        <p class="card-text btn btn-primary text-end"> <a href="{{ route('checkout.index', encrypt(auth()->user()->id)) }}" style="font-size: 22px; color:white; text-decoration:none; float:right">Finalizar</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endauth
    @guest
        <div class="controlInicioSesion">
            <a class="btn btn-primary" href="/cheesecakedecharlie/public/login">Inicia sesión o Regístrate</a>
        </div>
    @endguest


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

        .controlInicioSesion{
            font-family: 'Lucida Console';
            position: relative;
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top:12%;
            margin-bottom: 13%;
        }

        .cestaVacia{
            font-family: 'Lucida Console';
            position: relative;
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top:10%;
            margin-bottom: 11%;
        }
        
        .precio{
            float: right;
            margin-left:90%;
        }

        #papelera{
            margin-right: 10%;
        }

        #totalCesta{
            position: relative;
            display: flex;
            width: 100%;
            justify-content: center;
            margin-left:10%;
        }
        #totalCestaSola{
            position: relative;
            display: flex;
            width: 100%;
            margin-left:3%;
            justify-content: center;
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

        .titleCesta{
            font-family: 'Lucida Console';
            position: relative;
            display: flex;
            justify-content: center;
            width: 100%;
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
    </style>

@endsection