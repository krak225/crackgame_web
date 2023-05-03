

<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active"> Mon compte</a></li>
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Mon compte</h3> 
</div>

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


<section class="panel panel-default"> 
	<!--header class="panel-heading"> Mon profil utilisateur</header--> 
	
	<div class="panel-body" id="page_profil">
		
		<div class="row">
			<div class="col-md-4 text-center">
				<div class="row">
					<div class="col-md-12 lead">Photo du profil</div>
				</div>
				<div class="wrapper">
					<div class="panel wrapper panel-info">
						<div class="text-center bg-info">
							<?php if(File::exists('images/avatars/'. $user->photo ) && !is_dir('images/avatars/'. $user->photo) ): ?>
							<img class="col-md-12 rounded img-responsive"
							src="<?php echo e(asset('images/avatars/'. $user->photo )); ?>">
							<?php else: ?>
							<img class="col-md-12 rounded img-responsive" src="<?php echo e(asset('images/avatars/1.jpg')); ?>"/>
							<?php endif; ?>
						</div>
						<!--div class="col-md-12 text-center">
							<h4><?php echo e($user->nom .' '. $user->prenoms); ?></h4>
						</div-->
						<div class="row">
							<a href="<?php echo e(route('update_photo')); ?>" class="rounded btn btn-sm btn-warning">Modifier la photo</a>
							<br style="clear:both;"/> 
						</div> 
					</div> 
					
					
				</div>
				
			</div>
			
			<div class="col-md-4 bordered">
				<div class="row">
					<div class="col-md-12 lead">Données personnelles</div>
				</div>
				
				<div class="list-group radius"> 
					<span class="list-group-item"> 
						<span class="badge"><?php echo e($user->nom); ?></span> 
						<i class="fa fa- icon-muted"></i> Nom 
					</span>
					<span class="list-group-item"> 
						<span class="badge"><?php echo e($user->prenoms); ?></span> 
						<i class="fa fa- icon-muted"></i> Prénoms 
					</span>
					<span class="list-group-item"> 
						<span class="badge"><?php echo e($user->sexe); ?></span> 
						<i class="fa fa- icon-muted strong"></i> Sexe 
					</span>
					<span class="list-group-item"> 
						<span class="badge"><?php echo e($user->adresse); ?></span> 
						<i class="fa fa- icon-muted strong"></i> Adresse 
					</span>
					<span class="list-group-item"> 
						<span class="badge"><?php echo e($user->telephone); ?></span> 
						<i class="fa fa- icon-muted strong"></i> Téléphone 
					</span>
					<span class="list-group-item"> 
						<span class="badge"><?php echo e(Stdfn::paysNom($user->pays_origine_id)); ?></span> 
						<i class="fa fa- icon-muted"></i> Pays d'origine
					</span>
					<span class="list-group-item"> 
						<span class="badge"><?php echo e(Stdfn::paysNom($user->pays_residence_id)); ?></span> 
						<i class="fa fa- icon-muted"></i> Pays de résidence
					</span>
					<span class="list-group-item" href="#"> 
						<span class="badge"><?php echo e($user->ville); ?></span> 
						<i class="fa fa- icon-muted"></i> Ville 
					</span> 
					<span class="list-group-item" href="#"> 
						<span class="badge"><?php echo e(Stdfn::dateFromDB($user->date_naissance)); ?></span> 
						<i class="fa fa- icon-muted"></i> Date naissance 
					</span> 
					<span class="list-group-item" href="#"> 
						<span class="pull-right"><a href="<?php echo e(route('update_perso')); ?>" class="rounded btn btn-sm btn-warning">Modifier</a></span> 
						<i class="fa fa- icon-muted"></i>
						<br style="clear:both;"/>
					</span> 
				</div>
				
			</div>
			
			
			<div class="col-md-4 bordered">
				<div class="row">
					<div class="col-md-12 lead">Données du compte</div>
				</div>
				
				<div class="list-group radius"> 
					<span class="list-group-item"> 
						<span class="badge"><?php echo e($user->pseudo); ?></span> 
						<i class="fa fa- icon-muted"></i> Pseudo 
					</span>
					<span class="list-group-item"> 
						<span class="badge"><?php echo e($user->adresse_email); ?></span> 
						<i class="fa fa- icon-muted"></i> E-mail
					</span>
					<span class="list-group-item" href="#"> 
						<span class="badge"><?php echo e($user->devise); ?></span> 
						<i class="fa fa- icon-muted"></i> Monaie 
					</span> 
					<span class="list-group-item"> 
						<span class="badge"><?php echo e($user->lang_libelle); ?></span> 
						<i class="fa fa- icon-muted"></i> Langue 
					</span>
					<span class="list-group-item"> 
						<span class="badge"><?php echo e($user->communaute); ?></span> 
						<i class="fa fa- icon-muted strong"></i> Communauté 
					</span>
					<span class="list-group-item" href="#"> 
						<span class="badge"><?php echo e($user->parrain); ?></span> 
						<i class="fa fa- icon-muted"></i> Parain 
					</span> 
					<span class="list-group-item" href="#"> 
						<span class="badge"><?php echo e($user->statut_matrice); ?></span> 
						<i class="fa fa- icon-muted"></i> Statut 
					</span>
					<span class="list-group-item" href="#"> 
						<span class="badge"><?php echo e(Stdfn::dateFromDB($user->created_at)); ?></span> 
						<i class="fa fa- icon-muted"></i> Date inscription 
					</span>
					<span class="list-group-item" href="#"> 
						<span class="badge"><?php echo e($user->date_matrice); ?></span> 
						<i class="fa fa- icon-muted"></i> Date matrice 
					</span>
					<span class="list-group-item" href="#"> 
						<span class="pull-right"><a href="<?php echo e(route('update_compte')); ?>" class="rounded btn btn-sm btn-warning">Modifier</a></span> 
						<i class="fa fa- icon-muted"></i>
						<br style="clear:both;"/>
					</span> 					
				</div>
				
			</div>
			
			
		</div>
		
		
	</div>
	
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>