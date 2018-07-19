@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Listado de categorias <a href="Categorias/create" class="waves-effect waves-light btn green"><i class="material-icons right">add</i>Nuevo</a> </h4>
	@include('Back.Categorias.search')
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
              <th>Imagen</th>
              <th>Estado</th>
               <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 @foreach($categorias as $c)
          <tr>
            <td>{{$c->idCategorias}}</td>
            <td>{{$c->Descripcion}}</td>
            <td><img src="{{asset('Imagenes/Categorias/'.$c->Imagen)}}" alt="{{$c->Descripcion}}" height="100px" width="100px" class="responsive-img"></td>
            @if ($c->Estado==0)
            <td>Desactivado</td>
            @else
            <td>Activo</td>
            @endif
            <td>
            <a href="{{URL::action('BCategoriasController@edit',$c->idCategorias)}}" class="waves-effect waves-light btn blue"><i class="material-icons right">edit</i>Editar
            </a>
             <a href="#modal-delete-{{$c->idCategorias}}" data-toggle="modal" class="waves-effect waves-light btn modal-trigger red"><i class="material-icons right">delete</i>Eliminar
            </a>
            </td>
          </tr>
          	@include('Back.Categorias.modal')
            @endforeach
        </tbody>
      </table>
  </div>
  </div>
   </div>

    </div>
     {{$categorias->render()}}
    </div>

@endsection