@extends('layouts.app-master')

@section('admin')

<div class="general-title">
    <p><a href="/cheesecakedecharlie/public/adminPedidos">Cheesecake de Charlie</a></p>
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
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/adminPedidos">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/adminTartas">Tartas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/adminDIY">DIY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/cheesecakedecharlie/public/adminUsuarios">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- Contenido -->
<div class="contentAdministrator">
    <div class="formulario">
        <h2>Editar el usuario: <strong>{!! $usuario->email !!}</strong></h2>
        <br>
        <form class="row g-3" action="{{ route('editUsuario') }}" method="POST">
            @csrf
            <div class="col-md-3">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" name="Nombre" value="{!! $usuario->Nombre !!}" class="form-control" id="Nombre">
              </div>
              <div class="col-md-3">
                <label for="Apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" value="{!! $usuario->Apellido !!}" name="Apellido" id="Apellido">
              </div>
              <div class="col-md-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Sólo escribir para cambiar la contraseña" aria-describedby="password">
              </div>
              <div class="col-md-3">
                <label for="Telefono" class="form-label">Teléfono</label>
                <input type="number" class="form-control" value="{!! $usuario->Telefono !!}" name="Telefono" id="Telefono">
              </div>
              <div class="col-md-4">
              <label for="Direccion" class="form-label">Dirección</label>
              <input type="text" class="form-control" value="{!! $usuario->Direccion !!}" name="Direccion" id="Direccion">
              </div>
              <div class="col-md-2">
                <label for="CodigoPostal" class="form-label">Código Postal</label>
                <input type="number" class="form-control" value="{!! $usuario->CodigoPostal !!}" name="CodigoPostal" id="CodigoPostal">
              </div>
              <div class="col-md-4">
                <label for="Poblacion" class="form-label">Población</label>
                <input type="text" class="form-control" value="{!! $usuario->Poblacion !!}" name="Poblacion" id="Poblacion">
              </div>
              <div class="col-md-3">
                <label for="Provincia" class="form-label">Provincia</label>
                <select class="form-select" name="Provincia" id="Provincia" aria-describedby="Provincia">
                  <option selected disabled value="{!! $usuario->Provincia !!}">{!! $usuario->Provincia !!}</option>
                  <option value="Barcelona">Barcelona</option>
                </select>
              </div>
              <input type="hidden" name="IndBaja" id="IndBaja" value="0">
              <input type="hidden" name="Rol" id="Rol" value="0">
              <input type="hidden" name="email" id="email" value="{!! $usuario->email !!}">
              <input type="hidden" name="id" id="id" value="{!! $usuario->id !!}">
              <div class="col-12">
                @include('partials.messagesLogin')
                <button class="btn btn-primary" type="submit"><span>Guardar</span></button>
                <a href="/cheesecakedecharlie/public/adminUsuarios" class="btn btn-primary">Atrás</a>
              </div>
        </form>
    </div>
</div>

@include('admins.style')

@endsection