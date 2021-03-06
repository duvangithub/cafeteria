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
         <li><a class="waves-effect waves-teal" href="/Back/Graficas">Graficas<i class="material-icons left">show_chart</i></a></li>
        <li><a class="waves-effect waves-teal" href="/Back/Comanda">Lista de comandas<i class="material-icons left">confirmation_number</i></a></li>
        <li><a class="waves-effect waves-teal" href="/Back/Compra">Punto de venta<i class="material-icons left">local_dining</i></a></li>
        <li><a class="waves-effect waves-teal" href="/Back/Orden">Ordenes<i class="material-icons left">receipt</i></a></li>
        <li><a class="waves-effect waves-teal" href="/Back/Mesas">Catalogo de mesas <i class="material-icons left">view_module</i></a></li>
        <li><a class="waves-effect waves-teal" href="/Back/Categorias">Catalogo de categorias<i class="material-icons left">list</i>
          <li><a class="waves-effect waves-teal" href="/Back/Tamaños">Tamaños<i class="material-icons left">view_quilt</i></a></li>
         <li><a class="waves-effect waves-teal" href="/Back/Productos">Catalogo de productos<i class="material-icons left">local_cafe</i></a></li>
          <li><a class="waves-effect waves-teal" href="/Back/Venta">Ventas realizadas<i class="material-icons left">attach_money</i></a></li>
        <li><a class="waves-effect waves-teal" href="/Back/Usuarios">Lista de usuarios<i class="material-icons left">supervisor_account</i></a></li>
        

      </ul>
    </div>
  </nav>

  @yield('contenido')
