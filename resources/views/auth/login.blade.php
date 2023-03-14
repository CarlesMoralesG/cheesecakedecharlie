
@extends('layouts.app-master')

@section('content')

<div class="general-title-ir">
    <p><a href="home">Cheesecake de Charlie</a></p>
</div>
<div class="menu">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
      <div class="container-fluid">

        <!-- Botón menú -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Elementos del menú colapsable -->
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
              <li class="nav-item active">
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
                  <a class="dropdown-item" href="logout">Logout</a>
                </div>
              </li>
            @endauth

            <!-- Icono compra -->
            <a class="navbar-brand" href="cesta">
              <i class="bi bi-bag"></i>
            </a>

          </ul>
        </div>

      </div>
    </nav>

  </div>
  <div class="mensajeAlerta">
    @include('partials.messagesLogin')
  </div>
<div class="content-ir">
    <!-- Iniciar sesión -->
    <div id="inicioSesionOculto" style="display:none;" >
      <p>¿Ya tienes cuenta?</p>
      <button class="btn btn-primary" onclick="functionLogin()" id="botonInicioSesion"  type="button"><span>Inicia Sesión</span></button>
    </div>

    <div class="iniciarSesion" id="idiniciarSesion" style="display:block;">
        <h1>Iniciar sesión</h1>
        <br>
        <form action="login" method="POST">
            @csrf
            <div class="mb-3">
                <label for="Email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="Email" aria-describedby="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
    </div>

    <!-- Registrarse -->
    <div id="registroOculto" name="formRegistrar">
      <p>¿Aún no tienes cuenta?</p>
      <button class="btn btn-primary" onclick="functionRegistrar()" id="botonRegistro"  type="button"><span>Regístrate</span></button>
    </div>

    <div class="registrarse" id="registrate" style="display:none;">
        <h1>Regístrate</h1>
        <br>
        <form class="row g-3" action="register" method="POST">
            @csrf
            <div class="col-md-4">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" name="Nombre" class="form-control" id="Nombre" value="{{old('Nombre')}}" >
            </div>
            <div class="col-md-4">
                <label for="Apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="Apellido" id="Apellido" value="{{old('Apellido')}}" >
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="tu-correo@gmail.com" >
            </div>
            <div class="col-md-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" >
            </div>
            <div class="col-md-3">
                <label for="Telefono" class="form-label">Teléfono</label>
                <input type="number" class="form-control" name="Telefono" id="Telefono" value="{{old('Telefono')}}" >
            </div>
            <div class="col-md-5">
            <label for="Direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="Direccion" id="Direccion" value="{{old('Direccion')}}" >
            </div>
            <div class="col-md-2">
                <label for="CodigoPostal" class="form-label">Código Postal</label>
                <input type="number" class="form-control" name="CodigoPostal" value="{{old('CodigoPostal')}}" id="CodigoPostal" >
            </div>
            <div class="col-md-3">
              <label for="Poblacion" class="form-label">Población</label>
              <input type="text" class="form-control" name="Poblacion" id="Poblacion" value="{{old('Poblacion')}}" >
          </div>
            <div class="col-md-3">
                <label for="Provincia" class="form-label">Provincia</label>
                <select class="form-select" name="Provincia" id="Provincia" aria-describedby="Provincia" >
                    <option selected disabled value="">Escoge la provincia</option>
                    <option value="Barcelona">Barcelona</option>
                </select>
            </div>
            <div class="col-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="EnvioPublicidad" id="EnvioPublicidad">Suscríbete a nuestra Newsletter!
                    <br>
                    <input class="form-check-input" type="checkbox" value="1" name="TerminosCondiciones" id="TerminosCondiciones" >Aceptar términos y condiciones.
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit"><span>Regístrate</span></button>
            </div>
        </form>
    </div>
</div>

<script>

  var registrarse = document.getElementById("registrate");
  var botonRegistro = document.getElementById("registroOculto");
  var iniciarSesion = document.getElementById("idiniciarSesion");
  var botonInicioSesion = document.getElementById("inicioSesionOculto");

  function functionRegistrar()
  {
    if (registrarse.style.display === "none") 
    {
      registrarse.style.display = "block";
      botonRegistro.style.display = "none";
      iniciarSesion.style.display = "none";
      botonInicioSesion.style.display = "block";
    }
  }

  function functionLogin()
  {
    if (iniciarSesion.style.display === "none") 
    {
      iniciarSesion.style.display = "block";
      botonRegistro.style.display = "block";
      registrarse.style.display = "none";
      botonInicioSesion.style.display = "none";
    } 
    else
    {
      iniciarSesion.style.display = "none";
    }
  }

</script>

<style>

  body{
      margin: 0;
      width: 100%;
      height: 100%;
      font-family: 'Lucida Console';
  }

  /* Título */
  .general-title-ir{
      font-family: 'Lucida Console';
      position: relative;
      display: flex;
      justify-content: center;
      width: 100%;
  }

  .general-title-ir > p{
      margin-top: 20px; 
      font-size: 52px;
  }

  .general-title-ir > p > a{
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
  .content-ir{
      display: grid;
      grid-template-columns: 1fr 2fr;
      height: 100%;
      margin: 0 142px;
      margin-top: 4%;
      margin-bottom: 6%;
  }

  .mensajeAlerta{
    width: 100%;
    height: 10%;
  }

  /* Iniciar sesión */
  .iniciarSesion{
      place-items: center;
      margin-right: 50px;
  }

  #idiniciarSesion{
    display: block;
  }

  .iniciarSesion h1{
      color: black;
      font-size: 40;
  }

  #inicioSesionOculto{
    justify-self:center;
    margin-top: 140px;
  }

  /* Registrarse */
  .registrarse{
      place-items: center;
      margin-left: 50px;
  }

  .registrarse h1{
      color: black;
      font-size: 40;
  }

  #registroOculto{
    justify-self:center;
    margin-top: 90px;
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

  #botonRegistro{
    font-size: 15px; 
    width:130px; 
    height:40px; 
    margin-top: -10px;
    margin-left: 10px;
  }

  #botonInicioSesion{
    font-size: 15px; 
    width:130px; 
    height:40px; 
    margin-top: -10px;
    margin-left: -5px;
  }

  .btn-registro{
    cursor:pointer;
    margin:15px;
    padding:5px;
    width: 100px;
    height: 50px;
    background-color: burlywood;
    border-color: white;
    color: white;
  }
  
  /* Responsive */
  @media screen and (max-width: 1050px) {
    .content-ir{
      grid-template-columns: 1fr;
      margin: 0 20px;
    }

    .registrarse{
      place-items: center;
      margin-left: -10px;
      margin-top: 20px;
    }

    #botonRegistro{
      margin-top: 20px;
    }
  }

</style>

@endsection