@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Mes dépots</li> 
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
	<h3 class="m-b-none">Liste des dépots</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des dépots <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="10%">Réf</th> 
					<th width="">Nom bénéficiaire</th>
					<th width="25%">Pseudo bénéficiaire</th>
					<th width="15%">Montant</th>
					<th width="20%">Date</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($depots as $depot)
				<tr>
					<td>{{ $depot->depot_id }}</td> 
					<td>{{ $depot->nom . ' '. $depot->prenoms }}</td>
					<td>{{ $depot->pseudo }}</td>
					<td>{{ $depot->depot_montant }}</td>
					<td>{{ Stdfn::dateTimeFromDB($depot->depot_date) }}</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection