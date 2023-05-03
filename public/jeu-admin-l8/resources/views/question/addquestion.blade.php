@extends('layouts.app')

@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="#"> {{ $libelle }}</a></li> 
	<li class="active">Ajouter une question</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Ajouter une question</h3> 
</div>

@if(Session::has('message'))
	<div class="alert alert-success">
	  {{Session::get('message')}}
	</div>
@endif

@if(Session::has('warning'))
	<div class="alert alert-warning">
	  {{Session::get('warning')}}
	</div>
@endif


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3"><span class="badge"></span>Saisissez une question, proposez trois réponses et précisez la réponse correcte</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form enctype="multipart/form-data" id="form_add_question" method="post" class="form-horizontal" action="{{route('SaveQuestion')}}">
			
			{!! csrf_field() !!}
			
			<input type="hidden" class="form-control" name="type_jeu_id" value="{{ $type_jeu_id }}" required>
			
			<div class="step-pane active" id="step1"> 
					
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="question_" class="col-md-3 control-label">Question</label>

					<div class="col-md-9">
						<input maxlength="255" id="question_" type="text" class="form-control" name="question" value="{{ old('question') }}" required autofocus>
					</div>
				</div>

				<div class="form-group{{ $errors->has('proposition_1') ? ' has-error' : '' }}">
					<label for="proposition_1" class="col-md-3 control-label">Bonne réponse</label>

					<div class="col-md-9">
						<input id="proposition_1" type="text" class="form-control" name="proposition_1" value="{{ old('proposition_1') }}" required>
					</div>
				</div>

				<div class="form-group{{ $errors->has('proposition_2') ? ' has-error' : '' }}">
					<label for="proposition_2" class="col-md-3 control-label">Mauvaise réponse 1</label>

					<div class="col-md-9">
						<input id="proposition_2" type="text" class="form-control" name="proposition_2" value="{{ old('proposition_2') }}" required>
					</div>
				</div>

				<div class="form-group{{ $errors->has('proposition_3') ? ' has-error' : '' }}">
					<label for="proposition_3" class="col-md-3 control-label">Mauvaise réponse 2</label>

					<div class="col-md-9">
						<input id="proposition_3" type="text" class="form-control" name="proposition_3" value="{{ old('proposition_3') }}" required>
					</div>
				</div>

				<div class="form-group{{ $errors->has('categorie_id') ? ' has-error' : '' }}">
					<label class="col-md-3 control-label">Catégorie</label>

					<div class="col-md-3">
						<select id="categorie_id" class="form-control" name="categorie_id" required>
							<option value="">Choisir</option>
							@foreach($categories as $categorie)
							<option value="{{ $categorie->categorie_id }}">{{ $categorie->categorie_libelle }}</option>
							@endforeach
						</select>
					</div>
					
					@if($type_jeu_id == 2)
					<label class="col-md-2 control-label">Niveau</label>

					<div class="col-md-3">
						<select id="niveau_id" class="form-control" name="niveau_id" required>
							<option value="">Choisir</option>
							@foreach($niveaux as $niveau)
							<option value="{{ $niveau->niveau_id }}">{{ $niveau->niveau_libelle }}</option>
							@endforeach
						</select>
					</div>
					@endif
					
				</div>

			</div> 
			
			
			<div class="line line-lg pull-in"></div>
			
			<div class="actions pull-right"> 
				<button type="reset" class="btn btn-danger btn-sm">Annuler</button> 
				<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button> 
			</div>
			
		</form>
		
		 
	
	</div>
	
	
	
	
	
</div>
 
@endsection