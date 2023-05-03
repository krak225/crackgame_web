<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Test de connaissance</li>  
	<li class="active">Choix d'une catégorie</li>  
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Choisir une catégorie</h3> 
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

	<section class="panel panel-default" style="padding:10px;"> 
		<div class="row m-l-none m-r-none bg-light lter" style="border:none;"> 
			<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-3 " style="border:1px solid #ddd;padding:10px;"> 
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-question-circle fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="<?php echo e(route('entrainement',$categorie->categorie_id)); ?>"> 
					<span class="block m-t-uc"><strong><?php echo e($categorie->categorie_libelle); ?></strong></span> 
					<small class="text-muted"><?php echo e($categorie->categorie_description); ?></small> 
					</a> 
				</div> 
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
		</div> 
	</section>

			
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>