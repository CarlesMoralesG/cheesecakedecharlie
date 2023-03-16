  
  @extends('layouts.app-master')

  @section('content')

  @php
    $count = 0;
  @endphp


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  
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
              <a class="nav-link active" href="home">
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
  <div class="contentProductos">
    <!-- Carousel images -->
    <div id="carouselPrincipal" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/DIYPortada.jpeg" alt="DIY" style="height:600px; width:100%;">
        </div>
        <div class="carousel-item">
          <img src="images/tartaGruyere.png" alt="Cheesecake de Gruyère" style="height:600px; width:100%;">
        </div>
        <div class="carousel-item">
          <img src="images/tartaPistacho.jpeg" alt="Cheesecake de Pistacho" style="height:600px; width:100%;">
        </div>
        <!-- Botón pedir online -->
        <div class="botonPedirOnlineCarousel">
          <button class="btn btn-primary"><a href="pedidos">Pedir Online</a></button>
        </div>
      </div> 
      <a href="#carouselPrincipal" class="carousel-control-prev" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" arial-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a href="#carouselPrincipal" class="carousel-control-next" role="button" data-slide="next">
        <span class="carousel-control-next-icon" arial-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
      </a>
    </div>

    <!-- Top ventas -->
    <div class="title-top-ventas">
      <p>TOP Ventas</p>
    </div>
    <hr style="background-color:black; margin-top:-3px;">
    <div class="contenido-top-ventas">
      @foreach ( $favorito as $favoritos )

        @break($count == 4)

        <div class="card" style="width: 18rem;">
          <img class="card-img-top" style="height: 230px" src="{{asset($favoritos->Imagen)}}" alt="{!! $favoritos->DescripcionArticulo !!}">
          <div class="card-body">
            <h5 class="card-title">{!! $favoritos->DescripcionArticulo !!}</h5>
            <p class="card-text">Tamaño: <span style="color:grey">{!! $favoritos->Tamanyo !!}</span></p>
            <p class="card-text">{!! $favoritos->Resumen !!}</p>
            <a style="float: right;" href="articulo/{!! encrypt($favoritos->IdArticulos) !!}" class="btn btn-primary">Ver más</a>
          </div>
        </div>

        @php
          $count++;
        @endphp

      @endforeach
    </div>

    <!-- Newsletter -->
    <div class="title-newsLetter">
      <h2>Newsletter.</h2>
      <h2>Suscríbete y recibe nuestras novedades.</h2>
    </div>
    <div class="contenido-newsletter">
      <form action="newsletter" method="POST">
        @csrf
        <div class="mb-3">
          @include('partials.messagesLogin')
          <input type="email" style="width:350px" name="correoNewsletter" class="form-correoNewsletter" id="correoNewsletter">
          <button class="btn btn-primary" style="width: 70px;" type="submit"><i class='fa fa-send' style='color:white'></i></button>
        </div>
      </form>
    </div>
  </div>
  
</body>
</html>
<style>

  body{
    background-color: white;
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

  .title-top-ventas{
    position: relative;
    display: flex;
    justify-content: center;
    width: 100%;
  }

  .title-top-ventas > p{
    margin-top: 25px; 
    font-size: 25px;
    margin-bottom: 5px;
  }

  .title-newsLetter{
    margin-top: 50px;
    text-align: center;
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
  .contentProductos{
    width: 83%;
    margin-left:8.2%;
  }

  .contenido-top-ventas{
    display: flex; 
    margin: 0 auto !important;
  }

  .contenido-newsletter{
    text-align:center;
    margin-top: 20px;
  }

  .card{
    margin-left: 16px;
    margin: 0 auto;
  }

  .card-text{
    text-align: justify; 
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }


  /* Carousel */
  #carouselPrincipal{
    display: block;
  }

  /* Boton pedir online */
  .botonPedirOnlineCarousel{
    position: relative /* o absolute*/;
    width:140px;
    z-index:99;
    margin-left: 46%;
    margin-top: 500px;
  }

  .btn{
    background-color: burlywood !important;
    border-color: white !important;
  }

  .btn > a{
    text-decoration: none;
    color: white;
  }

  .btn:hover{
    background-color: rgb(250, 213, 166) !important;
    border-color: white !important;
  }


  /* Footer */
  .content-footer{
    height: auto;
    margin: 20px 10px;
    background-color: #F8F9FA; 
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
  }

  .footer-title{
    font-size: 20px;
  }

  .footer-contact{
    margin-top: 35px;
    font-size: 15px;
    margin-left: 25%;
  }

  .footer-information{
    margin-top: 35px;
    font-size: 15px;
    margin-left: 20px;
  }

  #map{
    margin-top: 35px;
    margin-right: 20px;
  }

  @media screen and (max-width: 1000px) {
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

    .botonPedirOnlineCarousel{
      margin-left: 40%;
    }

    .contenido-top-ventas{
      display: grid;
      grid-template-columns: 1fr 1fr;
      margin: 0 auto;
    }

    .card{
      margin-bottom: 80px;
      margin: 0 auto;
    }

    @media screen and (max-width: 714px) {
      .contenido-top-ventas{
        display: grid;
        grid-template-columns: 1fr;
        margin: 0 auto;
      }

      .card{
        margin-bottom: 20px;
        margin: 0 auto;
      }
    }
  }
</style>

@endsection