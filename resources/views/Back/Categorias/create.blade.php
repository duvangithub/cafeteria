@extends ('layouts.Menu')
@section ('contenido')
@if(Auth::user()->tipo==1)
<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Nuevas categorias</h3>
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
{!!Form::open(array('url'=>'Back/Categorias','method'=>'POST','autocomplete'=>'off','file'=>'true', 'enctype'=>'multipart/form-data'))!!}
{{Form::token()}}

 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">edit</i>
        <input id="Descripcion" name="Descripcion" type="text" class="validate" required value="{{old('Descripcion')}}">
        <label for="Descripcion">Descripcion</label>
      </div>
     </div>
      <div class="file-field input-field s12">
      <div class="btn">
        <span>Imagen</span>
        
        <input type="file" name="Imagen" required>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" name="Imagen">
      </div>
    </div>
     <button class="btn blue" type="submit">
	 Guardar
    <i class="material-icons right">send</i>
	</button>
     <a class="waves-effect waves-light btn red" href="/Back/Categorias"><i class="material-icons right">clear</i>Cancelar</a>
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