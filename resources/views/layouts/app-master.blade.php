<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CheesecakeDeCharlie</title>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    
    <div class="main-container">
        @if(Auth::check()) 
            <!-- Si esta loggeado y es admin -->
            @if ( auth()->user()->Rol == 1)
                @yield('admin')
            <!-- Si esta loggeado y no es admin -->
            @elseif (auth()->user()->Rol == 0)
                @yield('content')
            @endif
        <!-- Si no esta loggeado -->
        @else
            @yield('content')
        @endif
    </div>
    
    @if(Auth::check())
        @if (auth()->user()->Rol == 0)
            <div class="content-footer">
                <!-- Contacto -->
                <div class="footer-contact">
                    <h1 class="footer-title">CONTACTO</h1>
                    <p><strong>Pedidos</strong></p>
                    <p>info@CheesecakeDeCharlie.com</p>
                    <p><strong>Instagram</strong></p>
                    <p>@CheesecakeDeCharlie</p>
                    <p><strong>Teléfono</strong></p>
                    <p>619566996</p>
                </div>
        
                <!-- Información -->
                <div class="footer-information">
                    <h1 class="footer-title">INFORMACIÓN</h1>
                    <p><strong>Horario de entrega a domicilio</strong></p>
                    <p>Lunes a Sábado: 10:30h a 14:30h</p>
                    <p><strong>Recogida en tienda</strong></p>
                    <p>Lunes a Sábado: 10:30h a 18:30h</p>
                    <p><strong>Dirección</strong></p>
                    <p>Paseo Francesc Macià, 91</p>
                </div>
                <!-- Mapa -->
                <div id="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2958.3497285852345!2d2.0828054811544012!3d41.47677331284153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a496c3b5b59173%3A0x1f1ed8b3d3914ccf!2sPasseig%20de%20Francesc%20Maci%C3%A0%2C%20Sant%20Cugat%20del%20Vall%C3%A8s%2C%20Barcelona!5e0!3m2!1ses!2ses!4v1660946037378!5m2!1ses!2ses" width="500" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="terminosLegales">
                <div class="terminosYcondiciones"><a href="terminosYCondiciones">Términos y Condiciones</a></div>
                <div class="proteccionDeDatos"><a href="proteccionDeDatos">Protección de datos</a></div>
                <div class="politicaPrivacidad"><a href="politicaPrivacidad">Política de privacidad</a></div>
            </div>
        @endif
    @elseif (!Auth::check())
        <div class="content-footer">
            <!-- Contacto -->
            <div class="footer-contact">
                <h1 class="footer-title">CONTACTO</h1>
                <p><strong>Pedidos</strong></p>
                <p>info@CheesecakeDeCharlie.com</p>
                <p><strong>Instagram</strong></p>
                <p>@CheesecakeDeCharlie</p>
                <p><strong>Teléfono</strong></p>
                <p>619566996</p>
            </div>

            <!-- Información -->
            <div class="footer-information">
                <h1 class="footer-title">INFORMACIÓN</h1>
                <p><strong>Horario de entrega a domicilio</strong></p>
                <p>Lunes a Sábado: 10:30h a 18:30h</p>
                <p><strong>Recogida en tienda</strong></p>
                <p>Lunes a Sábado: 10:30h a 18:30h</p>
                <p><strong>Dirección</strong></p>
                <p>Paseo Francesc Macià, 91</p>
            </div>
            <!-- Mapa -->
            <div id="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2958.3497285852345!2d2.0828054811544012!3d41.47677331284153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a496c3b5b59173%3A0x1f1ed8b3d3914ccf!2sPasseig%20de%20Francesc%20Maci%C3%A0%2C%20Sant%20Cugat%20del%20Vall%C3%A8s%2C%20Barcelona!5e0!3m2!1ses!2ses!4v1660946037378!5m2!1ses!2ses" width="500" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="terminosLegales">
            <div class="terminosYcondiciones"><a href="terminosYCondiciones">Términos y Condiciones</a></div>
            <div class="proteccionDeDatos"><a href="proteccionDeDatos">Protección de datos</a></div>
            <div class="politicaPrivacidad"><a href="politicaPrivacidad">Política de privacidad</a></div>
        </div>
    @endif
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

<style>

    .main-container{
        margin: 0 10px;
    }

    .content-footer{
        height: auto;
        margin: 20px 10px;
        background-color: #F8F9FA; 
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }

    .footer-title{
        font-size: 20px;
    }

    .footer-contact{
        margin-top: 35px;
        font-size: 15px;
        margin-left: 25%;
    }

    .footer-information{
        margin-top: 35px;
        font-size: 15px;
        margin-left: 20px;
    }

    #map{
        margin-top: 35px;
        margin-right: 20px;
    }

    .terminosLegales{
        width: 100%;
        height: 5%;
        background-color: burlywood;
        margin-top:-12px;
        text-align:center;
    }

    .terminosYcondiciones{
        float: left;
        margin-left: 2%;
    }

    .terminosYcondiciones > a{
        text-decoration: none;
        color: black;
    }

    .proteccionDeDatos{
        display:inline-block;
        text-decoration: none;
        color: black;
    }

    .proteccionDeDatos > a{
        text-decoration: none;
        color: black;
    }

    .politicaPrivacidad{
        float: right;
        margin-right: 2%;
        text-decoration: none;
        color: black;
    }

    .politicaPrivacidad > a{
        text-decoration: none;
        color: black;
    }

    @media screen and (max-width: 1000px) {
        .content-footer{
            height: auto;
            margin: 20px 20px;
            background-color: #F8F9FA; 
            display: grid;
            grid-template-columns: 1fr;
        }

        .footer-title{
            font-size: 20px;
        }

        .footer-contact{
            margin-top: 35px;
            font-size: 15px;
            margin-left: 0%;
        }

        .footer-information{
            margin-top: 35px;
            font-size: 15px;
            margin-left: 0%;
        }

        #map{
            margin-top: 35px;
            margin-right: 20px;
        }   
    }

</style>