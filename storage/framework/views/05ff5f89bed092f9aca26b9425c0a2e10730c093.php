<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Questionnaire</li> 
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
	<h3 class="m-b-none">Liste des questions</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des questions <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<form id="formSelectionQuestion"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="5%"></th> 
					<th width="">Question</th> 
					<th width="20%">Bonne réponse</th>
					<th width="20%">Mauvaise 1</th>
					<th width="20%">Mauvaise 2</th>
					<th width="5%">Statut</th>
					<?php if(!empty($selectionner)): ?>
					<th width="5%">Quiz</th>
					<th width="5%">Chap</th>
					<?php else: ?>
					<th width="5%">Modif</th>
					<th width="5%">Suppr</th>
					<?php endif; ?>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($question->id); ?></td> 
					<td><?php echo e($question->question_fr); ?></td> 
					
					<?php if($question->reponse == 'A'): ?>
						<td><?php echo e($question->proposition_a_fr); ?></td>
						<td><?php echo e($question->proposition_b_fr); ?></td> 
						<td><?php echo e($question->proposition_c_fr); ?></td>
					<?php elseif($question->reponse == 'B'): ?>
						<td><?php echo e($question->proposition_b_fr); ?></td>
						<td><?php echo e($question->proposition_a_fr); ?></td> 
						<td><?php echo e($question->proposition_c_fr); ?></td>
					<?php else: ?>
						<td><?php echo e($question->proposition_c_fr); ?></td>
						<td><?php echo e($question->proposition_a_fr); ?></td> 
						<td><?php echo e($question->proposition_b_fr); ?></td>
					<?php endif; ?>
					
					<td><?php echo e($question->statut); ?></td>
					
					<?php if(Auth::user()->profil_id == 1): ?>
						<td>
							<a href="<?php echo e(route('valider_question',$question->id)); ?>"><i class="fa fa-info-circle text-info" title="Valider la question"></i></a>					
							<a href="<?php echo e(route('modifier_question',$question->id)); ?>"><i class="fa fa-edit text-warning" title="Modifier la question"></i></a>
						</td>
					<?php else: ?>
						<?php if(!empty($selectionner)): ?>
							<td>
								<input <?php if($question->statut_selection=='SELECTED'): ?> <?php echo e(' checked '); ?> <?php endif; ?> name="checkbox_selection_question" class="checkbox checkbox_selection_question" type="checkbox" id="chk_<?php echo e($question->id); ?>" data-id="<?php echo e($question->id); ?>" />					
							</td>
							<td>
								<input <?php if($question->statut_selection_chap=='SELECTED'): ?> <?php echo e(' checked '); ?> <?php endif; ?> name="checkbox_selection_question_chap" class="checkbox checkbox_selection_question_chap" type="checkbox" id="chk_<?php echo e($question->id); ?>" data-id="<?php echo e($question->id); ?>" />					
							</td>
						<?php else: ?>
							<td><?php if($question->statut=="BROUILLON"): ?>
								<a href="<?php echo e(route('modifier_question',$question->id)); ?>"><i class="fa fa-edit text-warning" title="Modifier la question"></i></a>
								<?php endif; ?>
							</td>
							<td>
								<a href="<?php echo e(route('supprimer_question',$question->id)); ?>"><i class="fa fa-times text-danger" title="Supprimer la question"></i></a>
							</td>
						<?php endif; ?>	
					
					<?php endif; ?>
						
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
		</form> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>