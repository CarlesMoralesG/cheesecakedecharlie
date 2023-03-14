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
                        <a class="nav-link active" href="/cheesecakedecharlie/public/adminDIY">DIY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/adminUsuarios">Usuarios</a>
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
    <a class="btn btn-primary" id="create" href="addDIY" role="button">Añadir DIY</a>
    <br>
    @include('partials.messagesLogin')
    <br>
    <div class="list">
        <table class="table table-striped table-responsive-sm" id="TartaList">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Tamanyo</th>
                    <th>Favorito</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($DIY as $DIY)
                    @if ( $DIY->IdCategoria == 2)
                        <tr>
                            <td>{!! $DIY->DescripcionArticulo !!}</td>
                            <td>{!! $DIY->Tamanyo !!}</td>
                            @if ( $DIY->Esfavorito == 1)
                                <td>Sí</td>
                            @elseif ($DIY->Esfavorito == 0)
                                <td>No</td> 
                            @endif
                            <td style="text-align:center;">
                                <a href="editDIY/{!! $DIY->IdArticulos !!}" class="btn btn-green"><span class="fa fa-edit"></span></a>
                                @if($DIY->IndBaja == 0)
                                    <a href="deleteDIY/{!! $DIY->IdArticulos !!}" class="btn btn-green"><span class="fa fa-times" title="Deshabilitar DIY"></span></a>
                                @else
                                    <a href="availableDIY/{!! $DIY->IdArticulos !!}" class="btn btn-green"><span class="fa fa-check" title="Habilitar DIY"></span></a>
                                @endif
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
        $('#TartaList').dataTable();
    });
</script>

@include('admins.style')

@endsection