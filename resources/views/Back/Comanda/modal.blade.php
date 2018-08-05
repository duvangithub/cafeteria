<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$o->idDetalleorden}}">

	{{Form::open(array('action'=>array('ComandaController@destroy',$o->idDetalleorden),'method'=>'delete'))}}

	 <div class="modal-content">
      <h4>¿Producto {{$o->producto}} listo ?</h4>
    </div>
    <div class="modal-footer">
	 <button type="submit" class="btn blue">Confirmar</button>
	 <a href="#!" class="modal-action modal-close btn red">Cancelar</a>
    </div>


	{{Form::close()}}
	
</div>
