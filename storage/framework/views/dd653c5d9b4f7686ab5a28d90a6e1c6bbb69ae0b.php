<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('home')); ?>"> Conversion</a></li>  
	<li class="active">Conversion de devise</li> 
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
	<h3 class="m-b-none">Faire une conversion de devise</h3> 
</div>


<div class=" panel panel-default wizard" style="padding:5px;">
 
	<div class="col-md-6 panel panel-default wizard"> 

		<div class="wizard-steps clearfix row" id="form-wizard"> 
			<ul class="steps"> 
				<li data-target="#step1" class=" "><span class="badge"><i class="fa fa-edit"></i></span> Formulaire de conversion</li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
		
			<form method="post" class="form-horizontal" action="<?php echo e(route('ConversionDevise')); ?>">
				
				<?php echo csrf_field(); ?>

				
				<div class="step-pane active" id="step1">
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Devise actuel:</label> 
						<div class="col-sm-7">
							<input type="text" name="devise_actuel" class="form-control" disabled required > 
						</div> 
					</div> 
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Devise à convertir:</label> 
						<div class="col-sm-7">
							<input type="text" name="objet" class="form-control" required > 
						</div> 
					</div> 
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Montant obtenu</label> 
						<div class="col-sm-7">
							<input type="text" id="montant_obtenu" class="form-control" disabled> 
						</div> 
					</div> 
					
				</div> 
				
				<div class="line line-lg pull-in"></div>
				
				<div class="actions pull-right"> 
					
					<button type="reset" class="btn btn-info btn-sm">Annuler</button> 
					<button type="submit" class="btn btn-primary btn-sm">Convertir</button> 
					
				</div> 
				
			</form>
				
		</div>
		
		
	</div>

	<div class="col-md-6 panel panel-default wizard pull-right" style="border-left:0px;"> 
		
		<div class="wizard-steps clearfix row"> 
			<ul class="steps"> 
				<li data-target="#step2"><span class="badge"><i class="fa fa-book"></i></span> Règles de conversion </li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
			<p>
			La conversion de devise est une opération qui consiste à convertir vos gains obtenus au cours des Tests de connaissance que vous avez joué, en monaie électronique 	
			</p>
			<p>
			Avant de pouvoir effectuer cette oppération, vous devez avoir "Acitvé" votre souscription du jour. 
			</p>
		</div>
		
		
	</div>
	
	<div class="clearfix"></div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>