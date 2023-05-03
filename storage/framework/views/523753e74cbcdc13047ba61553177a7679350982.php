<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Mon compte</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Modifier mes données personnelles</h3> 
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
		
		<form method="post" class="form-horizontal" action="<?php echo e(route('UpdatePerso')); ?>">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1" style="padding-top:20px"> 
			
				<div class="form-group<?php echo e($errors->has('nom') ? ' has-error' : ''); ?>">
					<label for="nom" class="col-md-4 control-label">Nom <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="nom" type="text" class="form-control" name="nom" value="<?php echo e($user->nom); ?>" required autofocus>

						<?php if($errors->has('nom')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('nom')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('prenoms') ? ' has-error' : ''); ?>">
					<label for="prenoms" class="col-md-4 control-label">Prénoms <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="prenoms" type="text" class="form-control" name="prenoms" value="<?php echo e($user->prenoms); ?>" required>

						<?php if($errors->has('prenoms')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('prenoms')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group<?php echo e($errors->has('date_naissance') ? ' has-error' : ''); ?>">
					<label for="date_naissance" class="col-md-4 control-label">Date de naissance <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="date_naissance" type="date" class="form-control" name="date_naissance" value="<?php echo e($user->date_naissance); ?>" required>

						<?php if($errors->has('date_naissance')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('date_naissance')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				
				<!--div class="form-group<?php echo e($errors->has('lieu_naissance') ? ' has-error' : ''); ?>">
					<label for="lieu_naissance" class="col-md-4 control-label">Lieu de naissance <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="lieu_naissance" type="text" class="form-control" name="lieu_naissance" value="<?php echo e($user->user_LIEU_NAISSANCE); ?>" required>

						<?php if($errors->has('lieu_naissance')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('lieu_naissance')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div-->
				
				<div class="form-group<?php echo e($errors->has('sexe') ? ' has-error' : ''); ?>">
					<label for="sexe" class="col-md-4 control-label">Sexe <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="sexe" class="form-control" name="sexe"  required>
							<option></option>
							<option <?php if($user->sexe == "Masculin"): ?> selected <?php endif; ?> value="Masculin">Masculin</option>
							<option <?php if($user->sexe == "Feminin"): ?> selected <?php endif; ?> value="Feminin">Feminin</option>
						</select>
						
						<?php if($errors->has('sexe')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('sexe')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('sexe') ? ' has-error' : ''); ?>">
					<label for="sexe" class="col-md-4 control-label">Pays d'origine <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="sexe" class="form-control" name="pays_origine_id"  required>
							<option></option>
							<?php $__currentLoopData = $pays_origine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pays): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							
							<?php if($pays->pays_id == $user->pays_origine_id): ?>{ 
								<?php $selected = ' selected '; ?>
							<?php else: ?>
								<?php $selected = '  '; ?>
							<?php endif; ?>
							
							<option <?php echo e($selected); ?> value="<?php echo e($pays->pays_id); ?>"><?php echo e($pays->pays_nom_fr); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>

						<?php if($errors->has('quartier_id')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('quartier_id')); ?></strong>
							</span>
						<?php endif; ?>
						</select>
						
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('sexe') ? ' has-error' : ''); ?>">
					<label for="sexe" class="col-md-4 control-label">Pays de résidence <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="sexe" class="form-control" name="pays_residence_id"  required>
							<option></option>
							<?php $__currentLoopData = $pays_residence; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pays): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							
							<?php if($pays->pays_id == $user->pays_residence_id): ?>{ 
								<?php $selected = ' selected '; ?>
							<?php else: ?>
								<?php $selected = '  '; ?>
							<?php endif; ?>
							
							<option <?php echo e($selected); ?> value="<?php echo e($pays->pays_id); ?>"><?php echo e($pays->pays_nom_fr); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>

						
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('ville') ? ' has-error' : ''); ?>">
					<label for="ville" class="col-md-4 control-label">Ville <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="ville" type="text" class="form-control" name="ville" value="<?php echo e($user->ville); ?>" required style="padding-top:0px;">

						<?php if($errors->has('ville')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('ville')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('adresse') ? ' has-error' : ''); ?>">
					<label for="adresse" class="col-md-4 control-label">Adresse <span class="text text-danger">&nbsp;<span></label>

					<div class="col-md-4">
						<input id="adresse" type="text" class="form-control" name="adresse" value="<?php echo e($user->adresse); ?>">

						<?php if($errors->has('adresse')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('adresse')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('code_postal') ? ' has-error' : ''); ?>">
					<label for="code_postal" class="col-md-4 control-label">Code postale <span class="text text-danger">&nbsp;<span></label>

					<div class="col-md-4">
						<input id="code_postal" type="text" class="form-control" name="code_postal" value="<?php echo e($user->code_postal); ?>">

						<?php if($errors->has('code_postal')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('code_postal')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="form-group<?php echo e($errors->has('telephone_mobile') ? ' has-error' : ''); ?>">
					<label for="telephone_mobile" class="col-md-4 control-label">Téléphone <span class="text text-danger">*<span></label>

					<div class="col-md-4">
					
						<div class="input-group m-b">
						<span class="input-group-addon">+225</span>
						<input id="telephone_mobile" type="text" class="form-control" name="telephone" value="<?php echo e(str_replace('+225','',$user->telephone)); ?>" required>
						</div>
						<?php if($errors->has('telephone_mobile')): ?>
							<span class="help-block">
								<strong><?php echo e($errors->first('telephone_mobile')); ?></strong>
							</span>
						<?php endif; ?>
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