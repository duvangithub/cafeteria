@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Editar orden: {{$orden->idOrden}}</h3>
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
{!!Form::Model($orden,['enctype'=>'multipart/form-data','method'=>'PATCH','route'=>['Orden.update',$orden->idOrden],'file'=>'true'])!!}
{{Form::token()}}

 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">edit</i>
       <label for="Nombre">Nombre</label>
       <input type="text" name="Nombre" required value="{{$orden->Nombre}}" class="form-control">
      </div>
      
   <div class="input-field col s12">
    <i class="material-icons prefix">apps</i>
    <select name="idMesas">
      <option value="" disabled selected>Elige la mesa</option>
      @foreach ($mesas as $m)
      @if($m->idMesas==$orden->idMesas)
      <option value="{{$m->idMesas}}"selected>{{$m->Descripcion}}</option>
     @else
      <option value="{{$m->idMesas}}">{{$m->Descripcion}}</option>
      @endif
      @endforeach
    </select>
    <label>Mesas</label>
  </div>
</div>
  <button class="btn blue" type="submit">
	 Guardar
    <i class="material-icons right">send</i>
	</button>
     <a href="{{URL::action('BOrdenController@index')}}" class="waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
  </div>
  </div>
   </div>
    </div>
    </div>
{!!Form::close()!!}
@endsection