@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Mon compte</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Modifier mes données du compte</h3> 
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
		
		<form method="post" class="form-horizontal" action="{{route('UpdateCompte')}}">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1" style="padding-top:20px"> 
			
				<div class="form-group{{ $errors->has('pseudo') ? ' has-error' : '' }}">
					<label for="pseudo" class="col-md-4 control-label">Pseudo <span class="text text-danger">*<span></label>

					<div class="col-md-4">
						<input readonly id="pseudo" type="text" class="form-control" name="pseudo" value="{{ $user->pseudo }}" required autofocus>

						@if ($errors->has('pseudo'))
							<span class="help-block">
								<strong>{{ $errors->first('pseudo') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('adresse_email') ? ' has-error' : '' }}">
					<label for="adresse_email" class="col-md-4 control-label">E-mail <span class="text text-danger" id="adresse_email">&nbsp;<span></label>

					<div class="col-md-4">
						<input readonly id="adresse_email" type="email" class="form-control" name="adresse_email" value="{{ $user->adresse_email }}" required>

						@if ($errors->has('adresse_email'))
							<span class="help-block">
								<strong>{{ $errors->first('adresse_email') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				
				<div class="form-group{{ $errors->has('devise') ? ' has-error' : '' }}">
					<label for="devise" class="col-md-4 control-label">Monaie <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="devise" class="form-control" name="devise"  required>
							<option></option>
							<option @if($user->devise == "USD") selected @endif value="USD">USD</option>
							<option @if($user->devise == "EUR") selected @endif value="EUR">Euro</option>
							<option @if($user->devise == "FCFA") selected @endif value="FCFA">FCFA</option>
						</select>
						
						@if ($errors->has('devise'))
							<span class="help-block">
								<strong>{{ $errors->first('devise') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				
				<div class="form-group{{ $errors->has('langue') ? ' has-error' : '' }}">
					<label for="langue" class="col-md-4 control-label">Langue <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="langue" class="form-control" name="lan_code"  required>
							<option></option>
							<option @if($user->lang_code == "fr") selected @endif value="fr">Français</option>
							<option @if($user->lang_code == "en") selected @endif value="en">Anglais</option>
						</select>
						
						@if ($errors->has('langue'))
							<span class="help-block">
								<strong>{{ $errors->first('langue') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				
			
				<div class="form-group{{ $errors->has('communaute') ? ' has-error' : '' }}">
					<label for="communaute" class="col-md-4 control-label">Communauté <span class="text text-danger">&nbsp;</span></label>

					<div class="col-md-4">
						<select id="communaute" class="form-control" name="communaute"  required>
							<option></option>
							<option value="Experts">Experts</option>
							<option value="Génies">Génies</option>
							<option value="Pro">Pro</option>
						</select>
						
						@if ($errors->has('communaute'))
							<span class="help-block">
								<strong>{{ $errors->first('communaute') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group">
					<label for="parrain" class="col-md-4 control-label">Parrain</label>

					<div class="col-md-4">
						<input id="parrain" type="parrain" class="form-control" name="parrain" placeholder="Pseudo du parrain" value="{{ Auth::user()->parrain }}">
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