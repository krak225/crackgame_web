<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Ouverture de session</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Réinitialiser mon mot de passe</h3> 
</div>


<section class="panel panel-default"> 
	<div class="row m-l-none m-r-none bg-light lter">
	
		<header class="panel-heading text-center"> 
			<strong>Réinitialiser mon mot de passe</strong> 
		</header> 

		<?php if(session('status')): ?>
		<div class="alert alert-success">
			<?php echo e(session('status')); ?>

		</div>
		<?php endif; ?>

		<form class="form-horizontal" method="POST" action="<?php echo e(route('password.email')); ?>">
			<?php echo e(csrf_field()); ?>


			<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
				<label for="email" class="col-md-4 control-label">Adresse e-mail</label>

				<div class="col-md-6">
					<input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

					<?php if($errors->has('email')): ?>
						<span class="help-block">
							<strong><?php echo e($errors->first('email')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<button type="submit" class="btn btn-primary">
						Réinitialiser
					</button>
				</div>
			</div>
		</form>
		
	</div>
	
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>