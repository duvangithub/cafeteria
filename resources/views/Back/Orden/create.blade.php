@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Nuevas ordenes</h3>
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
{!!Form::open(array('url'=>'Back/Orden','method'=>'POST','autocomplete'=>'off','file'=>'true', 'enctype'=>'multipart/form-data'))!!}
{{Form::token()}}

 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">edit</i>
        <input id="Nombre" name="Nombre" type="text" class="validate" required value="{{old('Nombre')}}">
        <label for="Nombre">Nombre</label>
      </div>
     </div>
     <div class="row">
        <div class="input-field col s12">
           <i class="material-icons prefix">apps</i>
    <select name="idMesas">
       <option value="" disabled selected>Elige tu mesa</option>
      @foreach($mesas as $m)
      <option value="{{$m->idMesas}}">{{$m->Descripcion}}</option>
      @endforeach
    </select>
    <label>Mesas</label>
  </div>
     </div>
     <button class="btn blue" type="submit">
	 Guardar
    <i class="material-icons right">send</i>
	</button>
     <a class="waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
  </div>
  </div>
   </div>
    </div>
    </div>
{!!Form::close()!!}
@endsection