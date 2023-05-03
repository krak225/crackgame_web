@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="{{route('home')}}">Test de connaissance</a></li>  
	<li class="active">Aide</li> 
</ul> 


<div class="m-b-md"> 
	<h3 class="m-b-none">Aide</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading">Aide</header> 
	
	<div class="panel-body" style="min-height:400px;"> 
		Contenu de la page d'aide
	</div> 
</section>

@endsection