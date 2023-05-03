<?php $__env->startSection('content'); ?>

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Gagnants</li> 
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
	<h3 class="m-b-none">Gagnants</h3> 
</div>

<section class="panel panel-default"> 
		
	<div class="tabs-wrap">
		<header class="panel-heading" style="padding:0px;height:auto;">
			<ul class="absolute-tabs sections-show" style="border:0px;">
				<li class="col-md-4"><a data-absolutetab-num="1" data-absolutetab="#absolutetab-tab-1" href="#" class="active">Gagnants de la semaine</a></li>
				<li class="col-md-4"><a data-absolutetab-num="2" data-absolutetab="#absolutetab-tab-2" href="#">Gagnants du mois</a></li>
				<li class="col-md-4"><a data-absolutetab-num="3" data-absolutetab="#absolutetab-tab-3" href="#">Tous les gagnants</a></li>
			</ul>
		</header> 
            <div class="absolute-tab-cont">
                <p data-absolutetab-num="1" class="absolute-tab-mob active" data-absolutetab="#absolutetab-tab-1">Gagnants de la semaine</p>
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
							
							</tbody> 
						</table> 
					</div> 
					
					</div>
                </div>
				
                <p data-absolutetab-num="2" class="absolute-tab-mob" data-absolutetab="#absolutetab-tab-2">Gagnants du mois</p>
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
								
								</tbody> 
							</table> 
						</div> 
					
					</div>
                </div>
				
                <p data-absolutetab-num="3" class="absolute-tab-mob" data-absolutetab="#absolutetab-tab-3">Tous les gagnants</p>
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