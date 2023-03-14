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
        @php
            $count = 0;
        @endphp
        @foreach($lineasPedido as $lineasPedidos)
            @break($count == 1)
            <h2>Número de Pedido: <strong>{!! $lineasPedidos->IdPedido !!}</strong></h2>
            @php
                $count++
            @endphp
        <br>
        <form action="{{ route('updatePedido') }}" class="row g-2" method="POST" id="formUpdatePedido">
            @csrf
            <div class="col-md-4">
                <label for="EstadoPedido" class="form-label">Estado Pedido</label>
                <select class="form-select" name="Estado" id="EstadoPedido">
                    <option selected disabled value="{{!! $lineasPedidos->IdEstadoPedido !!}}">{!! $lineasPedidos->DescripcionEstado !!}</option>
                        <option value="2">Empezar</option>
                        <option value="3">Preparando</option>
                        <option value="4">Enviado</option>
                        <option value="5">Entregado</option>
                </select>
                <input type="hidden" name="IdPedido" id="IdPedido" value="{!! $lineasPedidos->IdPedido !!}">
                @endforeach
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" id="btnUpdatePedido" type="submit"><span>Actualizar</span></button>
            </div>
        </form>
        <br>
        <table class="table table-striped table-responsive-sm" id="LineasPedidoList">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Tamaño</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lineasPedido as $lineasPedidos)
                    <tr>
                        <td>{!! $lineasPedidos->DescripcionArticulo !!}</td>
                        <td>{!! $lineasPedidos->DescripcionCategoria !!}</td>
                        <td>{!! $lineasPedidos->Cantidad !!}</td>
                        <td>{!! $lineasPedidos->Tamanyo !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <a class="btn btn-primary" onclick="atras()" role="button">Atrás</a>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#LineasPedidoList').dataTable();
    });
    function atras(){
        window.history.back();
    }
</script>

<style>
    #btnUpdatePedido{
        margin-top: 6.5%;
    }
</style>

@include('admins.style')

@endsection