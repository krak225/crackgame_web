@extends('layouts.app')

@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Test de connaissance</li>  
	<li class="active">Choix d'une catégorie</li>  
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Choisir une catégorie</h3> 
</div>

@if(Session::has('message'))
	<div class="alert alert-success">
	  {{Session::get('message')}}
	</div>
@endif

@if(Session::has('warning'))
	<div class="alert alert-warning">
	  {{Session::get('warning')}}
	</div>
@endif

	<section class="panel panel-default" style="padding:10px;"> 
		<div class="row m-l-none m-r-none bg-light lter" style="border:none;"> 
			@foreach($categories as $categorie)
				<div class="col-md-3 " style="border:1px solid #ddd;padding:10px;"> 
					<span class="fa-stack fa-2x pull-left m-r-sm"> 
					<i class="fa fa-circle fa-stack-2x text-info"></i> 
					<i class="fa fa-question-circle fa-stack-1x text-white"></i> 
					</span> 
					<a class="clear" href="{{ route('entrainement',$categorie->categorie_id) }}"> 
					<span class="block m-t-uc"><strong>{{$categorie->categorie_libelle}}</strong></span> 
					<small class="text-muted">{{$categorie->categorie_description}}</small> 
					</a> 
				</div> 
			@endforeach
			
		</div> 
	</section>

			
@endsection
