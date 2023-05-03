@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Mes retraits</li> 
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
	<h3 class="m-b-none">Liste des retraits</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des retraits <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="10%">Réf</th>
					<th width="15%">Montant</th>
					<th width="20%">Date demande</th>
					<th width="20%">Date validation</th>
					<th width="20%">Statut</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($retraits as $retrait)
				<tr>
					<td>{{ $retrait->retrait_id }}</td>
					<td>{{ $retrait->retrait_montant }}</td>
					<td>{{ Stdfn::dateTimeFromDB($retrait->retrait_date_demande) }}</td>
					<td>{{ Stdfn::dateTimeFromDB($retrait->retrait_date_validation) }}</td>
					<td>{{ $retrait->retrait_statut }}</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection