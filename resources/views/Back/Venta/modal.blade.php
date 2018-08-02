<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$ve->idVenta}}">

	{{Form::open(array('action'=>array('VentasController@destroy',$ve->idVenta),'method'=>'delete'))}}

	 <div class="modal-content">
      <h4>Deseas cancelar la venta con el folio {{$ve->orden}}</h4>
      <p>Nombre:{{$ve->nombre}}</p>
    </div>
    <div class="modal-footer">
	 <button type="submit" class="btn blue">Confirmar</button>
	 <a href="#!" class="modal-action modal-close btn red">Cancelar</a>
    </div>


	{{Form::close()}}
	
</div>
