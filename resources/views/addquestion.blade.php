@extends('layouts.app')

@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Ajout des questions</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Formulaire d'ajout des questions</h3> 
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
			
			<div class="step-pane active" id="step1"> 
					
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="question_" class="col-md-4 control-label">Question</label>

					<div class="col-md-4">
						<input placeholder="160 caractères maximum" maxlength="160" id="question_" type="text" class="form-control" name="question" value="{{ old('question') }}" required autofocus>
					</div>
					<div class="col-md-2"><span id="cpt_maxlength" class="label label-warning" style="font-size: 12px;margin-top:5px;">160 caractères restants</span>
					</div>
				</div>

				<div class="form-group{{ $errors->has('proposition_1') ? ' has-error' : '' }}">
					<label for="proposition_1" class="col-md-4 control-label">Bonne réponse</label>

					<div class="col-md-4">
						<input id="proposition_1" type="text" class="form-control" name="proposition_1" value="{{ old('proposition_1') }}" required>
					</div>
				</div>

				<div class="form-group{{ $errors->has('proposition_2') ? ' has-error' : '' }}">
					<label for="proposition_2" class="col-md-4 control-label">Mauvaise réponse 1</label>

					<div class="col-md-4">
						<input id="proposition_2" type="text" class="form-control" name="proposition_2" value="{{ old('proposition_2') }}" required>
					</div>
				</div>

				<div class="form-group{{ $errors->has('proposition_3') ? ' has-error' : '' }}">
					<label for="proposition_3" class="col-md-4 control-label">Mauvaise réponse 2</label>

					<div class="col-md-4">
						<input id="proposition_3" type="text" class="form-control" name="proposition_3" value="{{ old('proposition_3') }}" required>
					</div>
				</div>

				<!--div class="form-group{{ $errors->has('proposition_3') ? ' has-error' : '' }}">
					<label for="proposition_correcte" class="col-md-4 control-label">Proposition Correcte</label>

					<div class="col-md-4">
						<select id="proposition_correcte" class="form-control" name="reponse" required>
							<option value=""></option>
							<option value="A">Proposition 1</option>
							<option value="B">Proposition 2</option>
							<option value="C">Proposition 3</option>
						</select>
					</div>
				</div-->

				
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