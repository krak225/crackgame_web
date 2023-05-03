<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Ajout des questions</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Formulaire d'ajout des questions</h3> 
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
		<form enctype="multipart/form-data"  method="post" class="form-horizontal" action="<?php echo e(route('SaveQuestion')); ?>">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
					
				<div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
					<label for="question_" class="col-md-4 control-label">Question</label>

					<div class="col-md-4">
						<input placeholder="160 caractères maximum" maxlength="200" id="question_" type="text" class="form-control" name="question" value="<?php echo e(old('question')); ?>" required autofocus>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('proposition_1') ? ' has-error' : ''); ?>">
					<label for="proposition_1" class="col-md-4 control-label">Bonne réponse</label>

					<div class="col-md-4">
						<input id="proposition_1" type="text" class="form-control" name="proposition_1" value="<?php echo e(old('proposition_1')); ?>" required>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('proposition_2') ? ' has-error' : ''); ?>">
					<label for="proposition_2" class="col-md-4 control-label">Mauvaise réponse 1</label>

					<div class="col-md-4">
						<input id="proposition_2" type="text" class="form-control" name="proposition_2" value="<?php echo e(old('proposition_2')); ?>" required>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('proposition_3') ? ' has-error' : ''); ?>">
					<label for="proposition_3" class="col-md-4 control-label">Mauvaise réponse 2</label>

					<div class="col-md-4">
						<input id="proposition_3" type="text" class="form-control" name="proposition_3" value="<?php echo e(old('proposition_3')); ?>" required>
					</div>
				</div>

				<!--div class="form-group<?php echo e($errors->has('proposition_3') ? ' has-error' : ''); ?>">
					<label for="proposition_correcte" class="col-md-4 control-label">Proposition Correcte</label>

					<div class="col-md-4">
						<select id="proposition_correcte" class="form-control" name="reponse" required>
							<option value=""></option>
							<option value="A">Proposition 1</option>
							<option value="B">Proposition 2</option>
							<option value="C">Proposition 3</option>
						</select>
					</div>
				</div-->

				
			</div> 
			
			
			<div class="line line-lg pull-in"></div>
			
			<div class="actions pull-right"> 
				<button type="reset" class="btn btn-danger btn-sm">Annuler</button> 
				<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button> 
			</div>
			
		</form>
		
		 
	
	</div>
	
	
	
	
	
</div>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>