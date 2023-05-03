<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Mon compte</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Modifier mes données du compte</h3> 
</div>


<section class="panel panel-default"> 
	<div class="row m-l-none m-r-none bg-light lter">
	
		<?php if(session('message')): ?>
		<div class="alert alert-success">
			<?php echo e(session('message')); ?>

		</div>
		<?php endif; ?>
		
		<?php if(session('warning')): ?>
		<div class="alert alert-warning">
			<?php echo e(session('warning')); ?>

		</div>
		<?php endif; ?>
		
		<form method="post" class="form-horizontal" action="<?php echo e(route('UpdateCompte')); ?>">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1" style="padding-top:20px"> 
			
				<div class="form-group<?php echo e($errors->has('pseudo') ? ' has-error' : ''); ?>">
					<label for="pseudo" class="col-md-4 control-label">Pseudo <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input readonly id="pseudo" type="text" class="form-control" name="pseudo" value="<?php echo e($user->pseudo); ?>" required autofocus>

						<?php if($errors->has('pseudo')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('pseudo')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('adresse_email') ? ' has-error' : ''); ?>">
					<label for="adresse_email" class="col-md-4 control-label">E-mail <span class="text text-danger" id="adresse_email">&nbsp;<span></label>

					<div class="col-md-4">
						<input id="adresse_email" type="email" class="form-control" name="adresse_email" value="<?php echo e($user->adresse_email); ?>" required>

						<?php if($errors->has('adresse_email')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('adresse_email')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				
				<div class="form-group<?php echo e($errors->has('devise') ? ' has-error' : ''); ?>">
					<label for="devise" class="col-md-4 control-label">Monaie <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="devise" class="form-control" name="devise"  required>
							<option></option>
							<option <?php if($user->devise == "USD"): ?> selected <?php endif; ?> value="USD">USD</option>
							<option <?php if($user->devise == "EUR"): ?> selected <?php endif; ?> value="EUR">Euro</option>
							<option <?php if($user->devise == "FCFA"): ?> selected <?php endif; ?> value="FCFA">FCFA</option>
						</select>
						
						<?php if($errors->has('devise')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('devise')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				
				<div class="form-group<?php echo e($errors->has('langue') ? ' has-error' : ''); ?>">
					<label for="langue" class="col-md-4 control-label">Langue <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="langue" class="form-control" name="lan_code"  required>
							<option></option>
							<option <?php if($user->lang_code == "fr"): ?> selected <?php endif; ?> value="fr">Français</option>
							<option <?php if($user->lang_code == "en"): ?> selected <?php endif; ?> value="en">Anglais</option>
						</select>
						
						<?php if($errors->has('langue')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('langue')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				
			
				<div class="form-group<?php echo e($errors->has('communaute') ? ' has-error' : ''); ?>">
					<label for="communaute" class="col-md-4 control-label">Communauté <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="communaute" class="form-control" name="communaute"  required>
							<option></option>
							<option value="Experts">Experts</option>
							<option value="Génies">Génies</option>
							<option value="Pro">Pro</option>
						</select>
						
						<?php if($errors->has('communaute')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('communaute')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="form-group">
					<label for="parrain" class="col-md-4 control-label">Parrain</label>

					<div class="col-md-4">
						<input id="parrain" type="parrain" class="form-control" name="parrain" placeholder="Pseudo du parrain" value="<?php echo e(Auth::user()->parrain); ?>">
					</div>
				</div>
				
				<div class="col-md-12" style="padding-bottom:15px;"> 
					
					<div class="line line-lg pull-in"></div>
				
					<div class="actions pull-right"> 
						<input type="hidden" name="profil_id" value="2"> 
						<button type="reset" class="btn btn-warning btn-sm">Annuler</button> 
						<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button> 
					</div>
					
				
				</div>
				
			</div>
				
				
		</form>
		
	</div>
	
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>