@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Venta</h3>
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
{!!Form::open(array('url'=>'Back/Venta','method'=>'POST','autocomplete'=>'off','file'=>'true', 'enctype'=>'multipart/form-data'))!!}
{{Form::token()}}



  <div class="card darken-1">
     <div class="card-content">
   <div class="row">
     <div class="row">
        <div class="input-field col l12 m12 s12">
        <input  id="idOrden" name="idOrden" type="hidden" class="validate" value="<?php echo $_GET['ID'];?>" required>
      </div>
      <div class="input-field col l12 m12 s12">
        <input  id="Total" name="Total" type="hidden" class="validate"  value="<?php echo $_GET['TOTAL'];?>" required>
      </div>
      <div class="row">
        <div class="col l12 m12 s12">
          <label for="">Total</label>
          <h4>$<?php echo $_GET['TOTAL'];?></h4>
        </div>
      </div>
     </div>
      <div class="row">
        <div class="input-field col s12">
        <i class="material-icons prefix">payment</i>
        <select name="Tarjeta" required>
          <option value="" disabled selected required>Elige la opcion de pago</option>
          <option value="0" >Efectivo</option>
          <option value="1" >Tarjeta</option>
        </select>
        <label>Metodo de pago</label>
        </div>
     </div>
     <div class="row">
      <div class="input-field col l6 m6 s12">
        <i class="material-icons prefix">monetization_on</i>
        <input id="Pagado" name="Pagado" type="number" step="any" class="validate" onblur="resta(this.form)" required value="{{old('Pagado')}}">
        <label for="Pagado">Pagado</label>
      </div>
       <div class="input-field col l6 m6 s12">
        <i class="material-icons prefix">label</i>
        <input id="Cambio" name="Cambio" type="number" step="any" class="validate" required value="{{old('Cambio')}}">
        <label for="Cambio">Cambio</label>
      </div>
     </div>
     <!-- Botones -->
    <div class="col l12 m12 s12" id="guardar">
     <input name="_token" value="{{ csrf_token() }}" type="hidden">
     <button class="btn blue opera" type="submit">Guardar<i class="material-icons right">send</i></button>
     <button class="btn red" type="reset">Cancelar<i class="material-icons right">clear</i></button>
    </div>
  </div>
</div>
</div>

  
<!-- Extras -->
    </div>
  </div>
</div>
{!!Form::close()!!}

@endsection