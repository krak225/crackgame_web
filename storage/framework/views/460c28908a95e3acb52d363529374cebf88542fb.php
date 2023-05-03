<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Mon compte</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Modifier mon avatar</h3> 
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
		
		<form method="post" class="form-horizontal" action="<?php echo e(route('UpdatePhoto')); ?>">
			
			<?php echo csrf_field(); ?>

			
			<div class="step-pane active" id="step1" style="padding-top:20px;padding-bottom:20px;"> 
			
				<div class="col-md-12"> 
					
					<?php $__currentLoopData = $avatars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $avatar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-sm-1 col-md-1 padder-v b-r b-light"> 
						<span class="fa-stack fa-1x m-r-sm"> 
							<img src="<?php echo e(asset('images/avatars/'.$avatar)); ?>" style="width:100%"> 
						</span>
						<?php if($avatar == Auth::user()->photo): ?>
						<input type="radio" name="photo" value="<?php echo e($avatar); ?>" checked>
						<?php else: ?>
						<input type="radio" name="photo" value="<?php echo e($avatar); ?>">
						<?php endif; ?>
					</div> 
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
				</div> 
				
				<div class="col-md-12"> 
				
					<button type="submit" class="btn btn-primary btn-sm">Enregistrer </button> 
				
				</div>
				
				<br style="clear:both;"/>
				
			</div>

		</form>
		
	</div>
	
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>