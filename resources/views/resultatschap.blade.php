@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li><a href="{{route('chaps')}}">Jeux chap</a></li>  
	<li class="active">Détails d'un jeux chap-chap</li> 
</ul> 


@if(Session::has('warning'))
	<div class="alert alert-warning">
	  {{Session::get('warning')}}
	</div>
@endif

@if(Session::has('message'))
	<div class="alert alert-success">
	  {{Session::get('message')}}
	</div>
@endif


<div class="m-b-md"> 
	<h3 class="m-b-none">Détails d'un jeux chap-chap</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des joueurs et leurs scores
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="10%">Réf</th>
					<th width="20%">Participant</th>
					<th width="20%">Score</th>
					<th width="20%">Gain</th>
					<th width="10%">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($resultatschap as $resultat)
				<tr>
					<td>Chap N° {{ $resultat->id }}</td>
					<td>{{ $resultat->pseudo }}</td>
					<td>{{ $resultat->score }}</td>
					<td>{{ $resultat->score /Stdfn::getFraisAbonnementChap(Auth::user()->devise) * Stdfn::getGainParQuestionChap(Auth::user()->devise) }}</td>
					<td>{{ $resultat->statut }}</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection