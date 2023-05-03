<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Duelistes connectés</li> 
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
	<h3 class="m-b-none">Liste des duelistes connectés</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des duelistes connectés <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	<div class="panel-body"> 
		<div class="table-responsive"> 
			<table class="table datatable table-striped m-b-none" id="statistiques"> 
				<thead> 
					<tr> 
						<th width="">Pseudo</th>
						<th width="">Duels</th>
						<th width="">Victoires</th>
						<th width="">Meilleur score</th>
						<th width="">Actions</th>
					</tr> 
				</thead> 
				<tbody>
				<?php if(!empty($users)): ?>
				 <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($user->id != Auth::user()->id): ?>
					<tr> 
						<td> 
							<a href="<?php echo e(route('CreerDuel',$user->id)); ?>" > 
								 <span><?php echo e($user->pseudo); ?></span> 
							 </a> 
						 </td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>
							<?php if(Auth::user()->statut_abonnement == 'ACTIVE'): ?>
							<!--a href="<?php echo e(route('CreerDuel',$user->id)); ?>" > 
								<span>Inviter</span> 
							</a-->
							<?php endif; ?>
							<?php if(Auth::user()->statut_abonnement == 'ACTIVE'): ?>
							<span class="btnSendInvitation btn" data-to_user_id="<?php echo e($user->id); ?>" > 
								<span>Inviter</span> 
							</span>
							<?php endif; ?>
						</td>
					 </tr>
					 <?php endif; ?>
				 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				 <?php endif; ?>
				</tbody> 
			</table> 
		</div>  
	</div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>