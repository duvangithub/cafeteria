@extends ('layouts.Menu')
@section ('contenido')
@if(Auth::user()->tipo==1)
<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Listado de Usuarios <a href="Usuarios/create" class="waves-effect waves-light btn green"><i class="material-icons right">add</i>Nuevo</a> </h4>
	@include('Back.Usuarios.search')
</div>
</div>
</div>
</div>
     <div class="card darken-1">
     <div class="card-content">
<div class="row">
    <table class="striped responsive-table" >
        <thead>
          <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo electronico</th>
              <th>Tipo</th>
              <th>Foto</th>
              <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 @foreach($usuarios as $us)
          <tr>
            <td>{{$us->id}}</td>
            <td>{{$us->name}}</td>
            <td>{{$us->email}}</td>
            @if($us->tipo==1)
            <td>Administardor</td>
            @elseif($us->tipo==2)
            <td>Mesero</td>
            @elseif($us->tipo==3)
            <td>Cajero</td>
            @elseif($us->tipo==4)
            <td>Cocinero</td>
            @endif
            <td><img src="{{asset('Imagenes/Usuarios/'.$us->imagen)}}" alt="{{$us->name}}" height="100px" width="100px" class="responsive-img"></td>
            <td>
            <a href="{{URL::action('UsuarioController@edit',$us->id)}}" class="waves-effect waves-light btn blue"><i class="material-icons">edit</i>
            </a>
             <a href="#modal-delete-{{$us->id}}" data-toggle="modal" class="waves-effect waves-light btn modal-trigger red"><i class="material-icons">delete</i>
            </a>
            </td>
          </tr>
          	@include('Back.Usuarios.modal')
            @endforeach
        </tbody>
      </table>
  </div>
  </div>
   </div>

    </div>
     {{$usuarios->render()}}
    </div>
    @else
 @include('/Error/error')
@endif

@endsection