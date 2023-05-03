@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Mes invités</li> 
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
	<h3 class="m-b-none">Liste des invités</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des invités <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="20%">Nom</th> 
					<th width="">Prénoms</th> 
					<th width="20%">Pseudo</th>
					<th width="15%">Téléphone</th>
					<th width="20%">Date inscription</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->nom }}</td> 
					<td>{{ $user->prenoms }}</td>
					<td>{{ $user->pseudo }}</td> 
					<td>{{ $user->telephone }}</td>
					<td>{{ Stdfn::dateTimeFromDB($user->created_at) }}</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection