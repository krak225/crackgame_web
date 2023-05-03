@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">@if(!empty($titre)) {{ ucfirst($titre) }} @else Questions @endif</li> 
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
	<h3 class="m-b-none">Liste des @if(!empty($titre)) {{ ucfirst($titre) }} @else questions @endif</h3> 
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Options de recherche</header> 
	
	<div class="panel-body dropdown" style="background:#d9edf7;" id="boxRecherche"> 
		<div class="">
			<form class="form" method="get" action="">
				
				<!--{!! csrf_field() !!}-->
				
				<div class="row">
					
					<div class="col-md-12">
						
						<label for="bureau_id" class="col-md-2 control-label">Catégorie</label>
						
						<div class="col-md-3">
							
							<select class="form-control" name="c">
								<option value="">Choisir</option>
								@foreach($categories as $categorie)
								<option @if($categorie_id_selected == $categorie->categorie_id) selected @endif value="{{ $categorie->categorie_id }}">{{ $categorie->categorie_libelle }}</option>
								@endforeach
							</select>
							
						</div>
					
						@if($titre == 'questions de quiz')
						<label for="percepteur" class="col-md-1 control-label">Niveau</label>

						<div class="col-md-3">
							
							<select class="form-control" name="n">
								<option value="">Choisir</option>
								@foreach($niveaux as $niveau)
								<option @if($niveau_id_selected == $niveau->niveau_id) selected @endif value="{{ $niveau->niveau_id }}">{{ $niveau->niveau_libelle }}</option>
								@endforeach
							</select>
							
						</div>
						@endif
						
						<div class="col-md-3 pull-right">
							<button type="submit" class="btn btn-warning rounded"><i class="fa fa-search"></i> Rechercher</button>
						</div>
						
					</div>
					
					
				</div>
				
				
			</form>
			
		</div>
	</div> 

	<header class="panel-heading"> Liste des questions</header> 
	
	<div class="table-responsive"> 
		<form id="formSelectionQuestion"> 
		@if($type_jeu_id == 1)
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="5%"></th> 
					<th width="">Question (Fr/En)</th> 
					<th width="20%">Bonne réponse</th>
					<!--th width="20%">Mauvaise 1</th>
					<th width="20%">Mauvaise 2</th-->
					<th width="5%">Catégorie</th>
					<th width="5%">Statut</th>
					<th width="5%">Action</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($questions as $question)
				<tr>
					<td>{{ $question->id}}</td> 
					<td>{{ $question->question_fr }}</td> 
					
					@if($question->reponse == 'A')
						<td>{{ $question->proposition_a_fr }}</td>
						<!--td>{{ $question->proposition_b_fr }}</td> 
						<td>{{ $question->proposition_c_fr }}</td-->
					@elseif($question->reponse == 'B')
						<td>{{ $question->proposition_b_fr }}</td>
						<!--td>{{ $question->proposition_a_fr }}</td> 
						<td>{{ $question->proposition_c_fr }}</td-->
					@else
						<td>{{ $question->proposition_c_fr }}</td>
						<!--td>{{ $question->proposition_a_fr }}</td> 
						<td>{{ $question->proposition_b_fr }}</td-->
					@endif
					
					<td>{{ $question->categorie_libelle }}</td>
					<td>{{ $question->statut }}</td>
					
					<td>
						<a href="{{ route('DetailsQuestion',$question->id) }}"><i class="fa fa-cogs text-info" title="Détails de la question"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{{ route('modifier_question',$question->id) }}"><i class="fa fa-edit text-warning" title="Modifier la question"></i></a>
					</td>
					
				</tr>	
			@endforeach
			</tbody> 
		</table> 
		@else
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="5%"></th> 
					<th width="">Question (Fr/En)</th> 
					<th width="20%">Bonne réponse</th>
					<!--th width="20%">Mauvaise 1</th>
					<th width="20%">Mauvaise 2</th-->
					<th width="5%">Catégorie</th>
					<th width="5%">Niveau</th>
					<th width="5%">Statut</th>
					<th width="5%">Action</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($questions as $question)
				<tr>
					<td>{{ $question->id}}</td> 
					<td>{{ $question->question_fr }}</td> 
					
					@if($question->reponse == 'A')
						<td>{{ $question->proposition_a_fr }}</td>
						<!--td>{{ $question->proposition_b_fr }}</td> 
						<td>{{ $question->proposition_c_fr }}</td-->
					@elseif($question->reponse == 'B')
						<td>{{ $question->proposition_b_fr }}</td>
						<!--td>{{ $question->proposition_a_fr }}</td> 
						<td>{{ $question->proposition_c_fr }}</td-->
					@else
						<td>{{ $question->proposition_c_fr }}</td>
						<!--td>{{ $question->proposition_a_fr }}</td> 
						<td>{{ $question->proposition_b_fr }}</td-->
					@endif
					
					<td>{{ $question->categorie_libelle }}</td>
					<td>{{ $question->niveau_libelle }}</td>
					<td>{{ $question->statut }}</td>
					
					<td>
						<a href="{{ route('DetailsQuestion',$question->id) }}"><i class="fa fa-cogs text-info" title="Détails de la question"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="{{ route('modifier_question',$question->id) }}"><i class="fa fa-edit text-warning" title="Modifier la question"></i></a>
					</td>
					
				</tr>	
			@endforeach
			</tbody> 
		</table> 
		@endif
		</form> 
	</div> 
</section>

@endsection