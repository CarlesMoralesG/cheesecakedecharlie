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
                    <a class="nav-link" href="informacion">Información general</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="pedidos">Productos</a>
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
        @include('partials.messagesLogin')
        <h2 class="titleArticle">TARTAS</h2>
        <hr style="background-color:black; margin-top:-3px;">
        <h4 class="titleArticle">Tamaño Grande (10-12 personas)</h4>
        <hr style="background-color:black; margin-top:-3px;">  
        <div class="contentTartas"> 
            @foreach ( $articulos as $tartas )
                @if ($tartas->IdCategoria == 1)
                    @if($tartas->Tamanyo == 'Grande')
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" style="height: 230px" src="{{asset($tartas->Imagen)}}" alt="{!! $tartas->DescripcionArticulo !!}">
                            <div class="card-body">
                                <h5 class="card-title">{!! $tartas->DescripcionArticulo !!}</h5>
                                <p class="card-text">{!! $tartas->Resumen !!}</p>
                                <a style="float: right;" href="articulo/{!! encrypt($tartas->IdArticulos) !!}" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        <br>
        <h4 class="titleArticle">Tamaño Mediano (6-8 personas)</h4>
        <hr style="background-color:black; margin-top:-3px;"> 
        <div class="contentTartas"> 
            @foreach ( $articulos as $tartas )
                @if ($tartas->IdCategoria == 1)
                    @if($tartas->Tamanyo == 'Mediana')
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" style="height: 230px" src="{{asset($tartas->Imagen)}}" alt="{!! $tartas->DescripcionArticulo !!}">
                            <div class="card-body">
                                <h5 class="card-title">{!! $tartas->DescripcionArticulo !!}</h5>
                                <p class="card-text">{!! $tartas->Resumen !!}</p>
                                <a style="float: right;" href="articulo/{!! encrypt($tartas->IdArticulos) !!}" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
        <br>
        <h2 class="titleArticle">DIY (Házlo tu mismo)</h2>
        <hr style="background-color:black; margin-top:-3px;">
        <div class="contentDIY">
            @foreach ( $articulos as $DIY )
                @if ($DIY->IdCategoria == 2)
                    @if($DIY->Tamanyo == 'Mediana')
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" style="height: 230px" src="{{asset($DIY->Imagen)}}" alt="{!! $DIY->DescripcionArticulo !!}">
                            <div class="card-body">
                                <h5 class="card-title">{!! $DIY->DescripcionArticulo !!}</h5>
                                <p class="card-text">{!! $DIY->Resumen !!}</p>
                                <a style="float: right;" href="articulo/{!! encrypt($DIY->IdArticulos) !!}" class="btn btn-primary">Ver más</a>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
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

        .titleArticle{
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
        
        /* Contenido */
        .card{
            margin-left: 9%;
            margin: left;
        }

        .card-text{
            text-align: justify; 
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .contentTartas{
            display: grid;
            grid-template-columns:  1fr 1fr 1fr 1fr 1fr;
            grid-gap: 20px;
            margin: 0 auto !important;
            justify-content: center;
        }

        .contentDIY{
            display: grid;
            grid-template-columns:  1fr 1fr 1fr 1fr 1fr;
            grid-gap: 20px;
            align-content: space-between;
        }

        .contentRopa{
            display: grid;
            grid-template-columns:  1fr 1fr 1fr 1fr 1fr;
            grid-gap: 20px;
            margin: 0 auto !important;
            justify-content: center;
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

        @media screen and (max-width: 1500px) {
                .contentTartas{
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr 1fr;
                    grid-gap: 20px;
                    margin: 0 auto;
                }

                .contentRopa{
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr 1fr;
                    grid-gap: 20px;
                    margin: 0 auto;
                }

                .contentDIY{
                    display: grid;
                    grid-template-columns: 1fr 1fr 1fr 1fr;
                    grid-gap: 20px;
                    margin: 0 auto;
                }

                .card{
                    margin-bottom: 20px;
                    margin: 0 auto;
                }
            }

        @media screen and (max-width: 1240px) {
            .content-footer{
            height: auto;
            margin: 20px 20px;
            background-color: #F8F9FA; 
            display: grid;
            grid-template-columns: 1fr;
            }

            .footer-title{
            font-size: 20px;
            }

            .footer-contact{
            margin-top: 35px;
            font-size: 15px;
            margin-left: 0%;
            }

            .footer-information{
            margin-top: 35px;
            font-size: 15px;
            margin-left: 0%;
            }

            #map{
            margin-top: 35px;
            margin-right: 20px;
            }  

            .contentTartas{
                display: grid;
                grid-template-columns:  1fr 1fr 1fr;
                grid-gap: 20px;
                margin: 0 auto;
            }

            .contentRopa{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-gap: 20px;
                margin: 0 auto;
            }

            .contentDIY{
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                grid-gap: 20px;
                margin: 0 auto;
            }

            .card{
                margin: 0 auto;
                margin-bottom: 20px;
            }
        }
        @media screen and (max-width: 930px) {
                .contentTartas{
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    grid-gap: 20px;
                    margin: 0 auto;
                }

                .contentRopa{
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    grid-gap: 20px;
                    margin: 0 auto;
                }

                .contentDIY{
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    grid-gap: 20px;
                    margin: 0 auto;
                }

                .card{
                    margin-bottom: 20px;
                    margin: 0 auto;
                }
            }
        @media screen and (max-width: 676px) {
                .contentTartas{
                    display: grid;
                    grid-template-columns: 1fr;
                    grid-gap: 20px;
                    margin: 0 auto;
                }

                .contentRopa{
                    display: grid;
                    grid-template-columns: 1fr;
                    grid-gap: 20px;
                    margin: 0 auto;
                }

                .contentDIY{
                    display: grid;
                    grid-template-columns: 1fr;
                    grid-gap: 20px;
                    margin: 0 auto;
                }

                .card{
                    margin-bottom: 20px;
                    margin: 0 auto;
                }
            }
    </style>

@endsection