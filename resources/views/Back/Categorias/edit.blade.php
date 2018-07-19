@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Editar categoria: {{$categoria->Descripcion}}</h3>
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
{!!Form::Model($categoria,['enctype'=>'multipart/form-data','method'=>'PATCH','route'=>['Categorias.update',$categoria->idCategorias],'file'=>'true'])!!}
{{Form::token()}}

 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">edit</i>
       <label for="Titulo">Desccripcion</label>
       <input type="text" name="Descripcion" required value="{{$categoria->Descripcion}}" class="form-control">
       </div>

       <div class="input-field col s12">
        <i class="material-icons prefix">done</i>
          @if($categoria->Estado == 1)
    <select name="Estado">
      <option value="" disabled selected>Elige el estado</option>
      <option value="0">Desactivar</option>
      <option value="1" selected>Activar</option>
    </select>
      @else
    <select name="Estado">
      <option value="" disabled selected>Elige el estado</option>
      <option value="0" selected>Desactivar</option>
      <option value="1">Activar</option>
    </select>
    @endif

    <label>Estado</label>
  </div>
    <div class="input-field col s12">
        <i class="material-icons prefix">crop_original</i>
       <label for="Imagen">Imagen</label>
       <input type="text" name="Imagen" required value="{{$categoria->Imagen}}" class="form-control">
        @if(($categoria->Imagen)!="")
            <img src="{{asset('Imagenes/Categorias/'.$categoria->Imagen)}}" height="400px" width="400px" class="left">
        @endif
   </div>
</div>
  <button class="btn blue" type="submit">
	 Guardar
    <i class="material-icons right">send</i>
	</button>
     <a href="{{URL::action('BCategoriasController@index')}}" class="waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
  </div>
  </div>
   </div>
    </div>
    </div>
{!!Form::close()!!}
@endsection