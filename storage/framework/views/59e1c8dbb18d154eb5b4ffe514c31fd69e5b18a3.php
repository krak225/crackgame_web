<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Mes retraits</li> 
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
	<h3 class="m-b-none">Liste des retraits</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des retraits <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="10%">Réf</th>
					<th width="15%">Montant</th>
					<th width="20%">Date demande</th>
					<th width="20%">Date validation</th>
					<th width="20%">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $retraits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $retrait): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($retrait->retrait_id); ?></td>
					<td><?php echo e($retrait->retrait_montant); ?></td>
					<td><?php echo e(Stdfn::dateTimeFromDB($retrait->retrait_date_demande)); ?></td>
					<td><?php echo e(Stdfn::dateTimeFromDB($retrait->retrait_date_validation)); ?></td>
					<td><?php echo e($retrait->retrait_statut); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>