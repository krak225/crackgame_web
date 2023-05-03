@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li class="active">Questionnaire</li> 
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
	<h3 class="m-b-none">Liste des questions</h3> 
</div>

<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des questions <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
	</header> 
	
	<div class="table-responsive"> 
		<form id="formSelectionQuestion"> 
		<table class="table table-striped m-b-none datatable" data-ride="listeusers"> 
			<thead> 
				<tr> 
					<th width="5%"></th> 
					<th width="">Question</th> 
					<th width="20%">Bonne réponse</th>
					<th width="20%">Mauvaise 1</th>
					<th width="20%">Mauvaise 2</th>
					<th width="5%">Statut</th>
					@if(!empty($selectionner))
					<th width="5%">Quiz</th>
					<th width="5%">Chap</th>
					@else
					<th width="5%">Modif</th>
					<th width="5%">Suppr</th>
					@endif
				</tr> 
			</thead> 
			<tbody>
			@foreach($questions as $question)
				<tr>
					<td>{{ $question->id}}</td> 
					<td>{{ $question->question_fr }}</td> 
					
					@if($question->reponse == 'A')
						<td>{{ $question->proposition_a_fr }}</td>
						<td>{{ $question->proposition_b_fr }}</td> 
						<td>{{ $question->proposition_c_fr }}</td>
					@elseif($question->reponse == 'B')
						<td>{{ $question->proposition_b_fr }}</td>
						<td>{{ $question->proposition_a_fr }}</td> 
						<td>{{ $question->proposition_c_fr }}</td>
					@else
						<td>{{ $question->proposition_c_fr }}</td>
						<td>{{ $question->proposition_a_fr }}</td> 
						<td>{{ $question->proposition_b_fr }}</td>
					@endif
					
					<td>{{ $question->statut }}</td>
					
					@if(Auth::user()->profil_id == 1)
						<td>
							<a href="{{ route('valider_question',$question->id) }}"><i class="fa fa-info-circle text-info" title="Valider la question"></i></a>					
							<a href="{{ route('modifier_question',$question->id) }}"><i class="fa fa-edit text-warning" title="Modifier la question"></i></a>
						</td>
					@else
						@if(!empty($selectionner))
							<td>
								<input @if($question->statut_selection=='SELECTED') {{ ' checked ' }} @endif name="checkbox_selection_question" class="checkbox checkbox_selection_question" type="checkbox" id="chk_{{$question->id}}" data-id="{{$question->id}}" />					
							</td>
							<td>
								<input @if($question->statut_selection_chap=='SELECTED') {{ ' checked ' }} @endif name="checkbox_selection_question_chap" class="checkbox checkbox_selection_question_chap" type="checkbox" id="chk_{{$question->id}}" data-id="{{$question->id}}" />					
							</td>
						@else
							<td>@if($question->statut=="BROUILLON")
								<a href="{{ route('modifier_question',$question->id) }}"><i class="fa fa-edit text-warning" title="Modifier la question"></i></a>
								@endif
							</td>
							<td>
								<a href="{{ route('supprimer_question',$question->id) }}"><i class="fa fa-times text-danger" title="Supprimer la question"></i></a>
							</td>
						@endif	
					
					@endif
						
				</tr>	
			@endforeach
			</tbody> 
		</table> 
		</form> 
	</div> 
</section>

@endsection