<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="<?php echo e(route('home')); ?>"> Opérations</a></li>  
	<li class="active">Achat de souscription</li> 
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
	<h3 class="m-b-none">souscription</h3> 
</div>


<div class=" panel panel-default wizard" style="padding:5px;">
 
	<div class="col-md-6 panel panel-default wizard"> 

		<div class="wizard-steps clearfix row" id="form-wizard"> 
			<ul class="steps"> 
				<li data-target="#step1" class=" "><span class="badge"><i class="fa fa-edit"></i></span> Formulaire d'achat de souscription</li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
			
			<form id="formDepot" method="post" class="form-horizontal" action="<?php echo e(route('SaveSouscription')); ?>">
				
				<?php echo csrf_field(); ?>

				
				<div class="step-pane active" id="step1">
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Acheter pour:</label> 
						<div class="col-sm-7">
							<div class="col-sm-12">
								<input type="radio" name="pour_qui" class="pour_qui" value="moi" checked required> 
								Moi-même
							</div>
							<div class="col-sm-12">
								<input type="radio" name="pour_qui" class="pour_qui" value="ami" required> 
								Un ami
							</div> 
						</div> 
					</div> 
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Nombre de souscription:</label> 
						<div class="col-sm-7">
							<select id="quantite_souscription" name="quantite" class="form-control"required >
								<option value="">Choisir</option>
								<option value="1">1 souscription (<?php echo e(1 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="2">2 souscriptions (<?php echo e(2 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="3">3 souscriptions (<?php echo e(3 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="4">4 souscriptions (<?php echo e(4 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="5">5 souscriptions (<?php echo e(5 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="6">6 souscriptions (<?php echo e(6 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="7">7 souscriptions (<?php echo e(7 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="8">8 souscriptions (<?php echo e(8 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="9">9 souscriptions (<?php echo e(9 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="10">10 souscriptions (<?php echo e(10 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="15">15 souscriptions (<?php echo e(15 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="20">20 souscriptions (<?php echo e(20 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="25">25 souscriptions (<?php echo e(25 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="30">30 souscriptions (<?php echo e(30 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="35">35 souscriptions (<?php echo e(35 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="40">40 souscriptions (<?php echo e(40 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="45">45 souscriptions (<?php echo e(45 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
								<option value="50">50 souscriptions (<?php echo e(50 * number_format($frais_souscription_duel,2,'.','') . ' ' . $devise); ?> )</option>
							</select>
						</div> 
					</div> 
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Montant:</label> 
						<div class="col-sm-7">
							<input type="text" id="montant_souscription" name="montant" class="form-control" readonly required > 
						</div> 
					</div> 
					
					
					<div class="form-group" id="box_pseudo_ami" style="display:none;">
						<label class="col-sm-5 control-label">Pseudo de votre ami:</label> 
						<div class="col-sm-7">
							<input type="text" id="pseudo_ami" name="pseudo_ami" class="form-control" > 
						</div> 
					</div> 
					
					
				</div> 
				
				<div class="line line-lg pull-in"></div>
				
				<div class="actions pull-right"> 
					
					<button type="reset" class="btn btn-info btn-sm">Annuler</button> 
					<button type="submit" class="btn btn-primary btn-sm">Acheter</button> 
					
				</div> 
				
			</form>
				
		</div>
		
		
	</div>

	<div class="col-md-6 panel panel-default wizard pull-right" style="border-left:0px;"> 
		
		<div class="wizard-steps clearfix row"> 
			<ul class="steps"> 
				<li data-target="#step2"><span class="badge"><i class="fa fa-book"></i></span> Consignes </li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
			<p>
			
			</p>
		</div>
		
		
	</div>
	
	<div class="clearfix"></div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>