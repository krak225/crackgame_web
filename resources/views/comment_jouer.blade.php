@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="{{route('home')}}">Duel</a></li>  
	<li class="active">Comment jouer?</li> 
</ul> 


<div class="m-b-md"> 
	<h3 class="m-b-none">Comment jouer un duel?</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading">Comment jouer un duel?</header> 
	
	<div class="panel-body" style="min-height:400px;"> 
		Contenu de la page comment jouer un duel?
	</div> 
</section>

@endsection