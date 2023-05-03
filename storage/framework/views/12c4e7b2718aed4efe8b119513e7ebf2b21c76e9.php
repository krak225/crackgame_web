<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Gestion des questions</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Modification d'une question</h3> 
</div>

<?php if(Session::has('message')): ?>
	<div class="alert alert-success">
	  <?php echo e(Session::get('message')); ?>

	</div>
<?php endif; ?>

<?php if(Session::has('warning')): ?>
	<div class="alert alert-warning">
	  <?php echo e(Session::get('warning')); ?>

	</div>
<?php endif; ?>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3"><span class="badge"></span>Saisissez une question, proposez trois réponses et précisez la réponse correcte</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form enctype="multipart/form-data"  method="post" class="form-horizontal" action="<?php echo e(route('UpdateQuestion')); ?>">
			
			<?php echo csrf_field(); ?>

			
			<input type="hidden" class="form-control" name="question_id" value="<?php echo e($question->id); ?>">
			
			<div class="step-pane active" id="step1"> 
					
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label for="question_" class="col-md-4 control-label">Question</label>

					<div class="col-md-4">
						<input id="question_" type="text" class="form-control" name="question" value="<?php echo e($question->question_fr); ?>" required autofocus>
					</div>
				</div>

				<?php if($question->reponse == 'A'): ?>
				<div class="form-group<?php echo e($errors->has('proposition_1') ? ' has-error' : ''); ?>">
					<label for="proposition_1" class="col-md-4 control-label">Bonne réponse</label>

					<div class="col-md-4">
						<input id="proposition_1" type="text" class="form-control" name="proposition_1" value="<?php echo e($question->proposition_a_fr); ?>" required>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('proposition_2') ? ' has-error' : ''); ?>">
					<label for="proposition_2" class="col-md-4 control-label">Mauvaise réponse 1</label>

					<div class="col-md-4">
						<input id="proposition_2" type="text" class="form-control" name="proposition_2" value="<?php echo e($question->proposition_b_fr); ?>" required>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('proposition_3') ? ' has-error' : ''); ?>">
					<label for="proposition_3" class="col-md-4 control-label">Mauvaise réponse 2</label>

					<div class="col-md-4">
						<input id="proposition_3" type="text" class="form-control" name="proposition_3" value="<?php echo e($question->proposition_c_fr); ?>" required>
					</div>
				</div>
				<?php elseif($question->reponse == 'B'): ?>
					
					<div class="form-group<?php echo e($errors->has('proposition_1') ? ' has-error' : ''); ?>">
						<label for="proposition_1" class="col-md-4 control-label">Bonne réponse</label>

						<div class="col-md-4">
							<input id="proposition_1" type="text" class="form-control" name="proposition_1" value="<?php echo e($question->proposition_b_fr); ?>" required>
						</div>
					</div>

					<div class="form-group<?php echo e($errors->has('proposition_2') ? ' has-error' : ''); ?>">
						<label for="proposition_2" class="col-md-4 control-label">Mauvaise réponse 1</label>

						<div class="col-md-4">
							<input id="proposition_2" type="text" class="form-control" name="proposition_2" value="<?php echo e($question->proposition_a_fr); ?>" required>
						</div>
					</div>

					<div class="form-group<?php echo e($errors->has('proposition_3') ? ' has-error' : ''); ?>">
						<label for="proposition_3" class="col-md-4 control-label">Mauvaise réponse 2</label>

						<div class="col-md-4">
							<input id="proposition_3" type="text" class="form-control" name="proposition_3" value="<?php echo e($question->proposition_c_fr); ?>" required>
						</div>
					</div>
				
				<?php else: ?>
					
					<div class="form-group<?php echo e($errors->has('proposition_1') ? ' has-error' : ''); ?>">
						<label for="proposition_1" class="col-md-4 control-label">Bonne réponse</label>

						<div class="col-md-4">
							<input id="proposition_1" type="text" class="form-control" name="proposition_1" value="<?php echo e($question->proposition_c_fr); ?>" required>
						</div>
					</div>

					<div class="form-group<?php echo e($errors->has('proposition_2') ? ' has-error' : ''); ?>">
						<label for="proposition_2" class="col-md-4 control-label">Mauvaise réponse 1</label>

						<div class="col-md-4">
							<input id="proposition_2" type="text" class="form-control" name="proposition_2" value="<?php echo e($question->proposition_b_fr); ?>" required>
						</div>
					</div>

					<div class="form-group<?php echo e($errors->has('proposition_3') ? ' has-error' : ''); ?>">
						<label for="proposition_3" class="col-md-4 control-label">Mauvaise réponse 2</label>

						<div class="col-md-4">
							<input id="proposition_3" type="text" class="form-control" name="proposition_3" value="<?php echo e($question->proposition_a_fr); ?>" required>
						</div>
					</div>
				
				<?php endif; ?>
				
				
			</div> 
			
			
			<div class="line line-lg pull-in"></div>
			
			<div class="actions pull-right"> 
				<button type="reset" class="btn btn-danger btn-sm">Annuler</button> 
				<button type="submit" class="btn btn-primary btn-sm">Enregistrer</button> 
			</div>
			
		</form>
		
		 
	
	</div>
	
	
	
	
	
</div>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>