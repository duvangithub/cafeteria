<nav>
    <div class="nav-wrapper brown darken-2">
      <a href="#!" class="brand-logo center">Cafetería</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse left">
        <i class="material-icons">menu</i>
      </a>
      <ul class="side-nav fixed" id="mobile-demo">
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
        <li><a class="subheader">Menu</a></li>
        <li><a class="waves-effect waves-teal" href="/Back/Mesero">Ordenes<i class="material-icons left">receipt</i></a></li>
      </ul>
    </div>
  </nav>

  @yield('contenido')
