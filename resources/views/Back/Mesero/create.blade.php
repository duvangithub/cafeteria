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
			<div>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>
</div>
{!!Form::open(array('url'=>'Back/Mesero','method'=>'POST','autocomplete'=>'off','file'=>'true', 'enctype'=>'multipart/form-data'))!!}
{{Form::token()}}

 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
     <div class="row">
    <div class="input-field col l6 m6 s12">
       <i class="material-icons prefix">receipt</i>
    <select name="Orden">
      @if($folio==null)
      <option value="0" selected>0</option>
      @else
      <option value="{{$folio}}" selected>{{$folio}}</option>
      @endif
    </select>
    <label>Folio</label>
  </div>
      <div class="input-field col l6 m6 s12">
        <i class="material-icons prefix">edit</i>
        <input id="Nombre" name="Nombre" type="text" class="validate" required value="{{old('Nombre')}}">
        <label for="Nombre">Nombre</label>
      </div>
     </div>
     <div class="row">
        <div class="input-field col s12">
           <i class="material-icons prefix">apps</i>
    <select name="idMesas" required>
       <option value="" disabled selected required>Elige tu mesa</option>
      @foreach($mesas as $m)
      <option value="{{$m->idMesas}}" required>{{$m->Descripcion}}</option>
      @endforeach
    </select>
    <label>Mesas</label>
  </div>
     </div>
  </div>
   </div>
    </div>
    <!-- Detalles -->
   <div class="card darken-1">
  <div class="card-content">
   <div class="row">
     <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">local_dining</i>
    <select class="icons" name="" id="select-cate" required>
       <option value="" disabled selected>Elige la categoria</option>
      @foreach($categorias as $cata)
      <option value="{{$cata->idCategorias}}" data-icon="{{asset('Imagenes/Categorias/'.$cata->Imagen)}}">{{$cata->Descripcion}}</option>
      @endforeach
    </select>
    <label>Categorias</label>
        </div>
    </div>
    
    <div class="row">
      <div class="col l6 m6 s12">
    <p class="pro" id="pro">
    </p>
  </div>
    </div>
     <div class="row">
       <div class="input-field proID">
      </div>
       <div class="input-field proStock">
      </div>
      <div class="input-field col l4 m4 s12 proNum">
      </div>
       <div class="input-field col l4 m4 s12 proNombre">
      </div>
       <div class="input-field col l4 m4 s12 precio">
      </div>
    </div>
     <div class="row">
       <div class="input-field col l4 m4 s12 cantidad">
        <i class="material-icons prefix">add_circle</i>
        <input id="Cantidad" name="pCantidad" type="number" class="validate pCantidad" onblur="multiplica(this.form)">
        <label for="Cantidad">Cantidad</label>
      </div>
      <div class="input-field col l4 m4 s12">
        <label for="Costo">Costo</label>
        <input  id="Costo" name="pCosto" type="number" class="validate pCosto">
      </div>
      <div class="col l4 m4 s12">
          <button class="btn waves-effect waves-light green" type="button" id="bt_add">Agregar
            <i class="material-icons right">add</i>
          </button>
        </div>
     </div>
     <div class="row">
        <!-- Tabla -->
        <div class="col l12 m12 s12">
          <table class="striped" id="detalles">
        <thead>
          <tr>
              <th>Opciones</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
          </tr>
        </thead>
        <tfoot class="">
          <th><h4>Total</h4></th>
          <th></th>
          <th></th>
          <th><h4 id="total">$/</h4></th>
        </tfoot>
        <tbody>
          
        </tbody>
      </table>
        </div>
     </div>
    <div class="col l12 m12 s12" id="guardar">
     <input name="_token" value="{{ csrf_token() }}" type="hidden">
     <button class="btn blue" type="submit">Guardar<i class="material-icons right">send</i></button>
      <a class="waves-effect waves-light btn red" href="/Back/Mesero"><i class="material-icons right">clear</i>Cancelar</a>
    </div>
  </div>
  </div>
   </div>

    </div>
  </div>
</div>
{!!Form::close()!!}
@push('scripts')
<script type="text/javascript">

  $(document).ready(function(){
    $('#bt_add').click(function(){
       cantidad=$(".pCantidad").val();
       stock=$(".pStock").val();

       if(stock >= cantidad){
      agregar();
    }else{
      alert("No hay suficientes productos")

    }
    });
  });

  var cont=0;
  total=0;
  subtotal=[];

  function agregar(){
    idProductos=$(".pID").val();
    producto=$(".pProducto").val();
    precio=$(".pPrecio").val();
    cantidad=$(".pCantidad").val();
    costo=$(".pCosto").val();
    if(idProductos!=0 && cantidad!=""  && cantidad > 0 && producto!="" && costo!="" ){

      subtotal[cont]=(cantidad*precio);
      total=total+subtotal[cont];

      var fila='<tr class="striped" id="fila'+cont+'"><td><button type="button" class="btn red" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idProductos[]" value="'+idProductos+'">'+producto+'</td><td><input type="hidden" name="Cantidad[]" value="'+cantidad+'">'+cantidad+'</td><td><input type="hidden" name="Costo[]" value="'+costo+'">'+subtotal[cont]+'</td></tr>';
       cont++;
       limpiar();
       $('#total').html("$/ " + total);
       evaluar();
       $('#detalles').append(fila);

    }
    else
    {
      alert("Error al ingresar el detalle del ingreso, revise los datos del articulo")
    }

  }

function limpiar(){
  $("#Cantidad").val("");
  $("#Costo").val("");
  $("#pPrecio").val("");
}

function evaluar(){
  if(total>0){
    $("#guardar").show();
  }else{
    $("#guardar").hide();
  }
}

 function eliminar(index){
    total=total-subtotal[index]; 
    $("#total").html("$/. " + total);   
    $("#fila" + index).remove();
    evaluar();
  }
</script>

@endpush
@endsection