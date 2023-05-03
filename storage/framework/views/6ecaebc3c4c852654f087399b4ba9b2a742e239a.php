<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Quiz</li> 
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
	<h3 class="m-b-none">Quiz</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des quiz
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="5%">Réf</th>
					<th width="15%">Date</th>
					<th width="15%">Catégorie</th>
					<th width="10%">Objectif</th>
					<th width="10%">Compteur</th>
					<th width="10%">Score</th>
					<th width="10%">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $quizs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<tr>
					<td><?php echo e($quiz->entrainement_id); ?></td>
					<td><?php echo e(Stdfn::dateTimeFromDB($quiz->entrainement_date)); ?></td>
					<td><?php echo e($quiz->categorie_libelle); ?></td>
					<td><?php echo e($quiz->objectif_financier); ?></td>
					<td><?php echo e($quiz->entrainement_compteur_question); ?></td>
					<td><?php echo e($quiz->entrainement_score); ?></td>
					<td><?php echo e($quiz->entrainement_statut); ?></td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>