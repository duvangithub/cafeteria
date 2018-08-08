@extends ('layouts.Menu')
@section ('contenido')
<div class="row">
   <div class="col s12 ">
    <div class="row">
     <div class="card darken-1">
    
 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <h4>Detalle de la orden</h4>
     <div class="row">
       <div class="input-field col l6 m6 s12">
        <i class="material-icons prefix">receipt</i>
       <input type="number" disabled value="{{$recibo->Orden}}">
        <label for="Orden">Numero de orden</label>
      </div>
      <div class="input-field col l6 m6 s12">
        <i class="material-icons prefix">edit</i>
        <input disabled type="text" value="{{$recibo->Nombre}}">
        <label for="Nombre">Nombre</label>
      </div>
     </div>
     <div class="row">
       <div class="input-field col l6 m6 s12">
          <i class="material-icons prefix">apps</i>
        <input type="text" disabled value="{{$recibo->Usuario}}">
        <label for="Usuario">Mesero</label>
      </div>
        <div class="input-field col l6 m6 s12">
          <i class="material-icons prefix">apps</i>
        <input type="text" disabled value="{{$recibo->idMesas}}">
        <label for="Orden">Mesa</label>
      </div>
       <div class="input-field col l12 m12 s12">
        <i class="material-icons prefix">event</i>
        <input type="text" disabled value="{{$recibo->Fecha}}">
        <label for="Orden">Fecha</label>
      </div>
     </div>
  </div>
   </div>
    </div>
   <a href="{{URL::action('BOrdenController@index')}}" class="waves-effect waves-light btn red"><i class="material-icons left">chevron_left</i>Atras</a>
  </div>
   </div>
   <!-- Extras -->
    </div>
  </div>
</div>
@endsection