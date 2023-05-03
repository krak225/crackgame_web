<!DOCTYPE html>
<html lang="fr" class=" ">
<head> 
	<meta charset="utf-8" />
	<title>{{ config('app.title', 'CRACKGAME ADMIN') }}</title>
	<meta name="description" content="Web app by Richmond KOUASSI (krak225@gmail.com)" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="stylesheet" href="{{ asset('css/select2.css')}}" type="text/css"/>	
	<link rel="stylesheet" href="{{ asset('css/font.css') }}" type="text/css" /> 
	<link rel="stylesheet" href="{{ asset('js/datatables/datatables.css') }}" type="text/css"/> 
	<link rel="stylesheet" href="{{ asset('css/app.v1_vert.css') }}" type="text/css" /> 
	<!--link rel="stylesheet" href="{{ asset('css/app.v1_orange.css') }}" type="text/css" /--> 
	<link rel="stylesheet" href="{{ asset('js/fuelux/fuelux.css')}}" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('css/krakPopup.css')}}"/>	
	<link rel="stylesheet" href="{{ asset('css/todo.css')}}"/>	
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/contextual.theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/contextual.css') }}">
	
    <!--link rel="stylesheet" type="text/css" href="{{ asset('css/summernote/summernote.js') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote/summernote.css') }}"-->
	
	
	<!--[if lt IE 9]> 
	<script src="js/ie/html5shiv.js"></script> 
	<script src="js/ie/respond.min.js"></script> 
	<script src="js/ie/excanvas.js"></script> 
	<![endif]-->
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript">
		var csrf_token   =   $('meta[name="csrf-token"]').attr('content');
		$.ajaxSetup({
			headers: {"X-CSRF-TOKEN": csrf_token}
		});
		
	</script>

</head>
<body class="container"> 
	<section class="vbox">
		<header class="bg-primary header navbar navbar-fixed-top-xs"> 
		
		<!--div class="navbar-header aside-md tex"> 
		<span style="background:white url({{ asset('images/logo.png') }}) center no-repeat;background-size:contain;display:block;border:3px solid 029838;"> 
			<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html"> <i class="fa fa-bars"></i> </a> 
			<a href="{{ route('home') }}" class="navbar-brand">
			
			</a> 
			<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user"> <i class="fa fa-cog"></i> </a> 
		</span> 
		</div--> 
		
		<div class="navbar-header aside-md" style="background:white;color:orange;border:1px solid #65bd77"> 
		<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html" style="color:orange"> 
		<i class="fa fa-bars"></i> </a> 
		<a href="#" class="navbar-brand" data-toggle="fullscreen" style="font-size:12px;background:white;color:orange">
		{{ config('app.name') }}
		</a>
		<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user" style="color:orange"> 
		<i class="fa fa-cog"></i> 
		</a> 
		</div> 
 
 
		 <ul class="nav navbar-nav hidden-xs"> 
			<li class="dropdown"> 
				<a href="#" class="dropdown-toggle dker" data-toggle="dropdown"> <i class="fa fa-building-o"></i> 
					<span class="font-bold">{{ config('app.subtitle') }}</span> 
				</a> 				 
			 </li> 
			<li> 
				<div class="m-t m-l"> 
					<a href="#" class="dropdown-toggle btn btn-xs btn-primary" title="Upgrade">{{ config('app.version') }}</a> 
				</div>
			</li> 
		 </ul> 
		 <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user"> 
		 @auth
		 <li class="dropdown"> 
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
			<span class="thumb-sm avatar pull-left">
			@if(File::exists('images/'. Auth::user()->photo ) && !is_dir('images/'. Auth::user()->photo))
			<img src="{{ asset('images/'. Auth::user()->photo ) }}" alt=""/>
			@else
			<img src="{{ asset('images/avatar.jpg') }}"/>
			@endif
			
			</span> {{ Auth::user()->nom . ' ' . Auth::user()->prenoms }} <b class="caret"></b> 
			</a> 
			<ul class="dropdown-menu animated fadeInRight"> 
				<span class="arrow top"></span> 
				<li> <a href="{{ route('profile') }}">Mon compte</a> </li> 
				<li> <a href="{{ route('updatePassword') }}">Mot de passe</a> </li> 
				<li class="divider"></li> 
				
				<li>
					<a href="{{ route('logout') }}"
					onclick="event.preventDefault();
							 document.getElementById('logout-form').submit();">
					Se déconnecter
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</li>
			</ul> 
		 </li>
		 @endauth
		 </ul> 
		 </header> 
		 <section> 
			<section class="hbox stretch"> 
				<!-- .aside --> 
				<aside class="bg-dark aside-md hidden-print hidden-xs" id="nav"> 
					<section class="vbox"> 
						<section class="w-f scrollable"> 
							<div class=" " data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333"> 
							<!-- nav --> 
							<nav class="nav-primary hidden-xs"> 
								<ul class="nav">
									<li>
										<div class="" style="padding:15px;"> 
											MENU PRINCIPAL
										</div> 
									</li>
									@auth
									<li class="@if(Request::is('categories')) active @endif"> 
										<a href="{{route('categories')}}" class=""> 
											 <i class="fa fa-cogs icon"> 
											 <b class="bg-info"></b> </i> 
											 <span>CATÉGORIES</span> 
										</a>
									</li>
									<li class="@if(Request::is('questionsquiz', 'addquestionquiz')) active @endif"> 
										<a href="#" class=""> 
											 <i class="fa fa-users icon"> 
											 <b class="bg-info"></b> </i> 
											 <span class="pull-right"> 
												<i class="fa fa-angle-down text"></i> 
												<i class="fa fa-angle-up text-active"></i> 
											 </span> 
											 <span>QUESTIONS QUIZ</span> 
										</a> 
										<ul class="nav lt"> 
											<li class="@if(Request::is('addquestionquiz')) active @endif"> 
												<a href="{{route('addquestionquiz')}}" class="active"> 
												<i class="fa fa-angle-right"></i> 
												<span>Nouvelle question</span></a> 
											</li>
											<li class="@if(Request::is('questionsquiz')) active @endif"> 
												<a href="{{route('questionsquiz')}}" class="active"> 
												<i class="fa fa-angle-right"></i> 
												<span>Questions de quiz</span></a> 
											</li> 
										</ul> 
									</li>
									<li class="@if(Request::is('questionstest', 'addquestiontest')) active @endif"> 
										<a href="#" class=""> 
											 <i class="fa fa-users icon"> 
											 <b class="bg-info"></b> </i> 
											 <span class="pull-right"> 
												<i class="fa fa-angle-down text"></i> 
												<i class="fa fa-angle-up text-active"></i> 
											 </span> 
											 <span>QUESTIONS TEST</span> 
										</a> 
										<ul class="nav lt"> 
											<li class="@if(Request::is('addquestiontest')) active @endif"> 
												<a href="{{route('addquestiontest')}}" class="active"> 
												<i class="fa fa-angle-right"></i> 
												<span>Nouvelle question</span></a> 
											</li>
											<li class="@if(Request::is('questionstest')) active @endif"> 
												<a href="{{route('questionstest')}}" class="active"> 
												<i class="fa fa-angle-right"></i> 
												<span>Questions de Test</span></a> 
											</li> 
										</ul> 
									</li>
									<li class="@if(Request::is('defis')) active @endif"> 
										<a href="{{route('defis')}}" class=""> 
											 <i class="fa fa-cogs icon"> 
											 <b class="bg-info"></b> </i> 
											 <span>DÉFIS</span> 
										</a>
									</li>
									<li class="@if(Request::is('recompenses')) active @endif"> 
										<a href="{{route('recompenses')}}" class=""> 
											 <i class="fa fa-money icon"> 
											 <b class="bg-info"></b> </i> 
											 <span>RÉCOMPENSES</span> 
										</a>
									</li>
									<li class="@if(Request::is('quizjoues')) active @endif"> 
										<a href="{{route('quizjoues')}}" class=""> 
											 <i class="fa fa-cogs icon"> 
											 <b class="bg-info"></b> </i> 
											 <span>QUIZ JOUÉS </span> 
										</a>
									</li>
									<li class="@if(Request::is('testsjoues')) active @endif"> 
										<a href="{{route('testsjoues')}}" class=""> 
											 <i class="fa fa-cogs icon"> 
											 <b class="bg-info"></b> </i> 
											 <span>TESTS JOUÉS </span> 
										</a>
									</li>
									<li class="@if(Request::is('questionstest', 'addquestiontest')) active @endif"> 
										<a href="#" class=""> 
											 <i class="fa fa-users icon"> 
											 <b class="bg-info"></b> </i> 
											 <span class="pull-right"> 
												<i class="fa fa-angle-down text"></i> 
												<i class="fa fa-angle-up text-active"></i> 
											 </span> 
											 <span>OPÉRATIONS</span> 
										</a> 
										<ul class="nav lt"> 
											<li class="@if(Request::is('depots')) active @endif"> 
												<a href="{{route('depots')}}" class=""> 
													 <i class="fa fa-cogs icon"> 
													 <b class="bg-info"></b> </i> 
													 <span>DÉPÔTS</span> 
												</a>
											</li>
											<li class="@if(Request::is('retraits')) active @endif"> 
												<a href="{{route('retraits')}}" class=""> 
													 <i class="fa fa-cogs icon"> 
													 <b class="bg-info"></b> </i> 
													 <span>RETRAITS</span> 
												</a>
											</li>
											<li class="@if(Request::is('souscriptions')) active @endif"> 
												<a href="{{route('souscriptions')}}" class=""> 
													 <i class="fa fa-cogs icon"> 
													 <b class="bg-info"></b> </i> 
													 <span>SOUSCRIPTIONS</span> 
												</a>
											</li>
										</ul> 
									</li>
									<li class="@if(Request::is('utilisateurs')) active @endif"> 
										<a href="{{route('utilisateurs')}}" class=""> 
											 <i class="fa fa-users icon"> 
											 <b class="bg-info"></b> </i> 
											 <span>UTILISATEURS</span> 
										</a>
									</li>
									<li class="@if(Request::is('administrateurs')) active @endif"> 
										<a href="{{route('administrateurs')}}" class=""> 
											 <i class="fa fa-users icon"> 
											 <b class="bg-info"></b> </i> 
											 <span>ADMINISTRATEURS</span> 
										</a>
									</li>
									@else
									<li> 
										<a href="{{ route('login') }}" class="active"> 
											<i class="fa fa-columns icon"> 
											<b class="bg-info"></b> </i>
											<span>Se connecter</span> 
										</a> 
									</li>
									@endauth
									
								</ul>
								
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
							
							
						</section>
						
						
					</section> 
					<aside class="bg-light lter b-l aside-md hide" id="notes"> 
						<div class="wrapper"></div> 
					</aside> 
			</section> 
		</section> 
	</section> 
	
	
	<div id="dialogKrakPopup"></div>
	
	<!-- Bootstrap --> 
	 
	 
	<audio id="audio">
	  <source src="eventually.ogg" type="audio/ogg">
	  <source src="eventually.mp3" type="audio/mp3">
	</audio>

	 
	<!-- App --> 
	<script src="{{ asset('js/app.v1.js') }}"></script> 
	<script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/datatables/jquery.csv-0.71.min.js') }}"></script>
	<script src="{{ asset('js/kraksoft.js') }}"></script> 
	<script src="{{ asset('js/pubnub.js') }}"></script> 
	<script src="{{ asset('js/app.plugin.js') }}"></script> 

	<!-- fuelux -->
	<script src="{{asset('js/fuelux/fuelux.js') }}"></script>
	<script src="{{asset('js/parsley/parsley.min.js') }}"></script>


	<script src="{{asset('js/jquery.mask.js') }}"></script>
	<script src="{{asset('js/select2.js') }}"></script>

	<script src="{{asset('js/todo_drag.js') }}"></script>

	<script src="{{asset('js/jquery-ui-1.10.3.custom.min.js') }}"></script>
	<script src="{{asset('js/jquery.krakPopup.js') }}"></script>
	 
	<script src="{{ asset('js/noty/jquery.noty.js') }}"></script>
	<script src="{{ asset('js/noty/layouts/bottomCenter.js') }}"></script>
	<script src="{{ asset('js/noty/layouts/topRight.js') }}"></script>
	<script src="{{ asset('js/noty/layouts/top.js') }}"></script>
	<script src="{{ asset('js/noty/layouts/center.js') }}"></script>
	<script src="{{ asset('js/noty/themes/default.js') }}"></script>
	
	<script src="{{ asset('js/contextual.js') }}"></script>

	
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	
	<input type="hidden" id="eco_base_url" value="{{'http://'.$_SERVER['HTTP_HOST']}}/public/jeu-admin-l8/public/">
 
 </body>
</html>