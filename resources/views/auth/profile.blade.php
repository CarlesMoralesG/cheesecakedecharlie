@auth

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
            <li class="nav-item dropdown">  
            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                Hola, {{ auth()->user()->Nombre }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- Cerrar sesión -->
                <a class="dropdown-item active" href="profile">Perfil</a>
                <a class="dropdown-item" href="logout">Logout</a>
            </div>
            </li>

            <!-- Icono compra -->
            <a class="navbar-brand" href="{{ route('showCesta', encrypt(auth()->user()->id)) }}">
              <i class="bi bi-bag"></i>
            </a>

          </ul>
        </div>

      </div>
    </nav>

</div>

<h1 id="title-edit-profile">Edita tu perfil</h1>
<br>
<div class="content-edit-profile">
    <form class="row g-3" action="{{ route('editProfile') }}" method="POST">
        @csrf
        <div class="col-md-3">
          <label for="Nombre" class="form-label">Nombre</label>
          <input type="text" name="Nombre" value="{{ auth()->user()->Nombre }}" class="form-control" id="Nombre">
        </div>
        <div class="col-md-3">
          <label for="Apellido" class="form-label">Apellido</label>
          <input type="text" class="form-control" value="{{ auth()->user()->Apellido }}" name="Apellido" id="Apellido">
        </div>
        <div class="col-md-3">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Sólo escribir para cambiar la contraseña" aria-describedby="password">
        </div>
        <div class="col-md-2">
          <label for="CodigoPostal" class="form-label">Código Postal</label>
          <input type="number" class="form-control" value="{{ auth()->user()->CodigoPostal }}" name="CodigoPostal" id="CodigoPostal">
        </div>
        <div class="col-md-3">
          <label for="Telefono" class="form-label">Teléfono</label>
          <input type="number" class="form-control" value="{{ auth()->user()->Telefono }}" name="Telefono" id="Telefono">
        </div>
        <div class="col-md-4">
        <label for="Direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control" value="{{ auth()->user()->Direccion }}" name="Direccion" id="Direccion">
        </div>
        <div class="col-md-4">
          <label for="Poblacion" class="form-label">Población</label>
          <input type="text" class="form-control" value="{{ auth()->user()->Poblacion }}" name="Poblacion" id="Poblacion">
        </div>
        <div class="col-md-3">
          <label for="Provincia" class="form-label">Provincia</label>
          <select class="form-select" name="Provincia" id="Provincia" aria-describedby="Provincia">
            <option selected disabled value="{{ auth()->user()->Provincia }}">{{ auth()->user()->Provincia }}</option>
            <option value="Barcelona">Barcelona</option>
          </select>
        </div>
        <input type="hidden" name="id" id="id" value="{{ encrypt(auth()->user()->id) }}">
        <div class="col-12">
          @include('partials.messagesLogin')
          <button class="btn btn-primary" type="submit"><span>Guardar</span></button>
        </div>
    </form>
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

  #title-edit-profile{
    margin: 0 120px;
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

  /* Registro */
  .content-edit-profile{
      place-items: center;
      margin-left: 50px;
      display: grid;
      grid-template-columns: 1fr;
      height: 100%;
      margin: 0 120px;
  }

  .content-edit-profile h1{
      color: black;
      font-size: 40;
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

@endauth

@endsection