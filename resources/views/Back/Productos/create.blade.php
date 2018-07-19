@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Nuevos productos</h3>
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
{!!Form::open(array('url'=>'Back/Productos','method'=>'POST','autocomplete'=>'off','file'=>'true', 'enctype'=>'multipart/form-data'))!!}
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
     <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">attach_money</i>
        <input id="Precio" name="Precio" type="number" class="validate" required value="{{old('Precio')}}" requiered>
        <label for="Precio">Precio</label>
      </div>
       <div class="input-field col s6">
        <i class="material-icons prefix">storage</i>
        <input id="Stock" name="Stock" type="number" class="validate" required value="{{old('Stock')}}" required>
        <label for="Stock">Stock</label>
      </div>
     </div>
     <div class="row">
        <div class="input-field col s12">
           <i class="material-icons prefix">apps</i>
    <select name="idCategorias" required>
       <option value="" disabled selected>Elige tu categoria</option>
      @foreach($categorias as $cate)
      <option value="{{$cate->idCategorias}}">{{$cate->Descripcion}}</option>
      @endforeach
    </select>
    <label>Categorias</label>
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
     <a class="waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
  </div>
  </div>
   </div>
    </div>
    </div>
{!!Form::close()!!}
@endsection