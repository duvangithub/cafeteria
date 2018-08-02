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
       <input type="number" disabled value="{{$orden->Orden}}">
        <label for="Orden">Numero de orden</label>
      </div>
      <div class="input-field col l6 m6 s12">
        <i class="material-icons prefix">edit</i>
        <input disabled type="text" value="{{$orden->Nombre}}">
        <label for="Nombre">Nombre</label>
      </div>
     </div>
     <div class="row">
      <div class="input-field col l6 m6 s12">
          <i class="material-icons prefix">apps</i>
        <input type="text" disabled value="{{$orden->Usuario}}">
        <label for="Usuario">Personal</label>
      </div>
        <div class="input-field col l6 m6 s12">
          <i class="material-icons prefix">apps</i>
        <input type="text" disabled value="{{$orden->mesa}}">
        <label for="Orden">Mesa</label>
      </div>
       <div class="input-field col l12 m12 s12">
        <i class="material-icons prefix">event</i>
        <input type="text" disabled value="{{$orden->Fecha}}">
        <label for="Orden">Fecha</label>
      </div>
     </div>
  </div>
   </div>
    </div>
    <!-- Detalles -->
   <div class="card darken-1">
  <div class="card-content">
     <div class="row">
        <!-- Tabla -->
        <div class="col l12 m12 s12">
          <table class="responsive-table striped" id="detalles">
        <thead>
          <tr>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
          </tr>
        </thead>
        <tfoot>
          <th><h4>Total</h4></th>
          <th></th>
          <th><h4 id="total">{{$orden->total}}</h4></th>
        </tfoot>
        <tbody>
          @foreach($detalle as $det)
          <tr>
            <td>{{$det->producto}}</td>
            <td>{{$det->Cantidad}}</td>
            <td>{{$det->Cantidad*$det->precio}}</td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
        </div>
     </div>
  </div>
   </div>
   <!-- Detalle venta -->
   <div class="card darken-1">
  <div class="card-content">
     <div class="row">
        <!-- Tabla -->
        <div class="col l12 m12 s12">
          <table class="responsive-table striped">
        <thead>
          <tr>
              <th>Total</th>
              <th>Pagado</th>
              <th>Cambio</th>
              <th>Estado</th>
              <th>Tipo</th>
          </tr>
        </thead>
        <tbody>
          @foreach($venta as $ven)
          <tr>
            <td>{{$ven->total}}</td>
            <td>{{$ven->pagado}}</td>
            <td>{{$ven->cambio}}</td>
             @if($ven->estado==0)
            <td>Saldado</td>
            @elseif($ven->estado==1)
             <td>Activo</td>
            @endif
            @if($ven->tipo==0)
            <td>Efectivo</td>
             @elseif($ven->tipo==1)
            <td>Tarjeta</td>
            @endif
          </tr>
          @endforeach
          
        </tbody>
      </table>
        </div>
     </div>
   <a href="{{URL::action('VentasController@index')}}" class="waves-effect waves-light btn red"><i class="material-icons left">chevron_left</i>Atras</a>
  </div>
   </div>
   <!-- Extras -->
    </div>
  </div>
</div>
@endsection