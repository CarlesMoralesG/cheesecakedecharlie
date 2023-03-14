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
    <div class="formulario">
        @foreach ( $DIY as $DIY )
            <h2>Editar la DIY: <strong>{!! $DIY->DescripcionArticulo !!}</strong></h2>
            <br>
            <form class="row g-3" action="{{route('editDIY')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-3">
                    <img src="{{asset($DIY->Imagen)}}" height="160px;" style="width: 295px;">
                </div>
                <div class="col-md-4">
                    <label for="DescripcionArticulo" class="form-label">Título</label>
                    <input type="text" class="form-control" name="DescripcionArticulo" id="DescripcionArticulo" value="{!! $DIY->DescripcionArticulo !!}" required>
                </div>
                <div class="col-md-2">
                    <label for="PrecioArticulo" class="form-label">Precio Artículo</label>
                    <input type="number" class="form-control" name="PrecioArticulo" id="PrecioArticulo" value="{!! $DIY->PrecioArticulo !!}" required>
                </div>
                <div class="col-md-1">
                    <label for="Esfavorito" class="form-label">Es favorita</label>
                    <select class="form-select" name="Esfavorito" id="Esfavorito" aria-describedby="Esfavorito">
                        <option selected value="{!! $DIY->Esfavorito !!}">
                            @if ($DIY->Esfavorito != "0")
                                Sí </option>
                            @else
                                No </option>
                            @endif
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="Imagen" class="form-label">Imagen de la tarta</label>
                    <input type="file" class="form-control" name="Imagen" id="Imagen" value="{!! $DIY->Imagen !!}">
                </div>
                <div class="col-md-6">
                    <label for="Tamanyo" class="form-label">Elige Tamaño</label>
                    <select class="form-select" name="Tamanyo" id="Tamanyo" aria-describedby="Tamanyo">
                        <option selected value="{!! $DIY->Tamanyo !!}">{!! $DIY->Tamanyo !!}</option>
                        <option value="Mediana">Mediana</option>
                    </select>
                </div>
                <div class="col-md-16">
                    <label for="Resumen" class="form-label">Resumen</label>
                    <textarea class="form-control" name="Resumen" id="Resumen" required>{!! $DIY->Resumen !!}</textarea>
                </div>
                <input type="hidden" name="IndBaja" id="IndBaja" value="{!! $DIY->IndBaja !!}">
                <input type="hidden" name="IdCategoria" id="IdCategoria" value="2">
                <input type="hidden" name="IdArticulos" id="IdArticulos" value="{!! $DIY->IdArticulos !!}">
                <div class="col-12">
                    @include('partials.messagesLogin')
                    <button class="btn btn-primary" type="submit"><span>Editar DIY</span></button>
                    <a href="/cheesecakedecharlie/public/adminDIY" class="btn btn-primary">Cancelar</a>
                </div>
            </form>
        @endforeach
    </div>
</div>

@include('admins.style')

@endsection