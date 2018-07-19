@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Listado de mesas <a href="Mesas/create" class="waves-effect waves-light btn green"><i class="material-icons right">add</i>Nuevo</a> </h4>
	@include('Back.Mesas.search')
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
              <th>Descripcion</th>
               <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 @foreach($mesas as $m)
          <tr>
            <td>{{$m->idMesas}}</td>
            <td>{{$m->Descripcion}}</td>
            <td>
            <a href="{{URL::action('BMesasController@edit',$m->idMesas)}}" class="waves-effect waves-light btn blue"><i class="material-icons right">edit</i>Editar
            </a>
             <a href="#modal-delete-{{$m->idMesas}}" data-toggle="modal" class="waves-effect waves-light btn modal-trigger red"><i class="material-icons right">delete</i>Eliminar
            </a>
            </td>
          </tr>
          	@include('Back.Mesas.modal')
            @endforeach
        </tbody>
      </table>
  </div>
  </div>
   </div>

    </div>
     {{$mesas->render()}}
    </div>

@endsection