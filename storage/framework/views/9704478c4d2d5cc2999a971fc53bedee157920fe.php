<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Mes duels</li> 
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

<?php if(Session::has('invitation-envoye')): ?>
	
<?php endif; ?>

<div class="m-b-md"> 
	<h3 class="m-b-none">Liste des duels</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des duels et demandes de duels <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="5%">Réf</th>
					<th width="20%">Adversaire</th>
					<th width="20%">Scores</th>
					<th width="20%">Résultat</th>
					<th width="20%">Date</th>
					<th width="5%">Statut</th>
					<th width="5%">Actions</th>
				</tr> 
			</thead> 
			<tbody>
			<?php $__currentLoopData = $duels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $duel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<?php 
					
					$vainqueur = null;
					$user1_score = Stdfn::getScoreDuel($duel->duel_id,$duel->user_id);
					$user1		 = Stdfn::getUserDuel($duel->duel_id,$duel->user_id);
					$user2_score = Stdfn::getScoreDuel($duel->duel_id,$duel->adversaire_id);
					$user2		 = Stdfn::getUserDuel($duel->duel_id,$duel->adversaire_id);
					
					if($duel->user_id == Auth::user()->id){
						$mon_score 			= $user1_score;
						$score_adversaire   = $user2_score;
						$adversaire_pseudo 	= $user2;
					}else{
						$mon_score 			= $user2_score;
						$score_adversaire 	= $user1_score;
						$adversaire_pseudo 	= $user1;
					}
					
					/*
					if($mon_score > $score_adversaire ){
						$vainqueur = 'Gagné';
					}else if($mon_score == $score_adversaire ){
						$vainqueur = 'Egalité';
					}else{
						$vainqueur = 'Perdu';
					}
					*/

					if($duel->duel_vainqueur_id == 0){

						$vainqueur = 'Egalité';

					}else{

						$vainqueur = ($duel->duel_vainqueur_id == Auth::user()->id )? 'Gagné' : 'Perdu';

					}


				?>
				<tr>
					<td><?php echo e($duel->duel_id); ?></td>
					<td><?php echo e(ucfirst($adversaire_pseudo)); ?></td>
					<td><?php echo e(Stdfn::getScoreDuel($duel->duel_id,$duel->user_id) .' - '. Stdfn::getScoreDuel($duel->duel_id,$duel->adversaire_id)); ?></td>
					<td><?php echo e($vainqueur); ?></td>
						<td><?php echo e(Stdfn::dateTimeFromDB($duel->duel_date_creation)); ?></td>
					<td><?php echo e($duel->duel_statut); ?></td>
					<td>
					<?php if(Auth::user()->id == $duel->adversaire_id): ?>
						<?php if($duel->duel_statut=='VALIDE'): ?>
							<a href="<?php echo e(route('JouerDuel',[$duel->duel_id,$duel->user_id] )); ?>">Jouer</a>
						<?php elseif($duel->duel_statut=='BROUILLON'): ?>
							<a href="<?php echo e(route('RejoindreDuel',$duel->duel_id )); ?>">Accepter</a>
						<?php endif; ?>
					<?php else: ?>
						<?php if($duel->duel_statut=='VALIDE' || $duel->duel_statut=='EN COURS'): ?><a href="<?php echo e(route('JouerDuel',[$duel->duel_id,$duel->adversaire_id] )); ?>">Jouer</a>
						<?php elseif($duel->duel_statut=='BROUILLON'): ?> <a href="#">En attente</a>
						<?php elseif($duel->duel_statut=='TERMINE'): ?> <a href="#"></a>
						<?php else: ?><a href="#">En attente</a><?php endif; ?>
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