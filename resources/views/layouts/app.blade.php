<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
    

    <title>Cafeteria</title>

    <script type="text/javascript">
        $(".button-collapse").sideNav();
        
    </script>

   
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset('Back/Mate/css/materialize.min.css')}}"  media="screen,projection"/>
     <link type="text/css" rel="stylesheet" href="{{asset('Back/Mate/css/login.css')}}"/>
    <script type="text/javascript" src="{{asset('Back/Mate/js/jquery.js')}}"></script>
         
</head>
<body class="#efebe9 brown lighten-5">
         <nav class="nav-wrapper brown darken-2">
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo center">Cafeteria</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        @guest
        
        @else
         
        <li><i class="material-icons left">account_circle</i><span>{{ Auth::user()->name }}</span></li>
@if( Auth::user()->tipo==1)
  <li><a href="#!name"><i class="material-icons left">contacts</i><span class="white-text name">Administrador</span></a></li>
@elseif(Auth::user()->tipo==2)
  <li><a href="#!name"><i class="material-icons left">contacts</i><span class="white-text name">Mesero</span></a></li>
@elseif(Auth::user()->tipo==3)
  <li><a href="#!name"><i class="material-icons left">contacts</i><span class="white-text name">Cajera</span></a></li>
 @elseif(Auth::user()->tipo==4)
  <li><a href="#!name"><i class="material-icons left">contacts</i><span class="white-text name">Cocinero</span></a></li>
 @endif
  @if( Auth::user()->tipo==1 )
         <li><a class="waves-effect waves-teal" href="/Back/Graficas">Inicio<i class="material-icons left">
         home</i></a></li>
          @elseif(Auth::user()->tipo==2)
           <li><a class="waves-effect waves-teal" href="/Back/Mesero">Ordenes<i class="material-icons left">
         home</i></a></li>
          @elseif(Auth::user()->tipo==3)
            <li><a class="waves-effect waves-teal" href="/Back/PuntoVenta">Punto de venta<i class="material-icons left">
         home</i></a></li>
         @elseif(Auth::user()->tipo==4)
         <li><a class="waves-effect waves-teal" href="/Back/Comanda">Lista de comandas<i class="material-icons left">
         home</i></a></li>
          @endif
        <li><a href="{{ route('logout') }}"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
            <i class="material-icons left">exit_to_app</i>Cerrar sesion</a></li>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
             </form>
           @endguest
      </ul>
      <ul class="side-nav" id="mobile-demo">
         @guest
        
        @else
          <li>
          <div class="user-view">
            <div class="background">
              <img src="{{asset('Back/img/fondo3.jpg')}}" class="responsive-img">
            </div>
            <a href="#!user"><img class="circle" src="{{asset('Imagenes/Usuarios/'.Auth::user()->imagen)}}" class="responsive-img"></a>
            @if( Auth::user()->tipo==1 )
            <a href="#!name"><span class="white-text name">Administrador</span></a>
            @elseif(Auth::user()->tipo==2)
            <a href="#!name"><span class="white-text name">Mesero</span></a>
            @elseif(Auth::user()->tipo==3)
            <a href="#!name"><span class="white-text name">Cajera</span></a>
             @elseif(Auth::user()->tipo==4)
              <a href="#!name"><span class="white-text name">Cocinero</span></a>
            @endif

            <a href="#!email"><span class="white-text email">{{ Auth::user()->name }}</span></a>
         </div>
        </li>
        <li><a href="{{ route('logout') }}"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">
            <i class="material-icons right">exit_to_app</i>Cerrar sesion</a></li>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
             </form>
        <li><div class="divider"></div></li>

        @if( Auth::user()->tipo==1 )
         <li><a class="waves-effect waves-teal" href="/Back/Graficas">Inicio<i class="material-icons right">
         chevron_right</i></a></li>
          @elseif(Auth::user()->tipo==2)
           <li><a class="waves-effect waves-teal" href="/Back/Mesero">Ordenes<i class="material-icons right">
         chevron_right</i></a></li>
          @elseif(Auth::user()->tipo==3)
            <li><a class="waves-effect waves-teal" href="/Back/PuntoVenta">Punto de venta<i class="material-icons right">
         chevron_right</i></a></li>
         @elseif(Auth::user()->tipo==4)
         <li><a class="waves-effect waves-teal" href="/Back/Comanda">Lista de comandas <i class="material-icons right">
          @endif

       </ul>
           @endguest
        
      </ul>
    </div>
  </nav>
  @guest
  <main class="py-4">
            @yield('content')
        </main>
        
        @else
        
        @endguest

        
</body>
<script type="text/javascript" src="{{asset('Back/Mate/js/menu.js')}}"></script>
<script type="text/javascript" src="{{asset('Back/Mate/js/materialize.min.js')}}"></script>
</html>
