@extends ('layouts.Menu')
@section ('contenido')
@if(Auth::user()->tipo==1)
<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Editar usuario: {{$usuario->name}}</h3>
			@if(count($errors)>0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
      @endif
		</div>
	</div>
</div>
{!!Form::Model($usuario,['enctype'=>'multipart/form-data','method'=>'PATCH','route'=>['Usuarios.update',$usuario->id],'file'=>'true'])!!}
{{Form::token()}}

 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
         <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$usuario->name}}" required autofocus>
          @if ($errors->has('name'))
             <span class="invalid-feedback" role="alert">
             <strong>{{ $errors->first('name') }}</strong>
             </span>
          @endif
        <label for="name">{{ __('Nombre de usuario') }}</label>
       </div>
       <!--Correo -->
       <div class="input-field col s6">
        <i class="material-icons prefix">@</i>
        <input id="email" type="email" name="email" value="{{$usuario->email}}" required>
        <label for="email">{{ __('Correo electronico') }}</label>
       </div>
       <!-- Contraseña -->
       <div class="input-field col s6">
        <i class="material-icons prefix">done</i>
       <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
         @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('password') }}</strong>
          </span>
         @endif
        <label for="password">{{ __('Contraseña') }}</label>
       </div>
       <!-- Confirma contraseña -->
       <div class="input-field col s6">
        <i class="material-icons prefix">done_all</i>
         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        <label for="password">{{ __('Confirmar contraseña') }}</label>
       </div>
       <!-- Tipo -->
       <div class="input-field col s6">
        <i class="material-icons prefix">done</i>
          @if($usuario->tipo == 1)
    <select name="tipo">
      <option value="" disabled selected>Elige el tipo de usario</option>
      <option value="1" selected>Administrador</option>
      <option value="2">Mesero</option>
      <option value="3">Cajero</option>
      <option value="4">Cocinero</option>
    </select>
      @elseif($usuario->tipo == 2)
    <select name="tipo">
      <option value="" disabled selected>Elige el estado</option>
      <option value="1">Administrador</option>
      <option value="2" selected>Mesero</option>
      <option value="3">Cajero</option>
      <option value="4">Cocinero</option>
    </select>
     @elseif($usuario->tipo == 3)
      <select name="tipo">
      <option value="" disabled selected>Elige el estado</option>
      <option value="1">Administrador</option>
      <option value="2">Mesero</option>
      <option value="3" selected>Cajero</option>
      <option value="4">Cocinero</option>
    </select>
     @elseif($usuario->tipo == 4)
      <select name="tipo">
      <option value="" disabled selected>Elige el estado</option>
      <option value="1">Administrador</option>
      <option value="2">Mesero</option>
      <option value="3">Cajero</option>
      <option value="4" selected>Cocinero</option>
    </select>
    @endif
    <label>Tipo de usuario</label>
  </div>
  <!--Foto-->
   <div class="input-field col s6">
        <i class="material-icons prefix">crop_original</i>
       <label for="imagen">Foto</label>
       <input type="text" name="imagen" required value="{{$usuario->imagen}}" class="form-control">
        @if(($usuario->imagen)!="")
            <img src="{{asset('Imagenes/Usuarios/'.$usuario->imagen)}}" height="400px" width="400px" class="left">
        @endif
   </div>
     </div>
  <button class="btn blue" type="submit">
	 Guardar
    <i class="material-icons right">send</i>
	</button>
     <a href="{{URL::action('UsuarioController@index')}}" class="waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
  </div>
  </div>
   </div>
    </div>
    </div>
{!!Form::close()!!}
@else
 @include('/Error/error')
@endif
@endsection