@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Quiz</li> 
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
	<h3 class="m-b-none">Quiz</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des quiz
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="5%">Réf</th>
					<th width="15%">Date</th>
					<th width="15%">Catégorie</th>
					<th width="10%">Objectif</th>
					<th width="10%">Compteur</th>
					<th width="10%">Score</th>
					<th width="10%">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($quizs as $quiz)
			
				<tr>
					<td>{{ $quiz->entrainement_id }}</td>
					<td>{{ Stdfn::dateTimeFromDB($quiz->entrainement_date) }}</td>
					<td>{{ $quiz->categorie_libelle }}</td>
					<td>{{ $quiz->objectif_financier }}</td>
					<td>{{ $quiz->entrainement_compteur_question }}</td>
					<td>{{ $quiz->entrainement_score }}</td>
					<td>{{ $quiz->entrainement_statut }}</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection