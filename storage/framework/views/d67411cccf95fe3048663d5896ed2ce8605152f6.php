<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Chap-chap</li> 
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
	<h3 class="m-b-none">Jeux chap-chap</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des jeux chap-chap
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="5%">Réf</th>
					<th width="15%">Date</th>
					<th width="10%">Participants</th>
					<th width="10%">Etape</th>
					<th width="10%">Statut</th>
					<!--th width="20%">Résultat</th-->
					<th width="10%">Résultats</th>
					<th width="5%">Actions</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $chaps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<tr>
					<td><?php echo e($chap->chap_id); ?></td>
					<td><?php echo e(Stdfn::dateTimeFromDB($chap->chap_date_creation)); ?></td>
					<td><?php echo e($chap->chap_participants); ?></td>
					<td><?php echo e($chap->chap_etape); ?></td>
					<td><?php echo e($chap->chap_statut); ?></td>
					<!--td><?php if($chap->chap_vainqueur_id == Auth::user()->id): ?> <?php echo e('Gagné'); ?> <?php elseif($chap->chap_vainqueur_id != ''): ?><?php echo e('Perdu'); ?> <?php elseif($chap->chap_vainqueur_id == ''): ?><?php echo e('en attente'); ?> <?php endif; ?></td-->
					<td>
						<a href="<?php echo e(route('ResultatsChap',[$chap->chap_id] )); ?>">Afficher les résultats</a>
					</td>		
					<td>		
					<?php if(Auth::user()->id == $chap->adversaire_id): ?>
						<?php if($chap->chap_statut=='VALIDE'): ?>
							<a href="<?php echo e(route('Jouerchap',[$chap->chap_id,$chap->user_id] )); ?>">Jouer</a>
						<?php elseif($chap->chap_statut=='BROUILLON'): ?>
							<a href="<?php echo e(route('Rejoindrechap',$chap->chap_id )); ?>">Accepter</a>
						<?php endif; ?>
					<?php else: ?>
						<?php if($chap->chap_statut=='VALIDE' || $chap->chap_statut=='EN COURS'): ?><a href="<?php echo e(route('Jouerchap',[$chap->chap_id] )); ?>">Jouer</a>
						<?php elseif($chap->chap_statut=='BROUILLON'): ?> <a href="#">En attente</a>
						<?php elseif($chap->chap_statut=='TERMINE'): ?> <a href="#"></a>
						<?php endif; ?>
					<?php endif; ?>
					</td>
				</tr>	
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody> 
		</table> 
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>