<!DOCTYPE html>
  <html>
    <head >   
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="{{asset('Back/Mate/css/materialize.min.css')}}"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="{{asset('Back/Mate/css/menu.css')}}"/>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
      <script type="text/javascript" src="{{asset('Back/Mate/js/jquery.js')}}"></script>
         <script type="text/javascript" src="{{asset('Back/Mate/js/create.js')}}"></script>

         
      <!--Let browser know website is optimized for mobile-->
     
    </head>

<body class="#efebe9 brown lighten-5">
  @if(Auth::user()->tipo==1)

  @include('/layouts/administrador')

  @elseif(Auth::user()->tipo==2)
  @include('/layouts/mesero')

  @elseif(Auth::user()->tipo==3)
  @include('/layouts/cajero')

  @elseif(Auth::user()->tipo==4)
  @include('/layouts/cocinero')

  @endif
 
@stack('scripts')
@stack('actualizar')
@stack('grafica')
<script type="text/javascript" src="{{asset('Back/Mate/js/menu.js')}}"></script>
<script type="text/javascript" src="{{asset('Back/Mate/js/materialize.min.js')}}"></script>
</body>
