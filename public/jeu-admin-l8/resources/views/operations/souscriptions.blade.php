@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Souscriptions</li> 
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
	<h3 class="m-b-none">Liste des souscriptions</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des souscriptions <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr>  
					<th style="display:none;">ID</th>
					<th width="20%">Souscripteur</th> 
					<th width="20%">Bénéficiaire</th>
					<th width="10%">Quantité</th>
					<th width="10%">Montant</th>
					<th width="20%">Date</th> 
				</tr> 
			</thead> 
			<tbody>
			@foreach($souscriptions as $souscription)
				<tr>
					<td style="display:none;">{{ $souscription->id }}</td>
					<td>{{ $souscription->pseudo }}</td> 
					<td>{{ $souscription->pseudo }}</td>
					<td>{{ $souscription->souscription_quantite }}</td> 
					<td style="text-align:right;">{{ $souscription->souscription_montant }}</td>
					<td>{{ $souscription->souscription_date }}</td> 
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection