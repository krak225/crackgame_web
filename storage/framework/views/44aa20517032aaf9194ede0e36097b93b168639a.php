<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="<?php echo e(route('categorie_test')); ?>"> Test de connaissance</a></li>  
	<li class="active"><?php echo e($categorie->categorie_libelle); ?></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Test de connaissance</h3> 
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


<div class="panel panel-default page_test_connaissance" id="page_jeu"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class=""> 
			<li class="active col-md-6" data-target="#step3"><span class="badge"></span>Catégorie : <?php echo e(strtoupper($categorie->categorie_libelle)); ?> <input type="hidden" id="categorie_id" value="<?php echo e($categorie->categorie_id); ?>"></li>
			<li class="active col-md-6" data-target="#step3"><span class=""><span class="badged">Total des points: </span><span class="badge bg-warning"><?php echo e(number_format(Auth::user()->total_points_test,0,'.',' ')); ?></span></li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<div id="ESPACEDEJEU">
			
			<div class="col-md-2 text-center"> 
				
				<div class=" " style="margin:auto;">
					<?php if(File::exists('images/'. Auth::user()->photo ) && !is_dir('images/'. Auth::user()->photo)): ?>
					<img class="rounded center" src="<?php echo e(asset('images/avatar.jpg')); ?>" style="margin: auto;width: 75px;" />
					<img class="rounded center" src="<?php echo e(asset('images/'. Auth::user()->BDN_AYANT_DROIT_PHOTO )); ?>" alt="" style="margin: auto;" />
					<?php else: ?>
					<img class="rounded center" src="<?php echo e(asset('images/avatar.jpg')); ?>" style="margin: auto;width: 75px;" />
					<?php endif; ?>
				</div>

				<div class="col-md-12 ">
					<div class="player_name"> <?php echo e(Auth::user()->pseudo); ?></div>
					
					<div class="actions "> 
						<!--button id="myScore" type="button" class="btn btn-warning btn-sm circle"><span id="score">0</span></button--> 
						<div class="label_score">Score</div>
						<div id="myScore">
							<span id="score">0</span>
						</div>
					</div>
					
					<hr />
				</div>

				<div class="actions"> 
					<input type="hidden" id="entrainement_id"/>
					<input type="hidden" id="type_jeu" value="TEST"/>
					<button id="btnStartGame" type="button" class="btn btn-info btn-sm pause"><i class="fa fa-play"></i> Démarer le test</button> 
				</div>
				
				
			</div> 
			
			<div class="col-md-8 text-center"> 
				
				<div id="jeu"> 
					
					<div id="StartView" style="display:none"> 
						<div style="padding:90px 0px;">
							<h4>Test de connaissance en <?php echo e($categorie->categorie_libelle); ?></h4>
							<div><?php echo e($categorie->categorie_description); ?></div>
							<div style="margin:20px auto;width:200px;border-top:1px dotted #ddd;"></div>
							<div>Cliquez sur Démarer le test pour commencer à jouer</div>
						</div> 
					</div>
					
					<div id="LoadingView" style="display:none"> 
						<div style="padding:130px 0px;">
							<h4>Démarage en cours...</h4>
							<div>Veuillez patienter!</div>
						</div> 
					</div>
					
					<div id="PauseView" style="display:none"> 
						<div style="padding:130px 0px;">
							<h1><i class="fa fa-pause"></i> PAUSE</h1>
							<div>Vous avez mis le jeu en pause!</div>
						</div> 
					</div> 
					
					<div id="GameView" style="display:none"> 
						
						<div class="col-md-12" id="questionBox" style="height:70px;"> 
							<div id="boxCptQuestion" style="display:none;height:1px;"> <span id="cptQuestion0"></span>: </div> 
							<div id="question" style="border-top:0px;padding:10px;font-size:18px;"> 
								
							</div>
						</div>
						
						<br style="clear:both;"/>
						
						<div class="line"></div>
						
						<div class="col-md-12 text-left row" style="min-height:155px;border:0px solid red"> 
							<div id="propositionBox"> 
								<form id="formPropositions" method="post"> 
									<input id="question_id" type="hidden" name="question_id">
									<ul class="listePropositions" style="padding:0px;"> 
										<li class="btn btn-gray2 btn-sm btn-proposition" id="btnA" for="checkA"><label><input id="checkA" type="radio" name="reponse" class="reponse" value="A"/> <span id="propositionA" >A</span></label></li>
										<li class="btn btn-gray2 btn-sm btn-proposition" id="btnB" for="checkB"><label><input id="checkB" type="radio" name="reponse" class="reponse" value="B"/> <span id="propositionB" >B</span></label></li>
										<li class="btn btn-gray2 btn-sm btn-proposition" id="btnC" for="checkC"><label><input id="checkC" type="radio" name="reponse" class="reponse" value="C"/> <span id="propositionC" >C</span></label></li>
										<li class="btn btn-gray2 btn-sm btn-proposition" id="btnNA" style="display:none;"><label><input type="radio" name="reponse" class="reponse" value="NA" id="no_answer"><span id="propositionNA" >NA</span></label></li>
									</ul>
								</form>
							</div>
						</div>
						
						<br style="clear:both;"/>
						
						<div class="line"></div>
						
						<div class="actions" style="min-height:35px;"> 
							<!--button type="button" class="btn btn-warning btn-sm"><?php echo e($TXT_JE_PASSE); ?></button--> 
							<button id="btnConfirmerReponse" type="button" class="btn btn-primary btn-sm" disabled><i class="fa fa-check"></i><?php echo e($TXT_CONFIRMER_MA_REPONSE); ?></button> 
						</div>
						
						<br style="clear:both;"/>
						
					</div> 
				</div> 
				
				
			</div>
			
			<div class="col-md-2 text-center"> 
				<div class="label_chrono">Chrono</div>
				<div id="chrono"></div>
				
				<hr/>
				
				<div id="vies">
					<span id="vie3" class="btn vie"></span>
					<span id="vie2" class="btn vie"></span>
					<span id="vie1" class="btn vie"></span>
				</div>
			
			</div> 
			
		</div>
		
	
	</div>
	
	
	
	
</div>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>