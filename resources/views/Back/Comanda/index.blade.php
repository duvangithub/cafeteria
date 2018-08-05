@extends ('layouts.Menu')
@section ('contenido')

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Lista de comandas</h4>
	@include('Back.Comanda.search')
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
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Nombre</th>
              <th>Fecha</th>
              <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 @foreach($detalles as $o)
          <tr>
            <td>{{$o->orden}}</td>
            <td>{{$o->producto}}</td>
            <td>{{$o->Cantidad}}</td>
            <td>{{$o->nombre}}</td>
            <td>{{$o->fecha}}</td>
            <td>
             <a href="#modal-delete-{{$o->idDetalleorden}}" data-toggle="modal" class="waves-effect waves-light btn modal-trigger green"><i class="material-icons">check</i></a>
            </td>
          </tr>
          	@include('Back.Comanda.modal')
            @endforeach
        </tbody>
      </table>
  </div>
  </div>
   </div>

    </div>
     {{$detalles->render()}}
    </div>
    @push('actualizar')
    <script type="text/javascript">

      function actualizar(){location.reload(true);}
      setInterval("actualizar()",10000);
      
    </script>

    @endpush

@endsection