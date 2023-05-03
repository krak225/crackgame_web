@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="{{route('home')}}">Classement</a></li>  
	<li class="active">Top vainqueurs</li> 
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
	<h3 class="m-b-none">Classement des top vainqueurs</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Classement des top vainqueurs <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	<div class="panel-body"> 
		<div class="table-responsive"> 
			<table class="table datatable table-striped m-b-none" id="statistiques"> 
				<thead> 
					<tr> 
						<th width="">Nom et Prénoms</th>
						<th width="">Duels</th>
						<th width="">Victoires</th>
						<th width="">Meilleur score</th>
						<th width="">Actions</th>
					</tr> 
				</thead> 
				<tbody>
				@if(!empty($users))
				 @foreach($users as $user)
					@if($user->id != Auth::user()->id)
					<tr> 
						<td> 
							<a href="{{ route('CreerDuel',$user->id) }}" > 
								 <span>{{$user->nom . ' '.$user->prenoms }}</span> 
							 </a> 
						 </td>
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>
							@if(Auth::user()->statut_abonnement == 'ACTIVE')
							<a href="{{ route('CreerDuel',$user->id) }}" > 
								<span>Inviter</span> 
							</a>
							@endif
						</td>
					 </tr>
					 @endif
				 @endforeach
				 @endif
				</tbody> 
			</table> 
		</div>  
	</div> 
</section>

@endsection