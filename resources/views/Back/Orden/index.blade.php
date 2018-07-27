@extends ('layouts.Menu')
@section ('contenido')

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
              <th>ID</th>
              <th>Orden</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Mesa</th>
              <th>Estado</th>
              <th>Total</th>
              <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 @foreach($ordenes as $o)
          <tr>
            <td>{{$o->idOrden}}</td>
            <td>{{$o->Orden}}</td>
            <td>{{$o->Nombre}}</td>
            <td>{{$o->Fecha}}</td>
            <td>{{$o->mesa}}</td>
            @if($o->Estado==0)
            <td>Desactivado</td>
            @elseif($o->Estado==1)
            <td>Activado</td>
            @endif
            <td>{{$o->total}}</td>
            <td>
            <a href="{{URL::action('BOrdenController@show',$o->idOrden)}}" class="waves-effect waves-light btn blue"><i class="material-icons">remove_red_eye</i></a>
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

@endsection