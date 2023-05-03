@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Tests joués</li> 
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
	<h3 class="m-b-none">Gestion des tests joués</h3> 
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des tests joués</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th width="">N°</th>
					<th width="">Date</th>
					<th width="">Joueur</th>
					<th width="">Catégorie</th>
					<th width="">Score</th>
					<th width="">Issue</th>
					<th width="">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($testsjoues as $test)
				<tr>
					<td>{{ $test->entrainement_id}}</td> 
					<td>{{ Stdfn::dateFromDB($test->entrainement_date) }}</td>
					<td>{{ $test->pseudo }}</td>
					<td>{{ $test->categorie_libelle }}</td>
					<td>{{ $test->entrainement_score }}</td>
					<td>{{ $test->entrainement_issue }}</td>
					<td>{{ $test->entrainement_statut }}</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection