@extends ('layouts.Menu')
@section ('contenido')
@if(Auth::user()->tipo==1)
<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Listado de ventas</h4>
	@include('Back.Venta.search')
</div>
</div>
</div>
</div>
     <div class="card darken-1">
     <div class="card-content">
<div class="row">
    <table class="striped responsive-table" >
        <thead>
          <tr>
              <th>Folio</th>
              <th>Nombre</th>
              <th>Total</th>
              <th>Fecha</th>
              <th>Estado</th>
              <th>Tipo</th>
              <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 @foreach($ventas as $ve)
          <tr>
            <td>{{$ve->orden}}</td>
            <td>{{$ve->nombre}}</td>
            <td>{{$ve->total}}</td>
            <td>{{$ve->fecha}}</td>
            @if($ve->estado==0)
            <td>Saldado</td>
            @elseif($ve->estado==1)
            <td>Activo</td>
            @endif
            @if($ve->tipo==0)
            <td>Efectivo</td>
             @elseif($ve->tipo==1)
             <td>Tarjeta</td>
             @endif
            <td>
            <a href="{{URL::action('VentasController@show',$ve->idorden)}}" class="waves-effect waves-light btn blue"><i class="material-icons">remove_red_eye</i></a>
             <a href="#modal-delete-{{$ve->idVenta}}" data-toggle="modal" class="waves-effect waves-light btn modal-trigger red"><i class="material-icons">delete</i></a>
            </td>
          </tr>
          	@include('Back.Venta.modal')
            @endforeach
        </tbody>
      </table>
  </div>
  </div>
   </div>
    </div>
     {{$ventas->render()}}
    </div>
    @else
 @include('/Error/error')
@endif

@endsection