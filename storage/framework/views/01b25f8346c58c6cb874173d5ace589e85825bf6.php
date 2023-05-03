<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Classements</li> 
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
	<h3 class="m-b-none">Classements</h3> 
</div>

<section class="panel panel-default"> 
		
	<div class="tabs-wrap">
		<header class="panel-heading" style="padding:0px;height:auto;">
			<ul class="absolute-tabs sections-show" style="border:0px;">
				<li class="col-md-4"><a data-absolutetab-num="1" data-absolutetab="#absolutetab-tab-1" href="#" class="active">Par meilleures points de duel</a></li>
				<li class="col-md-4"><a data-absolutetab-num="2" data-absolutetab="#absolutetab-tab-2" href="#">Par nombre de duels joués</a></li>
				<li class="col-md-4"><a data-absolutetab-num="3" data-absolutetab="#absolutetab-tab-3" href="#">Par nombre de duels gagnés</a></li>
			</ul>
		</header> 
            <div class="absolute-tab-cont">
                <p data-absolutetab-num="1" class="absolute-tab-mob active" data-absolutetab="#absolutetab-tab-1">Par Meilleures points de duel</p>
                <div class="absolute-tab" id="absolutetab-tab-1">
                    <div class="absolute-tab-inner">
                      
					<div class="table-responsive"> 
						<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
							<thead> 
								<tr> 
									<th width="20%">Rang</th> 
									<th width="20%">Pseudo</th> 
									<th width="10%">Points obtenus</th>
								</tr> 
							</thead> 
							<tbody>
							<?php $rang = 0;?>
							<?php $__currentLoopData = $users_duels_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php $rang++;
								$rang_libelle = ($rang==1)? ' er' : ' ème';
								?>
								<tr>
									<td><?php echo e($rang.$rang_libelle); ?></td> 
									<td><?php echo e($user->pseudo); ?></td> 
									<td><?php echo e($user->total_points_duel); ?></td> 
								</tr>	
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody> 
						</table> 
					</div> 
					
					</div>
                </div>
				
                <p data-absolutetab-num="2" class="absolute-tab-mob" data-absolutetab="#absolutetab-tab-2">Par Nombre de duels joués</p>
                <div class="absolute-tab" id="absolutetab-tab-2">
                    <div class="absolute-tab-inner">
                    
						<div class="table-responsive"> 
							<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
								<thead> 
									<tr> 
										<th width="20%">Rang</th> 
										<th width="20%">Pseudo</th> 
										<th width="10%">Duels joués</th>
									</tr> 
								</thead> 
								<tbody>
								<?php $rang = 0;?>
								<?php $__currentLoopData = $users_duels_joues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php $rang++;
									$rang_libelle = ($rang==1)? ' er' : ' ème';
									?>
									<tr>
										<td><?php echo e($rang.$rang_libelle); ?></td> 
										<td><?php echo e($user->pseudo); ?></td> 
										<td><?php echo e($user->duels_joues); ?></td> 
									</tr>	
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody> 
							</table> 
						</div> 
					
					</div>
                </div>
				
                <p data-absolutetab-num="3" class="absolute-tab-mob" data-absolutetab="#absolutetab-tab-3">Par Nombre de duels gagnés</p>
                <div class="absolute-tab" id="absolutetab-tab-3">
                    <div class="absolute-tab-inner">
                      
						<div class="table-responsive"> 
							<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
								<thead> 
									<tr> 
										<th width="20%">Rang</th> 
										<th width="20%">Pseudo</th> 
										<th width="10%">Duels gagnés</th>
									</tr> 
								</thead> 
								<tbody>
								<?php $rang = 0;?>
								<?php $__currentLoopData = $users_duels_gagnes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php $rang++;
									$rang_libelle = ($rang==1)? ' er' : ' ème';
									?>
									<tr>
										<td><?php echo e($rang.$rang_libelle); ?></td> 
										<td><?php echo e($user->pseudo); ?></td> 
										<td><?php echo e($user->duels_gagnes); ?></td> 
									</tr>	
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody> 
							</table> 
						</div> 
					
					</div>
                </div>
            </div>
        </div>

        
	
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>