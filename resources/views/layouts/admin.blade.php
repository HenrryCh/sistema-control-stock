<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    {{-- Titulo original 
    <title>{{ config('app.name') }}</title>
    --}}
    {{-- Titulo referenciado --}}
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {{--   Boostrap Css para Tablas
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    --}}
    {{-- Link de Boostrap 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    --}}
    <link rel="icon" type="image/png" href="/img/logo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/appAdminLte3.css') }}" rel="stylesheet">

    <!-- datatables -->
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.dataTables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/colReorder.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/searchBuilder.dataTables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.js')}}"></script>
    
    @yield('third_party_stylesheets')

    @stack('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    
<div class="wrapper">
    <!-- Main Header -->
        <nav class="main-header navbar navbar-expand navbar-gray navbar-light" style="background-color: #fff; height: 67px">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" style="color:orange;" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >
                    <img id="campana" src="{{ asset('/img/campana0.png') }}" style="height:30px;" class="brand-image-xl.single">
                </a>
                   
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="border-radius: 8px; left: inherit; right:0px; margin: 12px">   
                    <span class="dropdown-item dropdown-header">Notificaciones</span>
                    <div class="dropdown-divider"></div>
                    <div class="list-group" id="mensajes" style="font-size:80%; margin: 10px; overflow-y: auto; max-height: 200px;"></div>
                    <div class="dropdown-divider"></div>     
                </div>
            </li>
            
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                    @if (Auth::check() && Auth::user()->profile_photo_path)
                        <img src="{{ asset('img/profile/'.auth()->user()->profile_photo_path) }}" class="user-image img-circle elevation-2" alt="User Image">
                    @else
                        @if (Auth::check() && Auth::user()->name)
                            <div class="user-initials img-circle elevation-2" style="background-color: #adb5bd ; color: white; width: 40px; height: 40px; line-height: 40px; text-align: center; font-size: 18px;">
                                {{ strtoupper(substr(Auth::user()->nombres, 0, 1).substr(Auth::user()->apellidos, 0, 1)) }}
                            </div>
                        @else
                            <img src="{{ asset('img/usuario.png') }}" class="user-image img-circle elevation-2" alt="User Image">
                        @endif
                    @endif

                    <span style="color:black; margin-left: 5px;" class="d-none d-md-inline">{{ Auth::user()->name }} </span>
                </a>
                
                <ul class="dropdown-menu dropdown-menu- dropdown-menu-right " style="border-radius: 8px; width: 50px; margin: 12px">
                    <!-- User image -->
                    <!--
                    <li class="user-header bg-primary">
                        <img src="https://assets.infyom.com/logo/blue_logo_150x150.png"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    -->
                    <!-- Menu Footer-->
                    <div class="nav-item dropdown user-menu">
                        <li class="user-footer">
                            <a href="{{ route('profile.show') }}" class="dropdown-item" role="menuitem" tabindex="-1" >
                                <span>{{ __('Profile') }}</span>
                                <span class="float-right"><i class="fa fa-user"></i></span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item" role="menuitem" tabindex="-1"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span>{{ __('Sign out') }}</span>
                                <span class="float-right"> <i class="fas fa-sign-out-alt"></i></span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </div>
                    <!--
                    <li class="user-footer">
                        <a href="{{ route('profile.show') }}" class="btn btn-default btn-flat">{{ __('Profile') }}</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Sign out') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    -->
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
    @include('layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('contenido')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Versión</b> 1.0
        </div>
        <strong>Copyright &copy; 2023 <a href="https://henrrych.netlify.app/" target="_blank">ChariSoft</a>.</strong>
    </footer>
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/appAdminLte3.js') }}" defer></script>
<script type="text/javascript" src="{{asset('js/jquery-3.6.0.js')}}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}" defer></script>
<script src="{{ asset('js/jszip.min.js') }}" defer></script>
<script src="{{ asset('js/pdfmake.min.js') }}" defer></script>
<script src="{{ asset('js/vfs_fonts.js') }}" defer></script>
<script src="{{ asset('js/buttons.html5.min.js') }}" defer></script>
<script src="{{ asset('js/buttons.print.min.js') }}" defer></script>
<script src="{{ asset('js/dataTables.searchBuilder.min.js') }}" defer></script>
<script src="{{ asset('js/toastr.min.js') }}" defer></script>
<script type="text/javascript" src="{{asset('js/main.js')}}"></script>

{{-- Añadidos al js --}}
<script src="{{ asset('js/dataTables.responsive.min.js') }}" defer></script>

<!-- Ejemplos de tables-->

{{--  

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('js/stock.js') }}" defer></script>
<!-- Boostrap javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
--}}

<script>
    function obtenerProductosStockMinimo() {
      fetch('/getProductosStockMinimo')
        .then(response => response.json())
        .then(data => {
          // Aquí procesamos los datos recibidos
          // console.log('Nombre\tCantidad\tStock');
          var mensajes = [];
          data.forEach(producto => {
             mensajes.push(`Producto: ${producto.nombre} bajo stock mínimo`);
            // console.log(`${producto.nombre}\t${producto.cantidad}\t${producto.stock_minimo}`);
          });
          if(mensajes.length > 0){
              var imagen = document.getElementById("campana");
              imagen.src = "/img/campana.png";
            }
          var mensajesHTML = mensajes.map(mensaje => `<div class="list-group-item" style="word-wrap: break-word;">${mensaje}</div>`).join('');
            document.getElementById('mensajes').innerHTML = mensajesHTML;
        })
        .catch(error => console.error(error));
    }
    obtenerProductosStockMinimo();
</script>
@yield('third_party_scripts')

@stack('page_scripts')

</body>
</html>
