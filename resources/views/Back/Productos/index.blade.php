@extends ('layouts.Menu')
@section ('contenido')
  @if(Auth::user()->tipo==1)
<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Listado de productos <a href="Productos/create" class="waves-effect waves-light btn green"><i class="material-icons right">add</i>Nuevo</a> </h4>
	@include('Back.Productos.search')
</div>
</div>
</div>
</div>
     <div class="card darken-1">
     <div class="card-content">
<div class="row">
    <table class="striped responsive-table centered" >
        <thead>
          <tr>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Tamaño</th>
              <th>Precio</th>
              <th>Stock</th>
              <th>Categoria</th>
              <th>Imagen</th>
              <th>Estado</th>
              <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 @foreach($productos as $p)
          <tr>
            <td>{{$p->NumProducto}}</td>
            <td>{{$p->Descripcion}}</td>
            <td>{{$p->tamanio}}</td>
            <td>{{$p->Precio}}</td>
            @if($p->Stock <= 10)
             <td bgcolor="#c62828 red darken-3">{{$p->Stock}}</td>
            @else
              <td>{{$p->Stock}}</td>
            @endif
            <td>{{$p->cate}}</td>
            <td><img src="{{asset('Imagenes/productos/'.$p->Imagen)}}" alt="{{$p->Descripcion}}" height="100px" width="100px" class="responsive-img"></td>
            @if ($p->Estado==0)
            <td>Desactivado</td>
            @else
            <td>Activo</td>
            @endif
            <td>
            <a href="{{URL::action('ProductosController@edit',$p->idProductos)}}" class="waves-effect waves-light btn blue"><i class="material-icons">edit</i></a>
             <a href="#modal-delete-{{$p->idProductos}}" data-toggle="modal" class="waves-effect waves-light btn modal-trigger red"><i class="material-icons">delete</i></a>
            </td>
          </tr>
          	@include('Back.Productos.modal')
            @endforeach
        </tbody>
      </table>
  </div>
  </div>
   </div>

    </div>
     {{$productos->render()}}
    </div>
@else
 @include('/Error/error')
@endif

@endsection