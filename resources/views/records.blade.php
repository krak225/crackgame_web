@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Mes records</li> 
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
	<h3 class="m-b-none">Mes records</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Mes records obtenus lors des tests de connaissance
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="">Joueur</th>
					<th width="">Catégorie</th>
					<th width="20%">Record</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($records as $record)
				<tr>
					<td>{{ $record->pseudo }}</td>
					<td>{{ $record->categorie_libelle }}</td>
					<td>{{ $record->entrainement_score }}</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection