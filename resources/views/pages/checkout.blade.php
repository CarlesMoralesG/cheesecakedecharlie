@extends('layouts.app-master')

@section('content')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://js.stripe.com/v3/"></script>
    <!-- Librerias para el calendario de la fecha de entrega -->
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="datepicker.js"></script>

    <!-- Script PayPal -->
    <script src="https://www.paypal.com/sdk/js?client-id=AWxt0H4LqYPLAU2JQ0VsXvtXcVmlLh2LjrAW5gjWO5RcsDfr1WJfwBusmWonYMnKjnso40TaoImVe6H4&components=buttons&currency=EUR"></script>

    <div class="general-title">
        <p><a href="/cheesecakedecharlie/public/home">Cheesecake de Charlie</a></p>
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
                            <a class="nav-link" href="/cheesecakedecharlie/public/home">
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cheesecakedecharlie/public/nosotros">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cheesecakedecharlie/public/informacion">Información general</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cheesecakedecharlie/public/pedidos">Productos</a>
                        </li>

                        <!-- Si no esta logeado -->
                        @guest
                            <li class="nav-item">
                            <a class="nav-link" href="/cheesecakedecharlie/public/login">Iniciar sesión / Regístrate</a>
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
                                <a class="dropdown-item" href="{{ route('showPedidos', encrypt(auth()->user()->id)) }}">Pedidos</a>
                                <a class="dropdown-item" href="/cheesecakedecharlie/public/logout">Logout</a>
                            </div>
                            </li>
                        @endauth

                        <!-- Icono compra -->
                        @auth
                            <a class="navbar-brand" href="{{ route('showCesta', encrypt(auth()->user()->id)) }}">
                                <i styel="font-family:Arial" class="bi bi-bag"></i>
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
    @auth
    @php
        $totalCestaOculta = $totalCesta;
    @endphp
    <div class="contentCheckout">
        <h2 class="titleCheckout">Datos de envío</h2>
        <hr style="background-color:black; margin-top:-3px;">

        <form class="row g-3" action="{{ route('checkout.success', encrypt(auth()->user()->id))  }}" id="checkoutform" method="POST">
            @csrf
            <div class="col-md-4">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" name="Nombre" class="form-control" value="{{ auth()->user()->Nombre }}" id="Nombre" required>
            </div>
            <div class="col-md-4">
                <label for="Apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" name="Apellido" value="{{ auth()->user()->Apellido }}" id="Apellido" required>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control" name="Correo" id="email" aria-describedby="email" value="{{ auth()->user()->email }}" required>
            </div>
            <div class="col-md-4">
                <label for="Telefono" class="form-label">Teléfono</label>
                <input type="number" class="form-control" name="Telefono" value="{{ auth()->user()->Telefono }}" id="Telefono" required>
            </div>
            <div class="col-md-4">
            <label for="Direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="Direccion" value="{{ auth()->user()->Direccion }}" id="Direccion" required>
            </div>
            <div class="col-md-4">
                <label for="CodigoPostal" class="form-label">Código Postal</label>
                <input type="number" class="form-control" name="CodigoPostal" value="{{ auth()->user()->CodigoPostal }}" id="CodigoPostal" required>
            </div>
            <div class="col-md-4">
              <label for="Poblacion" class="form-label">Población</label>
              <input type="text" class="form-control" name="Poblacion" value="{{ auth()->user()->Poblacion }}" id="Poblacion" required>
          </div>
            <div class="col-md-4">
                <label for="Provincia" class="form-label">Provincia</label>
                <select class="form-select" name="Provincia" id="Provincia" aria-describedby="Provincia" required>
                    <option selected disabled value="{{ auth()->user()->Provincia }}">{{ auth()->user()->Provincia }}</option>
                    <option value="Barcelona">Barcelona</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="datePicker" class="form-label">Fecha de entrega</label>
                <input type="text" class="form-control" autocomplete="off" name="FechaRecibirPedido" id="datePicker" required>
                <input type="hidden" name="FechaVenta" value="{{ date('d-m-Y H:i:s') }}">
                <input type="hidden" name="Estado" value="2">
            </div>
            <br>
            <h2 class="titleCheckout">Datos de pago</h2>
            <hr style="background-color:black; margin-top:-3px;">
            <div class="col-md-8">
                <div id="paypal-button-container"></div>
            </div>
            <div class="col-md-4">
                <div class="card-header titleCesta" style="font-size:30px">
                    Total cesta
                </div>
                <div class="card-body" style="position: relative; display: flex;">
                    <div id="totalCesta">
                        <p class="card-text btn btn-primary" style="width:200px; font-size: 22px;">Total: {!! $totalCesta !!}€</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endauth
    @guest
        <div class="controlInicioSesion">
            <a class="btn btn-primary" href="/cheesecakedecharlie/public/login">Inicia sesión o Regístrate</a>
        </div>
    @endguest
    <script>
        $(function () {
            $("#datePicker").datepicker({
                minDate: 7,
                //dateFormat: 'DD dd, MM yy',
                dateFormat: 'd-m-yy',
                firstDay: 1,
                beforeShowDay: $.datepicker.noWeekends,
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            });    
        });

        function validarFormulario(evento) {
            evento.preventDefault();
            var date = document.getElementById('datePicker').value;
            if(date.length == 0) {
                alert('¡Marca la fecha de entrega!');
                return false;
            }
        }
        
        paypal.Buttons({
            style: {
                layout: 'vertical',
                color:  'gold',
                shape:  'rect',
                label:  'paypal'
            },
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                var date = document.getElementById('datePicker').value;
                if(date.length == 0) {
                    alert('¡Marca la fecha de entrega!');
                }
                else
                {
                    return actions.order.create({
                        purchase_units: [{
                        amount: {
                            value: "<?php echo $totalCestaOculta ?>"
                        }
                    }]
                });
                }
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                var date = document.getElementById('datePicker').value;
                if(date.length == 0) {
                    alert('¡Marca la fecha de entrega!');
                }
                else
                {
                    return actions.order.capture().then(function(details) {
                        // This function shows a transaction success message to your buyer.
                        document.getElementById("checkoutform").submit();
                    });
                }
            },
            onCancel: function (data) {
                var date = document.getElementById('datePicker').value;
                if(date.length == 0) {
                    alert('¡Marca la fecha de entrega!');
                }
                else
                {
                    window.location.href= "/cheesecakedecharlie/public/home";
                }
            },
            onError: function (err) {
                // For example, redirect to a specific error page
                var date = document.getElementById('datePicker').value;
                if(date.length == 0) {
                    alert('¡Marca la fecha de entrega!');
                }
                else
                {
                    window.location.href = "/cheesecakedecharlie/public/home";
                }
            }
        }).render('#paypal-button-container');
    </script>

    <style>
        #totalCesta{
            position: relative;
            display: flex;
            width: 100%;
            justify-content: center;
            margin-left:5%;
        }
        .titleCesta{
            font-family: 'Lucida Console';
            position: relative;
            display: flex;
            justify-content: center;
            width: 100%;
        }
        body{
            margin: 0;
            width: 100%;
            height: 100%;
            font-family: 'Lucida Console';
        }

        .contentCheckout{
            margin-left: 8%;
            margin-right: 8%;
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

        .titleCheckout{
            font-family: 'Lucida Console';
            position: relative;
            display: flex;
            justify-content: center;
            width: 100%;
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

        /* Botones */
        #paypal-button-container{

        }
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

@endsection