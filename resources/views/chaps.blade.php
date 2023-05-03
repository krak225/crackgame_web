@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Chap-chap</li> 
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
	<h3 class="m-b-none">Jeux chap-chap</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des jeux chap-chap
	</header> 
	
	<div class="table-responsive"> 
		<table class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>  
					<th width="5%">Réf</th>
					<th width="15%">Date</th>
					<th width="10%">Participants</th>
					<th width="10%">Etape</th>
					<th width="10%">Statut</th>
					<!--th width="20%">Résultat</th-->
					<th width="10%">Résultats</th>
					<th width="5%">Actions</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($chaps as $chap)
			
				<tr>
					<td>{{ $chap->chap_id }}</td>
					<td>{{ Stdfn::dateTimeFromDB($chap->chap_date_creation) }}</td>
					<td>{{ $chap->chap_participants }}</td>
					<td>{{ $chap->chap_etape }}</td>
					<td>{{ $chap->chap_statut }}</td>
					<!--td>@if($chap->chap_vainqueur_id == Auth::user()->id) {{ 'Gagné' }} @elseif ($chap->chap_vainqueur_id != ''){{ 'Perdu' }} @elseif ($chap->chap_vainqueur_id == ''){{ 'en attente' }} @endif</td-->
					<td>
						<a href="{{route('ResultatsChap',[$chap->chap_id] )}}">Afficher les résultats</a>
					</td>		
					<td>		
					
					@if(Auth::user()->profil_id == 1)
						@if($chap->chap_statut=='EN COURS' && $chap->readystate=='NOT READY')
						<!--span class="btnDemarerChap" data-chap_id="{{$chap->chap_id}}" data-admin_id="{{Auth::user()->id}}" class="btn " style="cursor:pointer;">Démarer</span-->
						@endif
					@else

						@if(Auth::user()->id == $chap->adversaire_id)
							@if($chap->chap_statut=='VALIDE')
								<a href="{{route('Jouerchap',[$chap->chap_id,$chap->user_id] )}}">Jouer</a>
							@elseif($chap->chap_statut=='BROUILLON')
								<a href="{{route('Rejoindrechap',$chap->chap_id )}}">Accepter</a>
							@endif
						@else
							@if($chap->chap_statut=='VALIDE' || $chap->chap_statut=='EN COURS')<a href="{{route('Jouerchap',[$chap->chap_id] )}}">Jouer</a>
							@elseif($chap->chap_statut=='BROUILLON') <a href="#">En attente</a>
							@elseif($chap->chap_statut=='TERMINE') <a href="#"></a>
							@endif
						@endif

					@endif
					</td>
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection