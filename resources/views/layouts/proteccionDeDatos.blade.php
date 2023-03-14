  
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
            <p>Protección de datos</p>
        </div>
        <hr style="background-color:black; margin-top:-3px;">
        <p>En CheesecakedeCharlie, valoramos y respetamos la privacidad de nuestros clientes. A continuación, describimos cómo manejamos y protegemos su información personal:</p>
        <ol>
        <li><strong>Información recogida:</strong> Recopilamos información personal como nombres, direcciones de correo electrónico y direcciones de envío para procesar pedidos y mejorar su experiencia de compra.</li>
        <br>
        <li><strong>Uso de la información:</strong> Utilizamos su información personal solo para los fines para los que se nos proporcionó. No compartimos ni vendemos su información a terceros.</li>
        <br>
        <li><strong>Seguridad de la información:</strong> Tomamos medidas razonables para proteger su información personal contra el acceso no autorizado, uso o divulgación.</li>
        <br>
        <li><strong>Acceso a su información:</strong> Tiene derecho a acceder y corregir su información personal en cualquier momento.</li>
        <br>
        <li><strong>Cambios a esta política de privacidad:</strong> Nos reservamos el derecho de modificar esta política de privacidad en cualquier momento y sin previo aviso. Por favor, revise periódicamente esta política para estar al tanto de cualquier cambio.</li>
        </ol>
        <br>
        <p>Si tiene alguna pregunta sobre nuestra política de privacidad, no dude en ponerse en contacto con nosotros a través de nuestro sitio web.</p>
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