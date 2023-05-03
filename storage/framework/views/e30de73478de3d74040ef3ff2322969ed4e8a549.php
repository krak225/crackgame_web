<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Mes souscriptions</li> 
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
	<h3 class="m-b-none">Historique des souscriptions</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des dépots <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="10%">Réf</th>
					<th width="25%">Bénéficiaire</th>
					<th width="15%">Quantité</th>
					<th width="15%">Montant</th>
					<th width="20%">Date</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $souscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $souscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($souscription->souscription_id); ?></td> 
					<td><?php echo e($souscription->pseudo); ?></td>
					<td><?php echo e($souscription->souscription_quantite); ?></td>
					<td><?php echo e($souscription->souscription_montant); ?></td>
					<td><?php echo e(Stdfn::dateTimeFromDB($souscription->souscription_date)); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>