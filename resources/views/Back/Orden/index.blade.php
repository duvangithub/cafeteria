@extends ('layouts.Menu')
@section ('contenido')
@if(Auth::user()->tipo==1)
<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Listado de ordenes <a href="Orden/create" class="waves-effect waves-light btn green"><i class="material-icons right">add</i>Nuevo</a> </h4>
	@include('Back.Orden.search')
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
             
              <th>Orden</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Mesa</th>
              <th>Estado</th>
              <th>Mesero</th>
              <th>Total</th>
              <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 @foreach($ordenes as $o)
          <tr>
            
            <td>{{$o->Orden}}</td>
            <td>{{$o->Nombre}}</td>
            <td>{{$o->Fecha}}</td>
            <td>{{$o->mesa}}</td>
            @if($o->Estado==0)
            <td>Saldado</td>
            @elseif($o->Estado==1)
            <td>Activo</td>
            @endif
            <td>{{$o->Usuario}}</td>
            <td>{{$o->total}}</td>
            <td>
             <?php
             $id=$o->idOrden;
             $total=$o->total;
              ?>
            <a href="{{URL::action('BOrdenController@show',$o->idOrden)}}" class="waves-effect waves-light btn blue"><i class="material-icons">remove_red_eye</i></a>
            @if($o->Estado==1)
             <a href="/Back/Venta/create?ID=<?php echo $id;?>&TOTAL=<?php echo $total;?>" class="waves-effect waves-light btn green"><i class="material-icons">account_balance_wallet</i></a>
            @elseif($o->Estado==0)
            @endif
             <a href="#modal-delete-{{$o->idOrden}}" data-toggle="modal" class="waves-effect waves-light btn modal-trigger red"><i class="material-icons">delete</i></a>
            </td>
          </tr>
          	@include('Back.Orden.modal')
            @endforeach
        </tbody>
      </table>
  </div>
  </div>
   </div>

    </div>
     {{$ordenes->render()}}
    </div>
    @else
 @include('/Error/error')
@endif

@endsection