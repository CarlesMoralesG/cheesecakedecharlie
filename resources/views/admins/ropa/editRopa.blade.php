@extends('layouts.app-master')

@section('admin')

<div class="general-title">
    <p><a href="adminPedidos">Cheesecake de Charlie</a></p>
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
                        <a class="nav-link" href="adminPedidos">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminTartas">Tartas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminDIY">DIY</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="adminRopa">Ropa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminUsuarios">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- Contenido -->
<div class="contentAdministrator">
    <div class="formulario">
        @foreach ( $ropa as $ropa )
            <h2>Editar la DIY: <strong>{!! $ropa->DescripcionArticulo !!}</strong></h2>
            <br>
            <form class="row g-3" action="{{route('editRopa')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-3">
                    <img src="{{asset($ropa->Imagen)}}" style="width: 200px;">
                </div>
                <div class="col-md-4">
                    <label for="DescripcionArticulo" class="form-label">Descripción</label>
                    <input type="text" class="form-control" name="DescripcionArticulo" id="DescripcionArticulo" value="{!! $ropa->DescripcionArticulo !!}" required>
                </div>
                <div class="col-md-2">
                    <label for="PrecioArticulo" class="form-label">Precio Artículo</label>
                    <input type="number" class="form-control" name="PrecioArticulo" id="PrecioArticulo" value="{!! $ropa->PrecioArticulo !!}" required>
                </div>
                <div class="col-md-2">
                    <label for="StockArticulo" class="form-label">Stock</label>
                    <input type="number" class="form-control" name="StockArticulo" id="StockArticulo" value="{!! $ropa->StockArticulo !!}" required>
                </div>
                <div class="col-md-1">
                    <label for="Esfavorito" class="form-label">Es favorita</label>
                    <select class="form-select" name="Esfavorito" id="Esfavorito" aria-describedby="Esfavorito">
                        <option selected value="{!! $ropa->Esfavorito !!}">
                            @if ($ropa->Esfavorito != "0")
                                Sí </option>
                            @else
                                No </option>
                            @endif
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="Imagen" class="form-label">Imagen del artículo</label>
                    <input type="file" class="form-control" name="Imagen" id="Imagen" value="{!! $ropa->Imagen !!}">
                </div>
                <div class="col-md-6">
                    <label for="Talla" class="form-label">Elige la talla</label>
                    <select class="form-select" name="Talla" id="Talla" aria-describedby="Talla">
                        <option selected value="{!! $ropa->Talla !!}">{!! $ropa->Talla !!}</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
                <div class="col-md-16">
                    <label for="Resumen" class="form-label">Resumen</label>
                    <textarea class="form-control" name="Resumen" id="Resumen" required>{!! $ropa->Resumen !!}</textarea>
                </div>
                <input type="hidden" name="IndBaja" id="IndBaja" value="{!! $ropa->IndBaja !!}">
                <input type="hidden" name="IdCategoria" id="IdCategoria" value="3">
                <input type="hidden" name="IdArticulos" id="IdArticulos" value="{!! $ropa->IdArticulos !!}">
                <div class="col-12">
                    @include('partials.messagesLogin')
                    <button class="btn btn-primary" type="submit"><span>Editar Artículo</span></button>
                    <a href="/cheesecakedecharlie/public/adminDIY" class="btn btn-primary">Cancelar</a>
                </div>
            </form>
        @endforeach
    </div>
</div>

@include('admins.style')

@endsection