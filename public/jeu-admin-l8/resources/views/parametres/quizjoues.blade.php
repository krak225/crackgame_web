@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Quiz joués</li> 
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
	<h3 class="m-b-none">Gestion des quiz joués</h3> 
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des quiz joués</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width="">N°</th>
					<th width="">Date</th>
					<th width="">Joueur</th>
					<th width="">Catégorie</th>
					<th width="">Score</th>
					<th width="">Mise</th>
					<th width="">Issue</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($quizjoues as $quiz)
				<tr>
					<td>{{ $quiz->entrainement_id}}</td> 
					<td>{{ Stdfn::dateFromDB($quiz->entrainement_date) }}</td>
					<td>{{ $quiz->pseudo }}</td>
					<td>{{ $quiz->categorie_libelle }}</td>
					<td>{{ $quiz->entrainement_score }}</td>
					<td>{{ $quiz->objectif_financier }}</td>
					<td>{{ $quiz->entrainement_issue }}</td>
					<td>{{ $quiz->entrainement_statut }}</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection