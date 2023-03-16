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
                    <li class="nav-item active">
                        <a class="nav-link" href="nosotros">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="informacion">Información general</a>
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
                            <a class="dropdown-item" href="{{ route('showPedidos', encrypt(auth()->user()->id)) }}">Pedidos</a>
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
    <div class="contentNosotros">
        <div class="tituloNosotros">
            <h1>Érase una vez</h1>
            <h1><strong>Un estudiante que...</strong></h1>
        </div>
        <div class="textoNosotros">
            <div class="textoDerecha">
                <p>Hace ya más de dos años, <strong>Charlie</strong> elaboraba tartas y pasteles, utilizando ingredientes 100% naturales y una especial sensibilidad, que aportaba al resultado, algo muy especial. Algo que las hacía diferentes. </p>

                <p>Todo comenzó con la ya conocida Tarta de Queso. Una tarta que presentaba en comidas con familiares y amigos, hasta que poco después, animada por sus más allegados, decidió ofrecerla a los restaurantes. Así nació <strong style="color:burlywood">Cheesecake de Charlie</strong></p>

                <p>Hoy por hoy, más de 150 restaurantes en Barcelona, disponen en su carta de postres, alguna creación de <strong style="color:burlywood">Cheesecake de Charlie.</strong></p>

                <p>Hay muchas Tartas de Queso y muchas de ellas son deliciosas, pero la de <strong>Charlie</strong>, ha conseguido ser, quizás, la más conocida en Barcelona. </p>

                <p>Durante estos más de diez años, <strong style="color:burlywood">Cheesecake de Charlie</strong> se ha consolidado como un sello exitosos y de calidad, con un amplio catálogo de pasteles y tartas que podeis consultar, tanto en esta web, como en Instagram <strong>(@CheesecakedeCharlie)</strong> </p>
            </div>
            <div class="textoIzquierda">
                <p>En la actualidad, <strong>Charlie</strong> y su amplio equipo de cuatro especialistas resposteros, elabora todo tipo de tartas y pasteles, tanto para particulares, restaurantes y caterings, con el mismo espíritu que motivó sus inicios:</p>

                <p>«Ofrecer deliciosas tartas artesanales que acompañen a las personas en sus momentos más dulces»</p>

                <p>Ya sea en casa o en la de tus amigos, en un restaurante, el día de tu cumpleaños o de tu boda,  <strong style="color:burlywood">Cheesecake de Charlie</strong> estará a tu lado para hacer de cada celebración un momento inolvidable.</p>
            </div>
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
        .contentNosotros{
            width: 83%;
            margin-left:8.2%;
        }

        .textoNosotros{
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .textoDerecha{
            margin-right: 20px;
            text-align: justify;
        }

        .textoIzquierda{
            margin-left: 20px;
            text-align: justify;
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

        @media screen and (max-width: 700px) {
            .textoNosotros{
                grid-template-columns: 1fr;
            }

            .textoDerecha{
                margin-right: 0px;
            }

            .textoIzquierda{
                margin-left: 0px;
            }
        }
    </style>

@endsection