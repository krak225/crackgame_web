@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Mon compte</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Modifier mes données personnelles</h3> 
</div>


<section class="panel panel-default"> 
	<div class="row m-l-none m-r-none bg-light lter">
	
		@if (session('message'))
		<div class="alert alert-success">
			{{ session('message') }}
		</div>
		@endif
		
		@if (session('warning'))
		<div class="alert alert-warning">
			{{ session('warning') }}
		</div>
		@endif
		
		<form method="post" class="form-horizontal" action="{{route('UpdatePerso')}}">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1" style="padding-top:20px"> 
			
				<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
					<label for="nom" class="col-md-4 control-label">Nom <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="nom" type="text" class="form-control" name="nom" value="{{ $user->nom }}" required autofocus>

						@if ($errors->has('nom'))
							<span class="help-block">
								<strong>{{ $errors->first('nom') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('prenoms') ? ' has-error' : '' }}">
					<label for="prenoms" class="col-md-4 control-label">Prénoms <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="prenoms" type="text" class="form-control" name="prenoms" value="{{ $user->prenoms }}" required>

						@if ($errors->has('prenoms'))
							<span class="help-block">
								<strong>{{ $errors->first('prenoms') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('date_naissance') ? ' has-error' : '' }}">
					<label for="date_naissance" class="col-md-4 control-label">Date de naissance <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="date_naissance" type="date" class="form-control" name="date_naissance" value="{{ $user->date_naissance }}" required>

						@if ($errors->has('date_naissance'))
							<span class="help-block">
								<strong>{{ $errors->first('date_naissance') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				
				<!--div class="form-group{{ $errors->has('lieu_naissance') ? ' has-error' : '' }}">
					<label for="lieu_naissance" class="col-md-4 control-label">Lieu de naissance <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="lieu_naissance" type="text" class="form-control" name="lieu_naissance" value="{{ $user->user_LIEU_NAISSANCE }}" required>

						@if ($errors->has('lieu_naissance'))
							<span class="help-block">
								<strong>{{ $errors->first('lieu_naissance') }}</strong>
							</span>
						@endif
					</div>
				</div-->
				
				<div class="form-group{{ $errors->has('sexe') ? ' has-error' : '' }}">
					<label for="sexe" class="col-md-4 control-label">Sexe <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="sexe" class="form-control" name="sexe"  required>
							<option></option>
							<option @if($user->sexe == "Masculin") selected @endif value="Masculin">Masculin</option>
							<option @if($user->sexe == "Feminin") selected @endif value="Feminin">Feminin</option>
						</select>
						
						@if ($errors->has('sexe'))
							<span class="help-block">
								<strong>{{ $errors->first('sexe') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('sexe') ? ' has-error' : '' }}">
					<label for="sexe" class="col-md-4 control-label">Pays d'origine <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="sexe" class="form-control" name="pays_origine_id"  required>
							<option></option>
							@foreach($pays_origine as $pays)
							
							@if($pays->pays_id == $user->pays_origine_id){ 
								<?php $selected = ' selected '; ?>
							@else
								<?php $selected = '  '; ?>
							@endif
							
							<option {{ $selected }} value="{{ $pays->pays_id }}">{{ $pays->pays_nom_fr }}</option>
							@endforeach
						</select>

						@if ($errors->has('quartier_id'))
							<span class="help-block">
								<strong>{{ $errors->first('quartier_id') }}</strong>
							</span>
						@endif
						</select>
						
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('sexe') ? ' has-error' : '' }}">
					<label for="sexe" class="col-md-4 control-label">Pays de résidence <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="sexe" class="form-control" name="pays_residence_id"  required>
							<option></option>
							@foreach($pays_residence as $pays)
							
							@if($pays->pays_id == $user->pays_residence_id){ 
								<?php $selected = ' selected '; ?>
							@else
								<?php $selected = '  '; ?>
							@endif
							
							<option {{ $selected }} value="{{ $pays->pays_id }}">{{ $pays->pays_nom_fr }}</option>
							@endforeach
						</select>

						
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('ville') ? ' has-error' : '' }}">
					<label for="ville" class="col-md-4 control-label">Ville <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input id="ville" type="text" class="form-control" name="ville" value="{{ $user->ville }}" required style="padding-top:0px;">

						@if ($errors->has('ville'))
							<span class="help-block">
								<strong>{{ $errors->first('ville') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('adresse') ? ' has-error' : '' }}">
					<label for="adresse" class="col-md-4 control-label">Adresse <span class="text text-danger">&nbsp;<span></label>

					<div class="col-md-4">
						<input id="adresse" type="text" class="form-control" name="adresse" value="{{ $user->adresse }}">

						@if ($errors->has('adresse'))
							<span class="help-block">
								<strong>{{ $errors->first('adresse') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('code_postal') ? ' has-error' : '' }}">
					<label for="code_postal" class="col-md-4 control-label">Code postale <span class="text text-danger">&nbsp;<span></label>

					<div class="col-md-4">
						<input id="code_postal" type="text" class="form-control" name="code_postal" value="{{ $user->code_postal }}">

						@if ($errors->has('code_postal'))
							<span class="help-block">
								<strong>{{ $errors->first('code_postal') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('telephone_mobile') ? ' has-error' : '' }}">
					<label for="telephone_mobile" class="col-md-4 control-label">Téléphone <span class="text text-danger">*<span></label>

					<div class="col-md-4">
					
						<div class="input-group m-b">
						<span class="input-group-addon">+225</span>
						<input id="telephone_mobile" type="text" class="form-control" name="telephone" value="{{ str_replace('+225','',$user->telephone) }}" required>
						</div>
						@if ($errors->has('telephone_mobile'))
							<span class="help-block">
								<strong>{{ $errors->first('telephone_mobile') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				
			
			<div class="col-md-12" style="padding-bottom:15px;"> 
				
				<div class="line line-lg pull-in"></div>
			
				<div class="actions pull-right"> 
					<input type="hidden" name="profil_id" value="2"> 
					<button type="reset" class="btn btn-warning btn-sm">Annuler</button> 
					<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button> 
				</div>
				
			
			</div>
			
				
			</div>
				
				
		</form>
		
	</div>
	
</section>



@endsection