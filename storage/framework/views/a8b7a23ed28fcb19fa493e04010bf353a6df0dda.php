<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Mes bonus</li> 
</ul> 


<?php if(Session::has('warning')): ?>
	<div class="alert alert-warning">
	  <?php echo e(Session::get('warning')); ?>

	</div>
<?php endif; ?>

<?php if(Session::has('message')): ?>
	<div class="alert alert-success">
	  <?php echo e(Session::get('message')); ?>

	</div>
<?php endif; ?>


<div class="m-b-md"> 
	<h3 class="m-b-none">Liste des bonus</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des bonus <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="20%">Réf</th> 
					<th width="">Valeur</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $bonus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($b->nom); ?></td> 
					<td><?php echo e($b->prenoms); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>