<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$t->idTamaños}}">

	{{Form::open(array('action'=>array('TamañosController@destroy',$t->idTamaños),'method'=>'delete'))}}

	 <div class="modal-content">
      <h4>Deseas eliminar el tamaño {{$t->idTamaños}}</h4>
  
    </div>
    <div class="modal-footer">
	 <button type="submit" class="btn blue">Confirmar</button>
	 <a href="#!" class="modal-action modal-close btn red">Cancelar</a>
    </div>


	{{Form::close()}}
	
</div>
