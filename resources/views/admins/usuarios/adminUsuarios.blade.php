@extends('layouts.app-master')

@section('admin')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

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
    <a class="btn btn-primary" id="create" href="addUsuario" role="button">Añadir Usuario</a>
    <br>
    @include('partials.messagesLogin')
    <br>
    <div class="list">
        <table class="table table-striped table-responsive-sm" id="userList">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    @if ( $usuario->Rol != "1")
                        <tr>
                            <td>{!! $usuario->Nombre !!}</td>
                            <td>{!! $usuario->Apellido !!}</td>
                            <td>{!! $usuario->email !!}</td>
                            <td>{!! $usuario->Telefono !!}</td>
                            <td style="text-align:center;">
                                <a href="editUsuario/{!! $usuario->id !!}" class="btn btn-green"><span class="fa fa-edit"></span></a>
                                <a href="deleteUsuario/{!! $usuario->id !!}" class="btn btn-green"><span class="fa fa-times"></span></a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#userList').dataTable();
    });
</script>

@include('admins.style')

@endsection