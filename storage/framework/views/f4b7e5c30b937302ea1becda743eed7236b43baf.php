<?php $__env->startSection('content'); ?>

			<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
			<li class="active"><i class="fa fa-dashboard "></i> Tableau de bord</li>
			</ul> 
			<div class="m-b-md"> 
			<h3 class="m-b-none">Tableau de bord</h3>
			</div> 
			
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

			<section class="panel panel-default"> 
				<div class="row m-l-none m-r-none bg-light lter"> 
				
				<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
					<?php if(Auth::user()->statut_abonnement == 'ACTIVE'): ?>
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
						<i class="fa fa-circle fa-stack-2x text-success"></i> 
						<i class="fa fa-check fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="#"> 
						<span class="h3 block m-t-xs"><strong class="text-success">DISPONIBLE</strong></span> 
						<small class="text-muted text-uc">STATUT DUEL</small> 
					</a> 
					<?php else: ?>
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
						<i class="fa fa-circle fa-stack-2x text-danger"></i> 
						<i class="fa fa-times fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="<?php echo e(route('sabonner')); ?>"> 
						<span class="h3 block m-t-xs"><strong class="text-danger">INDISPONIBLE</strong></span> 
						<small class="text-muted text-uc">STATUT DUEL</small> 
					</a>
					<?php endif; ?>
				</div> 
				
				<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
					<?php if(Auth::user()->statut_abonnement_chap == 'ACTIVE'): ?>
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
						<i class="fa fa-circle fa-stack-2x text-success"></i> 
						<i class="fa fa-check fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="#"> 
						<span class="h3 block m-t-xs"><strong class="text-success">ACTIVÉ</strong></span> 
						<small class="text-muted text-uc">STATUT CHAP</small> 
					</a> 
					<?php else: ?>
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
						<i class="fa fa-circle fa-stack-2x text-danger"></i> 
						<i class="fa fa-times fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="<?php echo e(route('sabonner_chap')); ?>"> 
						<span class="h3 block m-t-xs"><strong class="text-danger">DESACTIVÉ</strong></span> 
						<small class="text-muted text-uc">STATUT CHAP</small> 
					</a>
					<?php endif; ?>
				</div> 
								
				<div class="col-sm-8 col-md-4 padder-v b-r b-light"> 
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
						<i class="fa fa-circle fa-stack-2x text-info"></i> 
						<i class="fa fa-users fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="<?php echo e(route('duels')); ?>"> 
						<span class="h3 block m-t-xs"><strong><?php echo e($nombre_duels); ?></strong></span> 
						<small class="text-muted text-uc">DUELS</small> 
					</a> 
				</div> 
				
				
				</div> 
			</section>

			<div class="row"> 
			
				<div class="col-md-8"> 
					
					
					<section class="panel panel-default"> 
						<header class="panel-heading font-bold"> LES DUELISTES CONNECTÉS  <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
						<a href="<?php echo e(route('duelistes')); ?>"> 
							 <span class="label label-success pull-right" style="font-weight:normal">Afficher tout</span> 
						</a> 
						</header> 
						<div class="panel-body"> 
							<input type="hidden" id="my_user_id" value="<?php echo e(Auth::user()->id); ?>"/>
							<div class="table-responsive"> 
								<table class="table table-striped m-b-none" id="statistiques"> 
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
									<?php if(isset($duelistes_connectes)): ?>
									 <?php $__currentLoopData = $duelistes_connectes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($user->id != Auth::user()->id): ?>
										<tr> 
											<td>
												<span><?php echo e(ucfirst($user->pseudo)); ?></span> 
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
						<footer class="panel-footer bg-white no-padder"> 
							<div class="row text-center no-gutter">
							
								
							</div> 
						</footer> 
					</section>

					
					
				</div> 
			
				<div class="col-md-4"> 
				
					<section class="panel panel-default"> 
						<header class="panel-heading font-bold">
							TOP VAINQUEURS
						</header> 
						<div class="panel-body"> 
							<div id="flot-1ine" style="height:90px"></div> 
						</div> 
						<footer class="panel-footer bg-white no-padder"> 
							
						</footer> 
					</section> 
					
				</div> 
				
			</div> 
			
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>