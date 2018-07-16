<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-<?php echo e($m->idMesas); ?>">

	<?php echo e(Form::open(array('action'=>array('BMesasController@destroy',$m->idMesas),'method'=>'delete'))); ?>


	 <div class="modal-content">
      <h4>Deses eliminar <?php echo e($m->Descripcion); ?></h4>
    </div>
    <div class="modal-footer">
	 <button type="submit" class="btn blue">Confirmar</button>
	 <a href="#!" class="modal-action modal-close btn red">Cancelar</a>
    </div>


	<?php echo e(Form::close()); ?>

	
</div>
