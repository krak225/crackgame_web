<?php $__env->startSection('content'); ?>
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Quiz chap-chap</li>
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Quiz chap-chap</h3> 
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


<div class="panel panel-default page_chap" id="page_jeu"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class=""> 
			<li class="active col-md-4" data-target="#step3"><span class="badge"></span>Chap-chap N° <?php echo e($chap->chap_id); ?></li>
			<li class="active col-md-4 text-center" data-target="#step3"><span class="badge" style="font-size: 24px;font-weight: bold;margin-top: 5px;">NIVEAU <?php echo e($chap->chap_etape); ?></span></li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<div id="ESPACEDEJEU">
			
			<div class="col-md-3 text-center" style="padding:0px;"> 
				
				<div class="bloc_name">Questions</div>
					
				<div id="boxMesQuestions" class="row" style="height:300px;overflow:auto;">
					<?php $i=0;//print_r($question->question_id);die(); ?>
					<?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $i++;?>
					<button 
					<?php if(!Stdfn::isUsedInChap($question->chap_id,$question->question_id)): ?>
						class="question_to_choose btn btn-warning btn-sm"
						data-id="<?php echo e($question->question_id); ?>" 
						data-question="<?php echo e($question->question); ?>"
						data-propositionA="<?php echo e($question->propositionA); ?>"
						data-propositionB="<?php echo e($question->propositionB); ?>"
						data-propositionC="<?php echo e($question->propositionC); ?>"
						data-question="<?php echo e($question->question_fr); ?>"
					<?php else: ?>
						class="btn btn-gray btn-sm question_used"
					<?php endif; ?>
					title="<?php echo e($question->question); ?>"
					>Q <?php echo e($question->id); ?></button>
					
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
					
				<div class="actions"> 
					<input type="hidden" id="entrainement_id"/>
					<button <?php if($my_chap_statut == 'TERMINE'): ?> <?php echo e(' disabled '); ?> <?php endif; ?> id="btnConfirmerQuestionChap" type="button" class="btn btn-info btn-sm pause"><i class="fa fa-play"></i> Répondre à cette question</button> 
				</div>
				
				
				
			</div> 
			
			<div class="col-md-7 text-center"> 
				
				<div id="jeu"> 
					
					<?php if($my_chap_statut == 'TERMINE'): ?>
						
						<div id="EndView"> 
							<div style="padding:130px 0px;">
								<h1><i class="fa fa-stop"></i> FIN</h1>
								<div id="texte_fin">Votre score est: <b><?php echo e($my_chap_score); ?></b></div>
							</div> 
						</div>
						
					<?php else: ?>
					<div id="StartView" style="display:none"> 
						<div style="padding:90px 0px;">
							<h4>Quiz chap N°<?php echo e($chap->chap_id); ?></h4>
							<div>Crée le <?php echo e(Stdfn::datetimefromdb($chap->chap_date_creation)); ?></div>
							<div style="margin:20px auto;width:200px;border-top:1px dotted #ddd;"></div>
							<div>Choisissez la question à laquelle vous voulez répondre</div>
						</div> 
					</div>
					
					<div id="PauseView" style="display:none"> 
						<div style="padding:130px 0px;">
							<h1><i class="fa fa-pause"></i> PAUSE</h1>
							<div>Vous avez mis le jeu en pause!</div>
						</div> 
					</div> 
					
					<div id="EndView" style="display:none"> 
						<div style="padding:130px 0px;">
							<h1><i class="fa fa-stop"></i> FIN</h1>
							<div id="texte_fin">Votre score est: <b><?php echo e($my_chap_score); ?></b></div>
						</div> 
					</div> 
					
					<div id="InfoView" style="display:none"> 
						<div style="padding:130px 30px;">
							<h2 id="infoTexte">
								Welcome on crackgame!
							</h2>
						</div> 
					</div> 
					
					<div id="GameView" style="display:none;"> 
						
						<div class="col-md-12" id="boxQuestion"> 
							
							<table class="table table-striped m-b-none datatable " style="display:none;">
								<tbody class="messages">	
								</tbody>	
							</table>
							
							<div id="questionAuthor"> 
								
							</div>
							
							<input type="hidden" id="chap_id" value="<?php echo e($chap->chap_id); ?>"> 
							<input type="hidden" id="question_id"> 
							<div class="col-md-12" id="questionBox" style="height:70px;"> 
								<div id="boxCptQuestion" style="display:none;height:1px;"> <span id="cptQuestion0"></span>: </div> 
								<div id="question" style="border-top:0px;padding:10px;font-size:18px;"> 
									
								</div>
							</div>
							
						</div>
						
						<div id="boxDetailsQuestion" style="display:none;font-weight:bold;font-size:20px;" >
							Détails d'une question
						</div>
						
						<div id="boxPropositions">
						
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
											<li class="btn btn-gray2 btn-sm " id="btnNA" style="display:none;"><label><input type="radio" name="reponse" class="reponse" value="NA" id="no_answer"><span id="propositionNA" >NA</span></label></li>
										</ul>
									</form>
								</div>
							</div>
								
							<br style="clear:both;"/>
							
						</div> 
						
						<div class="line"></div>
						
						<div id="ActionView" class="actions" style="min-height:35px;">
							<button id="btnConfirmerReponseChap" style="display:none;" type="button" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> VALIDER LA RÉPONSE</button> 
						</div>
							
					</div> 
					
					<br style="clear:both;"/>
						
					<?php endif; ?>

				</div> 
				
				</div> 
				
				
			</div>
			
			<div class="col-md-2 text-center"> 
				
				<?php if(File::exists('images/'. Auth::user()->photo ) && !is_dir('images/'. Auth::user()->photo)): ?>
				<img class="col-md-12 img-responsive rounded" src="<?php echo e(asset('images/'. Auth::user()->BDN_AYANT_DROIT_PHOTO )); ?>" alt=""/>
				<?php else: ?>
				<img class="col-md-12 img-responsive rounded" src="<?php echo e(asset('images/avatar.jpg')); ?>"/>
				<?php endif; ?>
				
				<div class="player_name"> <?php echo e(Auth::user()->pseudo); ?></div>
				<input type="hidden" id="my_user_id" value="<?php echo e(Auth::user()->id); ?>"/>
				<input type="hidden" id="my_user_pseudo" value="<?php echo e(Auth::user()->pseudo); ?>"/>
				
				<div class="actions "> 
					<div class="label_score">Score</div>
					<div id="myScore">
						<span id="score"><?php echo e($my_chap_score); ?></span>
					</div>
				</div>
				
				<hr />
				
				<div class="label_chrono">Chrono</div>
				<div id="chrono"></div>
				
			
			</div> 
			
			
			
		</div>
		
	
	</div>
	
	
</div>


<script src="<?php echo e(URL::asset('js/app_crackgame_chap.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>