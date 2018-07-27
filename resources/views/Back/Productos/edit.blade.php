@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Editar producto: {{$producto->Descripcion}}</h3>
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
{!!Form::Model($producto,['enctype'=>'multipart/form-data','method'=>'PATCH','route'=>['Productos.update',$producto->idProductos],'file'=>'true'])!!}
{{Form::token()}}

 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">edit</i>
       <label for="Descripcion">Desccripcion</label>
       <input type="text" name="Descripcion" required value="{{$producto->Descripcion}}" class="form-control">
      </div>
       <div class="input-field col s6">
        <i class="material-icons prefix">attach_money</i>
       <label for="Precio">Precio</label>
       <input type="text" name="Precio" required value="{{$producto->Precio}}" class="form-control">
      </div>
       <div class="input-field col s6">
        <i class="material-icons prefix">storage</i>
       <label for="Stock">Stock</label>
       <input type="text" name="Stock" required value="{{$producto->Stock}}" class="form-control">
      </div>

       <div class="input-field col s6">
        <i class="material-icons prefix">done</i>
          @if($producto->Estado == 1)
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
   <div class="input-field col s6">
    <i class="material-icons prefix">apps</i>
    <select name="idCategorias">
      <option value="" disabled selected>Elige la categoria</option>
      @foreach ($categorias as $cata)
      @if($cata->idCategorias==$producto->idCategorias)
      <option value="{{$cata->idCategorias}}"selected>{{$cata->Descripcion}}</option>
     @else
      <option value="{{$cata->idCategorias}}">{{$cata->Descripcion}}</option>
      @endif
      @endforeach
    </select>
    <label>Categoria</label>
  </div>
   <div class="input-field col s12">
    <i class="material-icons prefix">apps</i>
    <select name="idTamaños">
      <option value="" disabled selected>Elige el tamaño</option>
      @foreach ($tamanio as $t)
      @if($t->idTamaños==$producto->idTamaños)
      <option value="{{$t->idTamaños}}"selected>{{$t->Tamaño}}</option>
     @else
      <option value="{{$t->idTamaños}}">{{$t->Tamaño}}</option>
      @endif
      @endforeach
    </select>
    <label>Tamaño</label>
  </div>
    <div class="input-field col s12">
        <i class="material-icons prefix">crop_original</i>
       <label for="Imagen">Imagen</label>
       <input type="text" name="Imagen" required value="{{$producto->Imagen}}" class="form-control">
        @if(($producto->Imagen)!="")
            <img src="{{asset('Imagenes/Productos/'.$producto->Imagen)}}" height="400px" width="400px" class="left">
        @endif
   </div>
</div>
  <button class="btn blue" type="submit">
	 Guardar
    <i class="material-icons right">send</i>
	</button>
     <a href="{{URL::action('ProductosController@index')}}" class="waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
  </div>
  </div>
   </div>
    </div>
    </div>
{!!Form::close()!!}
@endsection