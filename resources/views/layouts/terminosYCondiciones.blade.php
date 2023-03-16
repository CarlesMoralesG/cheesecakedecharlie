  
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
    <div class="titleLegal">
        <p>Términos y condiciones</p>
    </div>
    <hr style="background-color:black; margin-top:-3px;">
    <ol>
      <li><strong>Aceptación de los términos y condiciones:</strong> Al utilizar el sitio web de CheesecakedeCharlie, acepta estos términos y condiciones y reconoce que cualquier otro acuerdo entre usted y CheesecakedeCharlie está sujeto a estos términos.</li>
      <br>
      <li><strong>Modificaciones:</strong> CheesecakedeCharlie se reserva el derecho de modificar estos términos y condiciones en cualquier momento y sin previo aviso.</li>
      <br>
      <li><strong>Productos y precios:</strong> Todos los productos y precios están sujetos a cambio sin previo aviso. No se garantiza la disponibilidad de todos los productos en todo momento.</li>
      <br>
      <li><strong>Pedidos:</strong> Al hacer un pedido en el sitio web de CheesecakedeCharlie, está ofreciendo comprar un producto sujeto a estos términos y condiciones. Todos los pedidos están sujetos a la aceptación de CheesecakedeCharlie.</li>
      <br>
      <li><strong>Entrega:</strong> CheesecakedeCharlie hará todo lo posible para entregar los productos en la fecha acordada, pero no garantiza fechas específicas de entrega.</li>
      <br>
      <li><strong>Devoluciones y reembolsos:</strong> CheesecakedeCharlie aceptará devoluciones y reembolsos solo si los productos están defectuosos o si hay un error en el pedido.</li>
      <br>
      <li><strong>Propiedad intelectual:</strong> Todos los contenidos del sitio web de CheesecakedeCharlie, incluidos textos, imágenes y diseños, están protegidos por derechos de autor y propiedad intelectual.</li>
      <br>
      <li><strong>Limitación de responsabilidad:</strong> CheesecakedeCharlie no será responsable por cualquier pérdida indirecta, incidental, consecuente o daño especial que resulte del uso del sitio web o de los productos.</li>
      <br>
      <li><strong>Ley aplicable:</strong> Estos términos y condiciones están regidos e interpretados de acuerdo con las leyes del país en el que se encuentra CheesecakedeCharlie.</li>
      <br>
      <li><strong>Dispute resolution:</strong> Cualquier disputa relacionada con estos términos y condiciones o su uso del sitio web de CheesecakedeCharlie se resolverá a través de arbitraje vinculante.</li>
    </ol>
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

  .titleLegal{
    position: relative;
    display: flex;
    justify-content: center;
    width: 100%;
  }

  .titleLegal > p{
    margin-top: 10px; 
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
    text-align: justify;
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
  }
</style>

@endsection