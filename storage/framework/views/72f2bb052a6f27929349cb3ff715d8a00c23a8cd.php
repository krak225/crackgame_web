<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Mes dépots</li> 
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
	<h3 class="m-b-none">Liste des dépots</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des dépots <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="10%">Réf</th> 
					<th width="">Nom bénéficiaire</th>
					<th width="25%">Pseudo bénéficiaire</th>
					<th width="15%">Montant</th>
					<th width="20%">Date</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $depots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $depot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($depot->depot_id); ?></td> 
					<td><?php echo e($depot->nom . ' '. $depot->prenoms); ?></td>
					<td><?php echo e($depot->pseudo); ?></td>
					<td><?php echo e($depot->depot_montant); ?></td>
					<td><?php echo e(Stdfn::dateTimeFromDB($depot->depot_date)); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>