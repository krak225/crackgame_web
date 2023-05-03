<!DOCTYPE html>
<html lang="fr" class=" ">
<head> 
	<meta charset="utf-8" />
	<title>{{ config('app.title') }}</title>
	<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	<link rel="stylesheet" href="{{ asset('css/font.css') }}" type="text/css" /> 
	<link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}" type="text/css"/> 
	<link rel="stylesheet" href="{{ asset('css/app.v1_vert.css') }}" type="text/css" /> 
	<link rel="stylesheet" href="{{ asset('js/fuelux/fuelux.css')}}" type="text/css"/>	
	<link rel="stylesheet" href="{{ asset('css/crackgame.css')}}" type="text/css"/>	
	<link rel="stylesheet" href="{{ asset('css/animations.css')}}" type="text/css"/>	
	<link rel="stylesheet" href="{{ asset('css/tabs.css')}}" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('js/flipclock/flipclock.min.css')}}" type="text/css"/>	
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


		@keyframes animation1 { 
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
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
</head>
<body class=""> 
	<section class="container-fluid">
	
		<div class="header row">
			
			
			
			<div class="row">
				<div class="col-md-12">
					
					<div class="col-md-12">
					
						<ul id="nav_top" class="nav navbar-nav navbar-left m-n hidden-xs nav-user pull-right"> 
							@auth
							
							<li class="dropdown"> 
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
								<img src="{{asset('images/flags/'. str_replace('en','gb',Auth::user()->lang_code.'.png'))}}" style="height:20px;"/>
								{{Auth::user()->lang_libelle}}
								<b class="caret"></b> 
								</a> 
								<ul class="dropdown-menu animated fadeInRight"> 
									<span class="arrow top"></span> 
									@if(Auth::user()->lang_code == 'en')
									<li> <a href="{{ route('setlanguage','fr') }}">Français</a> </li> 
									@else
									<li> <a href="{{ route('setlanguage','en') }}">Anglais</a> </li> 
									@endif
								</ul> 
							</li>	
							
							<li class="statut_abonnement" style="width:50px;">
								@if(Auth::user()->statut_abonnement == 'ACTIVE')
									<a href="#" style="display:block;">
										<span class="abonnement_active"></span>
									</a>
								@else
									<a href="#" style="display:block;">
										<span class="abonnement_inactive"></span>
									</a>
								@endif
							</li>
							<li>
								@if(File::exists('images/avatars/'. Auth::user()->photo ) && !is_dir('images/avatars/'. Auth::user()->photo))
									<img src="{{ asset('images/avatars/'. Auth::user()->photo ) }}" alt="" style="width:20px;margin-top:7px;"/>
									@else
									<img src="{{ asset('images/avatars/1.jpg') }}" alt="" style="width:20px;margin-top:7px;"/>
								@endif
							</li>
							<li>
								<a href="#"> 
									{{ Auth::user()->pseudo }}
								 </a>	
							</li>
							<li>
								<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
									Déconnexion
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						@else
							<li>
								<a href="{{ route('register') }}"> 
									Inscrivez-vous
								 </a>	
							</li>
							<li>
								<a href="{{ route('login') }}">
									Se connecter
								</a>
							</li>
						
						@endauth
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
					<a href="{{route('home')}}" class="navbar-brand  visible-xs" style="font-size:12px;background:white;color:orange">
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
					<a href="{{route('home')}}" class=" hidden-xs">
						<img class="img-responsive" src="{{asset('images/logo.png')}}" style="width:100px;margin-top:10px;"/>
					</a>
					</div>
               </div>
			   
               <div class="col-md-10" id="statData">
				 @auth
                 <div class="col-md-2 box row" ><span class="legend"><br/></span><span class="valeur">{{Auth::user()->total_points_duel}}</span><br/> <span class="legend">POINTS</span></div>
                 <!--div class="col-md-2 box row"><a href="{{route('jocker_question')}}"><span class="legend"><br/></span><span class="valeur">{{Auth::user()->jocker_question}}</span><br/> <span class="legend">JOCKER QUESTION</span></a></div-->
                 <div class="col-md-2 box row" ><span class="legend"><br/></span><span class="valeur">{{Auth::user()->jocker_duel}}</span><br/> <span class="legend">JOKERS DUEL</span></div>
                 <div class="col-md-3 box row" ><span class="legend">AUJOURD'HUI<br/></span><span class="valeur red bold">{{ Stdfn::getTodayCagnotte() }}</span><br/> <span class="legend">A GAGNER</span></div>
                 <div class="col-md-2 box row" ><a href="{{route('souscription')}}"><span class="legend"><br/></span><span class="valeur">{{Auth::user()->souscription}}</span><br/> <span class="legend">SOUSCRIPTION</span></a></div>
                 <div class="col-md-2 box row" ><a href="{{route('souscription')}}"><span class="legend"><br/></span><span class="valeur"><i class="fa fa-money"></i>
					{{ Auth::user()->devise . ' ' . number_format(Auth::user()->money, 0, '.', ' ') }}</span><br/><span class="my_money" style="padding:5px 0px;display:block;font-weight:bold;"><span class="legend depot_retrait"><a href="{{route('depot')}}">Dépot</a> | <a href="{{route('retrait')}}">Retrait</a></span></span></div>
                 <!--div class="col-md-2 box row" >
					<span class="legend">
					</span>
					<span class="my_money" style="padding:5px 0px;display:block;font-weight:bold;">
					</span>
					
				</div-->
				 @endauth
			   </div>
			   
           </div>
		
		</div>
		
		<header class="bg-primary header navbar navbar-fixed-top-xs text-center container-fluid"> 
			<nav class="container" style="width: 900px;margin:auto;">
	 		
			 <ul id="top_menu" class="nav navbar-nav hidden-xs" style="margin:auto;width:100%;"> 
				
				<li>
					<a href="{{route('home')}}">Accueil</a>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown" href="?controller=compte&action=index">Mon compte <b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInRight">
						<span class="arrow top"></span>
						<li><a href="{{route('profile')}}">Identité</a></li>
						<li class="dropdown"><a class="dropdown-toggle dker" data-toggle="dropdown"  href="">Questionnaire</a>
							<ul class="dropdown-menu animated fadeInRight">
								<li><a href="{{route('addquestion')}}">Soumettre</a></li>
								<li><a href="{{route('questions')}}"> Voir </a></li>
								<li><a href="{{route('questions','1')}}">Duel</a></li>
								<li><a href="{{route('questions','1')}}">Chap</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a class="dropdown-toggle dker" data-toggle="dropdown"  href="#">Transaction</a>
							<ul class="dropdown-menu animated fadeInRight">
								<li><a href="{{route('depots')}}">Dépots</a></li>
								<li><a href="{{route('retraits')}}"> Retraits</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a class="dropdown-toggle dker" data-toggle="dropdown"  href="#">Opérations</a>
							<ul class="dropdown-menu animated fadeInRight">
								<li><a href="{{route('souscriptions')}}">Souscriptions</a></li>
								<li><a href="{{route('jockers')}}">Jocker question</a></li>
								<!--li><a href="{{route('ConversionPoint')}}"> Conversion point</a></li-->
							</ul>
						</li>

						<li><a href="{{route('invites')}}">Mes invités</a></li>
						<li><a href="{{route('bonus')}}">Mes Bonus</a></li>
					</ul>
				</li>

				<!--
				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown" href="#"> Jeu <b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInLeft">
						<span class="arrow top"></span>
						<li><a href=""> Recompense </a></li>
						<li><a href="{{route('classements')}}"> Classements </a></li>
						<li class="dropdown"><a class="dropdown-toggle dker" data-toggle="dropdown"  href="#">Duels </a>
							<ul class="dropdown-menu animated fadeInRight">
								<li><a href="{{route('duels','encours')}}">Duels en cours</a></li>
								<li><a href="{{route('duels','termines')}}"> Duels Terminés </a></li>
							</ul>
						</li>

						<li><a href="{{route('duels')}}">Jouer</a></li>
						<li><a href="{{route('comment_jouer')}}">Comment jouer</a></li>
					</ul>
				</li>
				-->
				
				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown" href="#"> Test de connaissance <b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInLeft">
						<span class="arrow top"></span>
						<li><a href="{{route('aide')}}">Aide</a></li>
						<li><a href="{{route('records')}}">Records</a></li>
						<li><a href="{{route('categorie_test')}}">Jouer</a></li>	
					</ul>

				</li>

				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown" href="#"> Quiz <b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInLeft">
						<span class="arrow top"></span>
						<li><a href="{{route('souscrirequiz')}}">Souscrire et jouer</a></li>	
						<li><a href="{{route('quizs')}}">Afficher tout</a></li>	
					</ul>

				</li>

				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown" href="#"> Chap <b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInLeft">
						<span class="arrow top"></span>
						<li><a href="{{route('chapencours')}}">Jouer</a></li>	
						<li><a href="{{route('chaps')}}">Afficher tout</a></li>	
					</ul>

				</li>

				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown"  href="">Conversion	<b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInRight">
						<span class="arrow top"></span>
						<li><a href="{{route('ConversionPoint')}}">Conversion de point</a></li>
						<li><a href="{{route('ConversionDevise')}}">Conversion de devise</a></li>
						<!--li><a href="#"> securité </a></li-->
					</ul>
				</li>


				<li class="dropdown">
					<a class="dropdown-toggle dker" data-toggle="dropdown"  href="?controller=gagnant&action=tout">Gagnants	
					<b class="caret"></b></a>
					<ul class="dropdown-menu animated fadeInRight">
						<span class="arrow top"></span>
						<li><a href="{{'gagnants'}}">De la semaine</a></li>
						<li><a href="{{'gagnants'}}">Du mois</a></li>
						<li><a href="{{'gagnants'}}">Tous les gagnans </a></li>
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
							
							@yield('content')
							
							<!----> 
							
							
							<script src="{{ URL::asset('js/event_listener.js') }}"></script>
	
	
						</section>
						
						
					</section> 
					
					<aside class="bg-light lter b-l aside-md hide" id="notes"> 
						<div class="wrapper"></div> 
					</aside> 
					
					
			</section> 
		</section> 
		
	</section> 
	 
	
	<section class="footer" id="footer"> 
		&copy; 2020 CRACKGAME 
	</section> 
	
  
	 <!-- Bootstrap --> 
	 <!-- App --> 
	 <script src="{{ asset('js/app.v1.js') }}"></script> 
	 <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
	 <script src="{{ asset('js/datatables/jquery.csv-0.71.min.js') }}"></script>
	 <script src="{{ asset('js/kraksoft.js') }}"></script> 
	 <script src="{{ asset('js/app.plugin.js') }}"></script> 
	 
	 <!-- fuelux -->
	 <script src="{{asset('js/fuelux/fuelux.js') }}"></script>
	 <script src="{{asset('js/parsley/parsley.min.js') }}"></script>
	 
	 
	<script src="{{asset('js/jquery.mask.js') }}"></script>
	 
	 
	<script src="{{ asset('js/noty/jquery.noty.js') }}"></script>
	<script src="{{ asset('js/noty/layouts/bottomCenter.js') }}"></script>
	<script src="{{ asset('js/noty/layouts/topRight.js') }}"></script>
	<script src="{{ asset('js/noty/layouts/top.js') }}"></script>
	<script src="{{ asset('js/noty/layouts/center.js') }}"></script>
	<script src="{{ asset('js/noty/themes/default.js') }}"></script>
	
	<input type="hidden" id="eco_base_url" value="{{'http://'.$_SERVER['HTTP_HOST'].'/'}}">
	<input type="hidden" id="lang" value="fr">
	
	@auth
	<input type="hidden" id="my_user_id" value="{{Auth::user()->id}}">
	@endauth
	


	<!-- flipclock -->
	
	<script src="{{asset('js/flipclock/flipclock.min.js')}}"></script>

	<script type="text/javascript">
		var clock;
		
		$('document').ready(function() {
			
			var csrf_token   =   $('meta[name="csrf-token"]').attr('content');
			$.ajaxSetup({
				headers: {"X-CSRF-TOKEN": csrf_token}
			});
			
			
			var time = $('#flipclock_view').attr('data-time');
			
		    var clock = $('#flipclock_view').FlipClock(time,{
						countdown: true, 
						callbacks: {
							stop: function() {
								location.href =  'chapencours';
							}
						}
					}
				);


		});
	</script>


 </body>
</html>