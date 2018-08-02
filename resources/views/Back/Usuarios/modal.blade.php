<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$us->id}}">

	{{Form::open(array('action'=>array('UsuarioController@destroy',$us->id),'method'=>'delete'))}}

	 <div class="modal-content">
      <h4>Deses eliminar {{$us->name}}</h4>
      <h5>{{$us->email}}</h5>
    </div>
    <div class="modal-footer">
	 <button type="submit" class="btn blue">Confirmar</button>
	 <a href="#!" class="modal-action modal-close btn red">Cancelar</a>
    </div>


	{{Form::close()}}
	
</div>
