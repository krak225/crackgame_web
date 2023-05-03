@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Utilisateurs</li> 
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
	<h3 class="m-b-none">Liste des utilisateurs</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des utilisateurs <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr>  
					<th style="display:none;">ID</th>
					<th width="20%">Nom</th> 
					<th width="">Prénoms</th>
					<th width="15%">Pseudo</th>
					<th width="10%">Téléphone</th>
					<th width="10%">Point Test</th>
					<th width="10%">Solde</th>
					<th width="10%">Actions</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($users as $user)
				<tr>
					<td style="display:none;">{{ $user->id }}</td>
					<td>{{ $user->nom }}</td> 
					<td>{{ $user->prenoms }}</td>
					<td>{{ $user->pseudo }}</td> 
					<td>{{ $user->telephone }}</td>
					<td style="text-align:right;">{{ $user->total_points_test }}</td>
					<td style="text-align:right;">{{ $user->money }}</td>
					<td>
						<a href="{{ route('DetailsUtilisateur',$user->id) }}"><i class="fa fa-info-circle text-info" title="Afficher les information de l'utilisateur"></i></a>					
					</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection