@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Administrateurs</li> 
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
	<h3 class="m-b-none">Liste des administrateurs</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading">Liste des administrateurs</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr>  
					<th style="display:none;">ID</th>
					<th width="">Nom</th> 
					<th width="">Prénoms</th> 
					<th width="">Login</th>
					<th width="">Enregistré le</th>
					<th width="">Statut</th>
					<th width="">Actions</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($users as $user)
				<tr>
					<td style="display:none;">{{ $user->id }}</td>
					<td>{{ $user->nom }}</td> 
					<td>{{ $user->prenoms }}</td>
					<td>{{ $user->email }}</td> 
					<td>{{ $user->created_at }}</td>
					<td>{{ $user->statut }}</td>
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