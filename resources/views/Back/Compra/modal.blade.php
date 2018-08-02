<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$o->idOrden}}">

	{{Form::open(array('action'=>array('OrdenVentaController@destroy',$o->idOrden),'method'=>'delete'))}}

	 <div class="modal-content">
      <h4>Deseas cancelar la orden {{$o->Orden}}</h4>
      <p>Nombre:{{$o->Nombre}}</p>
      <p>Fecha:{{$o->Fecha}}</p>
      <p>Mesa:{{$o->mesa}}</p>
  
    </div>
    <div class="modal-footer">
	 <button type="submit" class="btn blue">Confirmar</button>
	 <a href="#!" class="modal-action modal-close btn red">Cancelar</a>
    </div>


	{{Form::close()}}
	
</div>
