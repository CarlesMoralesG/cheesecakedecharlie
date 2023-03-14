@extends('layouts.app-master')

@section('content')

    <div class="general-title">
        <p><a href="home">Cheesecake de Charlie</a></p>
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
                    <a class="nav-link" href="home">
                        Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nosotros">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="informacion">Información general</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pedidos">Productos</a>
                </li>

                <!-- Si no esta logeado -->
                @guest
                    <li class="nav-item">
                    <a class="nav-link" href="login">Iniciar sesión / Regístrate</a>
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
                        <a class="dropdown-item" href="logout">Logout</a>
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
    <div class="contentInformacion">
        <div class="pedidosYreservas">
            <h3 style="margin-bottom: 25px; color:burlywood">Pedidos y Reservas</h3>
            <p>Los pedidos online se deben realizar con una semana de antelación.</p>
            <p>En la sección de Productos encontrarás todas las tartas disponibles ¡Descúbrenos!</p>
        </div>
        <hr style="background-color:black">
        <div class="envioYRecogida">
            <h3 style="margin-bottom: 25px; color:burlywood">Localización</h3>
            <p>Paseo Francesc Macià 91, 08173 Sant Cugat del Vallés.</p>
        </div>
        <hr style="background-color:black">
        <div class="horario">
            <h3 style="margin-bottom: 25px; color:burlywood">Horario</h3>
            <p>Lunes a Sábado: 10:30h a 18:30h.</p>
            <p>Domingo cerrado.</p>
        </div>
        <hr style="background-color:black">
        <div class="zonaReparto">
            <h3 style="margin-bottom: 25px; color:burlywood">Zona de Reparto</h3>
            <p>Sant Cugat del Vallés y alrededores</p>
        </div>
        <hr style="background-color:black">
        <div class="alergenos">
            <h3 style="margin-bottom: 25px; color:burlywood">Alérgenos</h3>
            <p>Todas las tartas contienen huevos, leche y gluten y pueden contener trazas de frutos secos. Para las ediciones especiales, consultar alérgenos.</p>
            <p>Existe la posibilidad de hacer tartas con galleta sin gluten (pueden contener trazas) bajo pedido.</p>
        </div>
    </div>

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
        .contentInformacion{
            width: 83%;
            margin-left:8.2%;
        }

        .pedidosYreservas{
            text-align: left;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .pedidosYreservas > p{
            margin-top: -15px;
            font-size: 19px;
        }

        .envioYRecogida{
            text-align: right;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .envioYRecogida > p{
            margin-top: -15px;
            font-size: 19px;
        }

        .horario{
            text-align: left;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .horario > p{
            margin-top: -15px;
            font-size: 19px;
        }

        .zonaReparto{
            text-align: right;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .zonaReparto > p{
            margin-top: -15px;
            font-size: 19px;
        }

        .alergenos{
            text-align: left;
            margin-bottom: 40px;
        }

        .alergenos > p{
            margin-top: -15px;
            font-size: 19px;
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