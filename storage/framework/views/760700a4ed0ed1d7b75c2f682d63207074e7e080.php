<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li><a href="<?php echo e(route('chaps')); ?>">Jeux chap</a></li>  
	<li class="active">Détails d'un jeux chap-chap</li> 
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
	<h3 class="m-b-none">Détails d'un jeux chap-chap</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des joueurs et leurs scores
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="10%">Réf</th>
					<th width="15%">Niveau</th>
					<th width="20%">Participant</th>
					<th width="20%">Score</th>
					<th width="10%">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $resultatschap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resultat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>Chap N° <?php echo e($resultat->id); ?></td>
					<td><?php echo e($resultat->chap_etape); ?></td>
					<td><?php echo e($resultat->pseudo); ?></td>
					<td><?php echo e($resultat->score); ?></td>
					<td><?php echo e($resultat->statut); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>