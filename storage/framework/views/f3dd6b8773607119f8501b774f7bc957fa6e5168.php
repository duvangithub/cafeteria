<?php $__env->startSection('contenido'); ?>

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h3>Nuevas mesas</h3>
			<?php if(count($errors)>0): ?>
			<div class="alert alert-danger">
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php echo Form::open(array('url'=>'Back/Mesas','method'=>'POST','autocomplete'=>'off','file'=>'true', 'enctype'=>'multipart/form-data')); ?>

<?php echo e(Form::token()); ?>


 <div class="card darken-1">
  <div class="card-content">
   <div class="row">
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">edit</i>
        <input id="Descripcion" name="Descripcion" type="text" class="validate" required value="<?php echo e(old('Descripcion')); ?>">
        <label for="Descripcion">Descripcion</label>
       </div>
     </div>
     <button class="btn blue" type="submit">
	 Guardar
    <i class="material-icons right">send</i>
	</button>
     <a class="waves-effect waves-light btn red"><i class="material-icons right">clear</i>Cancelar</a>
  </div>
  </div>
   </div>
    </div>
    </div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>