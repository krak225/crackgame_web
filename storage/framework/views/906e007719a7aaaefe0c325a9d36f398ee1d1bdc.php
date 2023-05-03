<!DOCTYPE html>
<html lang="fr" class=" ">
<head> 
	<meta charset="utf-8" />
	<title><?php echo e(config('app.title')); ?></title>
	<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	<link rel="stylesheet" href="<?php echo e(asset('css/font.css')); ?>" type="text/css" /> 
	<link rel="stylesheet" href="<?php echo e(asset('js/datatables/datatables.css')); ?>" type="text/css"/> 
	<link rel="stylesheet" href="<?php echo e(asset('css/app.v1_vert.css')); ?>" type="text/css" /> 
	<link rel="stylesheet" href="<?php echo e(asset('js/fuelux/fuelux.css')); ?>" type="text/css"/>	
	<link rel="stylesheet" href="<?php echo e(asset('css/crackgame.css')); ?>" type="text/css"/>	
	<link rel="stylesheet" href="<?php echo e(asset('css/animations.css')); ?>" type="text/css"/>	
	<link rel="stylesheet" href="<?php echo e(asset('css/tabs.css')); ?>" type="text/css"/>	
	<!--[if lt IE 9]> 
	<script src="js/ie/html5shiv.js"></script> 
	<script src="js/ie/respond.min.js"></script> 
	<script src="js/ie/excanvas.js"></script> 
	<![endif]-->
	<style type="text/css">
	<!-- 
		.btn-mauvaise_reponse, .btn-mauvaise_reponse:hover{
			background:red;
		}
		
		.btn-bonne_reponse{

			animation: clignoteSuccess 0.5s infinite;
			
		}

		.btn-bon_score{

			animation: clignoteSuccess 0.5s 10;
			
		}


		.btn-mauvais_score{

			animation: clignoteError 0.5s 10;
			
		}


		@keyframes  animation1 { 
			0%   { z-index:-1; }
			100% { z-index:1; } 
		}

		@-webkit-keyframes clignoteError {
			0%{background:rgba(255,0,0,0)}
			100%{background:rgba(255,0,0,1)}
		}
		@-webkit-keyframes clignoteSuccess {
			0%{background:rgba(0,255,0,0)}
			100%{background:rgba(0,255,0,1)}
		}
		
	-->
	</style>
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	
</head>
<body class=""> 
	<section class="container-fluid">
	
		<div class="header row">
			
			
			
			<div class="row">
				<div class="col-md-12">
					
					<div class="col-md-12">
					
						<ul id="nav_top" class="nav navbar-nav navbar-left m-n hidden-xs nav-user pull-right"> 
							<?php if(auth()->guard()->check()): ?> 
							<li class="dropdown"> 
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
								<img src="<?php echo e(asset('images/flags/'. str_replace('en','gb',Auth::user()->lang_code.'.png'))); ?>" style="height:20px;"/>
								<?php echo e(Auth::user()->lang_libelle); ?>

								<b class="caret"></b> 
								</a> 
								<ul class="dropdown-menu animated fadeInRight"> 
									<span class="arrow top"></span> 
									<?php if(Auth::user()->lang_code == 'en'): ?>
									<li> <a href="<?php echo e(route('setlanguage','fr')); ?>">Français</a> </li> 
									<?php else: ?>
									<li> <a href="<?php echo e(route('setlanguage','en')); ?>">Anglais</a> </li> 
									<?php endif; ?>
								</ul> 
							</li>	

							<li class="statut_abonnement" style="width:50px;">
								<?php if(Auth::user()->statut_abonnement == 'ACTIVE'): ?>
									<a href="#" style="display:block;">
										<span class="abonnement_active"></span>
									</a>
								<?php else: ?>
									<a href="#" style="display:block;">
										<span class="abonnement_inactive"></span>
									</a>
								<?php endif; ?>
							</li>
							<li>
								<?php if(File::exists('images/avatars/'. Auth::user()->photo ) && !is_dir('images/avatars/'. Auth::user()->photo)): ?>
									<img src="<?php echo e(asset('images/avatars/'. Auth::user()->photo )); ?>" alt="" style="width:20px;margin-top:7px;"/>
									<?php else: ?>
									<img src="<?php echo e(asset('images/avatars/1.jpg')); ?>" alt="" style="width:20px;margin-top:7px;"/>
								<?php endif; ?>
							</li>
							<li>
								<a href="#"> 
									<?php echo e(Auth::user()->pseudo); ?>

								 </a>	
							</li>
							<li>
								<a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
									Déconnexion
								</a>
								<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
									<?php echo e(csrf_field()); ?>

								</form>
							</li>
						<?php else: ?>
							<li>
								<a href="<?php echo e(route('register')); ?>"> 
									Inscrivez-vous
								 </a>	
							</li>
							<li>
								<a href="<?php echo e(route('login')); ?>">
									Se connecter
								</a>
							</li>
						
						<?php endif; ?>
						</ul>
						 
					</div>
                </div>
			</div>
			
			
			<div class="row container-fluid" id="top_bar">
				
               <div class="col-md-2 visible-xs">
				   <div class="navbar-header aside-md" style="background:white;color:orange;"> 
					<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html" style="color:green"> 
					<i class="fa fa-bars"></i> 
					</a> 
					<a href="<?php echo e(route('home')); ?>" class="navbar-brand  visible-xs" style="font-size:12px;background:white;color:orange">
					CRACKGAME
					</a>
					
					<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user" style="color:green"> 
					<i class="fa fa-cog"></i> 
					</a> 
				</div> 
               </div>
			   
               <div class="col-md-2 hidden-xs">
					<div class="col-md-2">
					</div>
					<div class="col-md-10">
					<a href="<?php echo e(route('home')); ?>" class=" hidden-xs">
						<img class="img-responsive" src="<?php echo e(asset('images/logo.png')); ?>" style="width:100px;margin-top:10px;"/>
					</a>
					</div>
               </div>
			   
               <div class="col-md-10" id="statData">
				 <?php if(auth()->guard()->check()): ?>
                 <div class="col-md-2 box row" ><span class="legend">TOTAL<br/></span><span class="valeur"><?php echo e(Auth::user()->total_points_duel); ?></span><br/> <span class="legend">POINTS</span></div>
                 <div class="col-md-2 box row"><a href="<?php echo e(route('jocker_question')); ?>"><span class="legend">TOTAL<br/></span><span class="valeur"><?php echo e(Auth::user()->jocker_question); ?></span><br/> <span class="legend">JOCKER QUESTION</span></a></div>
                 <div class="col-md-2 box row" ><span class="legend">AUJOURD'HUI<br/></span><span class="valeur red bold"><?php echo e(Stdfn::getTodayCagnotte()); ?></span><br/> <span class="legend">A GAGNER</span></div>
                 <div class="col-md-2 box row" ><span class="legend">TOTAL<br/></span><span class="valeur"><?php echo e(Auth::user()->jocker_duel); ?></span><br/> <span class="legend">JOKERS DUEL</span></div>
                 <div class="col-md-2 box row" ><a href="<?php echo e(route('souscription')); ?>"><span class="legend">TOTAL<br/></span><span class="valeur"><?php echo e(Auth::user()->souscription); ?></span><br/> <span class="legend">SOUSCRIPTION</span></a></div>
                 <div class="col-md-2 box row" >
					<span class="legend">
					</span>
					<span class="my_money" style="padding:5px 0px;display:block;font-weight:bold;"><i class="fa fa-moneyD"></i>
					<?php echo e(Auth::user()->devise . ' ' . number_format(Auth::user()->money, 0, '.', ' ')); ?>

					</span>
					<span class="legend depot_retrait"><a href="<?php echo e(route('depot')); ?>">Dépot</a> | <a href="<?php echo e(route('retrait')); ?>">Retrait</a></span>
				</div>
				 <?php endif; ?>
			   </div>
			   
           </div>
		
		</div>
		
		<header class="bg-primary header navbar navbar-fixed-top-xs text-center container-fluid"> 
			<nav class="container">
	 
			 <ul id="top_menu" class="nav navbar-nav hidden-xs" style="margin:auto;width:100%;"> 
				
				<li>
					<a href="<?php echo e(route('home')); ?>">Accueil</a>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown" href="?controller=compte&action=index">Mon compte <b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInRight">
						<span class="arrow top"></span>
						<li><a href="<?php echo e(route('profile')); ?>">Identité</a></li>
						<li class="dropdown"><a class="dropdown-toggle dker" data-toggle="dropdown"  href="">Questionnaire</a>
							<ul class="dropdown-menu animated fadeInRight">
								<li><a href="<?php echo e(route('addquestion')); ?>">Soumettre</a></li>
								<li><a href="<?php echo e(route('questions')); ?>"> Voir </a></li>
								<li><a href="<?php echo e(route('questions','1')); ?>">Quiz duel</a></li>
								<li><a href="<?php echo e(route('questions','1')); ?>">Quiz chap</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a class="dropdown-toggle dker" data-toggle="dropdown"  href="#">Transaction</a>
							<ul class="dropdown-menu animated fadeInRight">
								<li><a href="<?php echo e(route('depots')); ?>">Dépots</a></li>
								<li><a href="<?php echo e(route('retraits')); ?>"> Retraits</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a class="dropdown-toggle dker" data-toggle="dropdown"  href="#">Opérations</a>
							<ul class="dropdown-menu animated fadeInRight">
								<li><a href="<?php echo e(route('souscriptions')); ?>">Souscriptions</a></li>
								<li><a href="<?php echo e(route('jockers')); ?>">Jocker question</a></li>
								<!--li><a href="<?php echo e(route('ConversionPoint')); ?>"> Conversion point</a></li-->
							</ul>
						</li>

						<li><a href="<?php echo e(route('invites')); ?>">Mes invités</a></li>
						<li><a href="<?php echo e(route('bonus')); ?>">Mes Bonus</a></li>
					</ul>
				</li>


				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown" href="#"> Jeu <b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInLeft">
						<span class="arrow top"></span>
						<li><a href=""> Recompense </a></li>
						<li><a href="<?php echo e(route('classements')); ?>"> Classements </a></li>
						<li class="dropdown"><a class="dropdown-toggle dker" data-toggle="dropdown"  href="#">Duels </a>
							<ul class="dropdown-menu animated fadeInRight">
								<li><a href="<?php echo e(route('duels','encours')); ?>">Duels en cours</a></li>
								<li><a href="<?php echo e(route('duels','termines')); ?>"> Duels Terminés </a></li>
							</ul>
						</li>

						<li><a href="<?php echo e(route('duels')); ?>">Jouer</a></li>
						<li><a href="<?php echo e(route('comment_jouer')); ?>">Comment jouer</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown" href="#"> Test de connaissance <b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInLeft">
						<span class="arrow top"></span>
						<li><a href="<?php echo e(route('aide')); ?>">Aide</a></li>
						<li><a href="<?php echo e(route('records')); ?>">Records</a></li>
						<li><a href="<?php echo e(route('categorie_test')); ?>">Jouer</a></li>	
					</ul>

				</li>

				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown" href="#"> Quiz chap <b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInLeft">
						<span class="arrow top"></span>
						<li><a href="<?php echo e(route('chapencours')); ?>">Jouer</a></li>	
						<li><a href="<?php echo e(route('chaps')); ?>">Afficher tout</a></li>	
					</ul>

				</li>

				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown"  href="">Conversion	<b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInRight">
						<span class="arrow top"></span>
						<li><a href="<?php echo e(route('ConversionPoint')); ?>">Conversion de point</a></li>
						<li><a href="<?php echo e(route('ConversionDevise')); ?>">Conversion de devise</a></li>
						<!--li><a href="#"> securité </a></li-->
					</ul>
				</li>


				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown"  href="?controller=gagnant&action=tout">Gagnants	
					<b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInRight">
						<span class="arrow top"></span>
						<li><a href="<?php echo e('gagnants'); ?>">De la semaine</a></li>
						<li><a href="<?php echo e('gagnants'); ?>">Du mois</a></li>
						<li><a href="<?php echo e('gagnants'); ?>"> Tous les gagnans </a></li>
					</ul>
				</li>
			 </ul> 
			</nav> 
		 </header> 
	
		 
		 <section class="container-fluid"> 
			<section class="hbox stretch"> 
				<!-- .aside --> 
				<aside class="bg-dark aside-md hidden-print hidden-xs hidden" id="nav"> 
					<section class="vbox"> 
						<!--dheader class="header bg-primary lter text-center clearfix"> 
							<iv class="btn-group"> 
								<button type="button" class="btn btn-sm btn-dark btn-icon"><i class="fa fa-bars"></i></button> 
								<div class="btn-group hidden-nav-xs"> 
									<span  class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown"> MENU PRINCIPAL </span> 
								</div> 
							</div> 
						</header--> 
						<section class="w-f scrollable"> 
							<div class=" " data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333"> 
							<!-- nav --> 
							<nav class="nav-primary hidden-xs"> 
								
							</nav> 
							<!-- / nav --> 
							</div> 
						</section> 
						<footer class="footer lt hidden-xs b-t b-dark"> 
							
						</footer>
						
					</section> 
					</aside> 
					<!-- /.aside --> 
					<section id="content">
					 
						
						<section class="scrollable padder"> 
							
							
							<!----> 
							
							<?php echo $__env->yieldContent('content'); ?>
							
							<!----> 
							
							
							<script src="<?php echo e(URL::asset('js/event_listener.js')); ?>"></script>
	
	
						</section>
						
						
					</section> 
					
					<aside class="bg-light lter b-l aside-md hide" id="notes"> 
						<div class="wrapper"></div> 
					</aside> 
					
					
			</section> 
		</section> 
		
	</section> 
	 
	
	<section class="footer" id="footer"> 
		&copy; 2018 CRACKGAME 
	</section> 
	
  
	 <!-- Bootstrap --> 
	 <!-- App --> 
	 <script src="<?php echo e(asset('js/app.v1.js')); ?>"></script> 
	 <script src="<?php echo e(asset('js/datatables/jquery.dataTables.min.js')); ?>"></script>
	 <script src="<?php echo e(asset('js/datatables/jquery.csv-0.71.min.js')); ?>"></script>
	 <script src="<?php echo e(asset('js/kraksoft.js')); ?>"></script> 
	 <script src="<?php echo e(asset('js/app.plugin.js')); ?>"></script> 
	 
	 <!-- fuelux -->
	 <script src="<?php echo e(asset('js/fuelux/fuelux.js')); ?>"></script>
	 <script src="<?php echo e(asset('js/parsley/parsley.min.js')); ?>"></script>
	 
	 
	<script src="<?php echo e(asset('js/jquery.mask.js')); ?>"></script>
	 
	 
	<script src="<?php echo e(asset('js/noty/jquery.noty.js')); ?>"></script>
	<script src="<?php echo e(asset('js/noty/layouts/bottomCenter.js')); ?>"></script>
	<script src="<?php echo e(asset('js/noty/layouts/topRight.js')); ?>"></script>
	<script src="<?php echo e(asset('js/noty/layouts/top.js')); ?>"></script>
	<script src="<?php echo e(asset('js/noty/layouts/center.js')); ?>"></script>
	<script src="<?php echo e(asset('js/noty/themes/default.js')); ?>"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			
			var csrf_token   =   $('meta[name="csrf-token"]').attr('content');
			$.ajaxSetup({
				headers: {"X-CSRF-TOKEN": csrf_token}
			});
			
		});
	</script>
	

	<input type="hidden" id="eco_base_url" value="<?php echo e('http://'.$_SERVER['HTTP_HOST'].'/'); ?>">
	<input type="hidden" id="lang" value="fr">
	
	<?php if(auth()->guard()->check()): ?>
	<input type="hidden" id="my_user_id" value="<?php echo e(Auth::user()->id); ?>">
	<?php endif; ?>
	
 </body>
</html>