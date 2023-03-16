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
                        <a class="nav-link active" href="/cheesecakedecharlie/public/adminPedidos">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/adminTartas">Tartas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/cheesecakedecharlie/public/adminDIY">DIY</a>
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
    @include('partials.messagesLogin')
    <br>
    <div class="list">
        <div>
            <a class="btn btn-green" href="{{ route('descargarExcel') }}">Pedidos por hacer</a>
        </div>
        <br>
        <table class="table table-striped table-responsive-sm" id="PedidosList">
            <thead>
                <tr>
                    <th>Id Pedido</th>
                    <th>Estado</th>
                    <th>Fecha Entrega</th>
                    <th>Correo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    @if ($pedido->Estado != 1)
                        <tr>
                            <td>{!! $pedido->IdPedido !!}</td>
                            <td>{!! $pedido->DescripcionEstado !!}</td>
                            <td>{!! $pedido->FechaRecibirPedido !!}</td>
                            <td>{!! $pedido->Correo !!}</td>
                            <td style="text-align:center;">
                                <a href="adminLineasPedido/{!! $pedido->IdPedido !!}" class="btn btn-green"><span class="fa fa-eye" title="Ver pedido"></span></a>
                                <!--<a href="deletePedido/{!! $pedido->IdPedido !!}" class="btn btn-green"><span class="fa fa-times" title="Eliminar Pedido"></span></a>-->
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
        $('#PedidosList').dataTable();
    });
</script>

@include('admins.style')
</div>

@include('admins.style')

@endsection