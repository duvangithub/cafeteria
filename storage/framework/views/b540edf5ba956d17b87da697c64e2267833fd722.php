<?php $__env->startSection('contenido'); ?>

<div class="row">
   <div class="col s12 ">
   	<div class="row">
   	 <div class="card darken-1">
     <div class="card-content">
<div class="row">
	<h4>Listado de mesas <a href="Mesas/create" class="waves-effect waves-light btn green"><i class="material-icons right">add</i>Nuevo</a> </h4>
	<?php echo $__env->make('Back.Mesas.search', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
              <th>ID</th>
              <th>Descripcion</th>
              <th>Estado</th>
               <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
        	 <?php $__currentLoopData = $mesas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($m->idMesas); ?></td>
            <td><?php echo e($m->Descripcion); ?></td>
            <?php if($m->Estado==0): ?>
            <td>Desactivado</td>
            <?php else: ?>
            <td>Activo</td>
            <?php endif; ?>
            <td>
            <a href="<?php echo e(URL::action('BMesasController@edit',$m->idMesas)); ?>" class="waves-effect waves-light btn blue"><i class="material-icons right">edit</i>Editar
            </a>
             <a href="#modal-delete-<?php echo e($m->idMesas); ?>" data-toggle="modal" class="waves-effect waves-light btn modal-trigger red"><i class="material-icons right">delete</i>Eliminar
            </a>
            </td>
          </tr>
          	<?php echo $__env->make('Back.Mesas.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
  </div>
  </div>
   </div>

    </div>
     <?php echo e($mesas->render()); ?>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>