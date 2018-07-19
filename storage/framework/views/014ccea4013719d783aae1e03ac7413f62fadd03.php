<?php $__env->startSection('contenido'); ?>

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Editar Mesa: <?php echo e($mesa->Descripcion); ?></h3>
			<?php if(count($errors)>0): ?>
      <div class="alert alert-danger">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <?php endif; ?>
		</div>
	</div>
</div>
<?php echo Form::Model($mesa,['enctype'=>'multipart/form-data','method'=>'PATCH','route'=>['Mesas.update',$mesa->idMesas],'file'=>'true']); ?>

<?php echo e(Form::token()); ?>


 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">edit</i>
       <label for="Titulo">Desccripcion</label>
       <input type="text" name="Descripcion" required value="<?php echo e($mesa->Descripcion); ?>" class="form-control">
       </div>
     </div>
  <button class="btn blue" type="submit">
	 Guardar
    <i class="material-icons right">send</i>
	</button>
     <a href="<?php echo e(URL::action('BMesasController@index')); ?>" class="waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
  </div>
  </div>
   </div>
    </div>
    </div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>