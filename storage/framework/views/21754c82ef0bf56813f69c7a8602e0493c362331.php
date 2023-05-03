

<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Création de compte</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Création de compte</h3> 
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
<style type="text/css">.control-label{text-align: left;}</style>
<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3"><span class="badge"></span>Informations</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form enctype="multipart/form-data"  method="post" class="form-horizontal" id="formRegister" action="<?php echo e(route('register')); ?>">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1"> 
			
				
				<div class="col-md-5"> 
					<!--div class="header">Informations du compte</div--> 
							

					<div class="form-group<?php echo e($errors->has('pseudo') ? ' has-error' : ''); ?>">
						<label for="pseudo" class="col-md-5 control-label">Pseudo <span class="text text-danger">*</span></label>

						<div class="col-md-7">
							<input id="pseudo" type="text" class="form-control" name="pseudo" value="<?php echo e(old('pseudo')); ?>" required>

							<?php if($errors->has('pseudo')): ?>
								<span class="help-block">
									<strong><?php echo e($errors->first('pseudo')); ?></strong>
								</span>
							<?php endif; ?>
						</div>
					</div>


					<div class="form-group<?php echo e($errors->has('telephone') ? ' has-error' : ''); ?>">
						<label for="telephone" class="col-md-5 control-label">Téléphone <span class="text text-danger">*</span></label>

						<div class="col-md-7">
							<div class="input-group m-b">
							<span class="input-group-addon" id="indicatif">+225</span>
							<input id="telephone" type="text" class="form-control telephone" name="telephone" value="<?php echo e(old('telephone')); ?>" required>
							</div>
							<?php if($errors->has('telephone')): ?>
								<span class="help-block">
									<strong><?php echo e($errors->first('telephone')); ?></strong>
								</span>
							<?php endif; ?>
						</div>
					</div>

				</div>

				<div class="col-md-5"> 
					<!--div class="header">Informations du compte</div--> 
						
					<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
						<label for="password" class="col-md-5 control-label">Mot de passe <span class="text text-danger">*</span></label>

						<div class="col-md-7">
							<input id="password" type="password" class="form-control" name="password" required>

							<?php if($errors->has('password')): ?>
								<span class="help-block">
									<strong><?php echo e($errors->first('password')); ?></strong>
								</span>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group">
						<label for="password-confirm" class="col-md-5 control-label">Confirmer mot de passe <span class="text text-danger">*</span></label>

						<div class="col-md-7">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						</div>
					</div>
					
				</div>
					
				
			</div> 
			
			
			
			<div class="col-md-12"> 
				
				<div class="line line-lg pull-in"></div>
			
				<div class="actions pull-right"> 
					<input type="hidden" name="profil_id" value="2"> 
					<button type="reset" class="btn btn-warning btn-sm">Annuler</button> 
					<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button> 
				</div>
			</div>
			
		</form>
		
		 
	
	</div>
	
	
	
	
	
</div>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>