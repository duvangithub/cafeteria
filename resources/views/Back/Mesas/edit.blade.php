@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Editar Mesa: {{$mesa->Descripcion}}</h3>
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
{!!Form::Model($mesa,['enctype'=>'multipart/form-data','method'=>'PATCH','route'=>['Mesas.update',$mesa->idMesas],'file'=>'true'])!!}
{{Form::token()}}

 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">edit</i>
       <label for="Titulo">Desccripcion</label>
       <input type="text" name="Descripcion" required value="{{$mesa->Descripcion}}" class="form-control">
       </div>
     </div>
  <button class="btn blue" type="submit">
	 Guardar
    <i class="material-icons right">send</i>
	</button>
     <a href="{{URL::action('BMesasController@index')}}" class="waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
  </div>
  </div>
   </div>
    </div>
    </div>
{!!Form::close()!!}
@endsection