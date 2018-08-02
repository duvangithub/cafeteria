@extends ('layouts.Menu')
@section ('contenido')
@if(Auth::user()->tipo==1)
<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Listado de tamaños <a href="Tamaños/create" class="waves-effect waves-light btn green"><i class="material-icons right">add</i>Nuevo</a> </h4>
	@include('Back.Tamaños.search')
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
              <th>Tamaño</th>
              <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 @foreach($tamanios as $t)
          <tr>
            <td>{{$t->idTamaños}}</td>
            <td>{{$t->Tamaño}}</td>
            <td>
             <a href="#modal-delete-{{$t->idTamaños}}" data-toggle="modal" class="waves-effect waves-light btn modal-trigger red"><i class="material-icons">delete</i></a>
            </td>
          </tr>
          	@include('Back.Tamaños.modal')
            @endforeach
        </tbody>
      </table>
  </div>
  </div>
   </div>

    </div>
     {{$tamanios->render()}}
    </div>
@else
 @include('/Error/error')
@endif
@endsection