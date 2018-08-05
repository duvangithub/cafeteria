@extends ('layouts.Menu')
@section ('contenido')
@if(Auth::user()->tipo==1)
<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Nuevos usuarios</h3>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>
</div>
{!!Form::open(array('url'=>'Back/Usuarios','method'=>'POST','autocomplete'=>'off','file'=>'true', 'enctype'=>'multipart/form-data'))!!}
{{Form::token()}}

 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <!-- Nombre -->
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
         <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
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
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
         @if ($errors->has('email'))
           <span class="invalid-feedback" role="alert">
           <strong>{{ $errors->first('email') }}</strong>
           </span>
          @endif
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
       <!--Tipo-->
       <div class="input-field col s12">
          <select name="tipo">
           <option value="" disabled selected>Elije el tipo de usuario</option>
           <option value="1">Administrador</option>
           <option value="2">Mesero</option>
           <option value="3">Cajero</option>
           <option value="4">Cocinero</option>
          </select>
        <label>Tipo de usuario</label>
       </div>
     </div>
       <!--Foto-->
       <div class="row">
        <div class="file-field input-field s12">
      <div class="btn">
        <span>Foto</span>
      <input type="file" name="imagen" required>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" name="Imagen">
      </div>
      </div>
    </div>
     <!-- Botones -->
     <button type="submit" class="btn blue">
      {{ __('Registrar') }}
      <i class="material-icons right">send</i>
     </button>
     <a class="waves-effect waves-light btn red" href="/Back/Usuarios"><i class="material-icons right">clear</i>Cancelar</a>
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