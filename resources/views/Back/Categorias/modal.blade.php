<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$c->idCategorias}}">

	{{Form::open(array('action'=>array('BCategoriasController@destroy',$c->idCategorias),'method'=>'delete'))}}

	 <div class="modal-content">
      <h4>Deses eliminar {{$c->Descripcion}}</h4>
       <img src="{{asset('Imagenes/Categorias/'.$c->Imagen)}}" height="200px" width="200px" >
    </div>
    <div class="modal-footer">
	 <button type="submit" class="btn blue">Confirmar</button>
	 <a href="#!" class="modal-action modal-close btn red">Cancelar</a>
    </div>


	{{Form::close()}}
	
</div>