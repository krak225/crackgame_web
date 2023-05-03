@extends('layouts.app')

@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li class="active">Création de compte</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Création de compte</h3> 
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
<style type="text/css">.control-label{text-align: left;}</style>
<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3"><span class="badge"></span>Informations</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form enctype="multipart/form-data"  method="post" class="form-horizontal" id="formRegister" action="{{route('register')}}">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1"> 
			
				
				<div class="col-md-5"> 
					<!--div class="header">Informations du compte</div--> 
							

					<div class="form-group{{ $errors->has('pseudo') ? ' has-error' : '' }}">
						<label for="pseudo" class="col-md-5 control-label">Pseudo <span class="text text-danger">*</span></label>

						<div class="col-md-7">
							<input id="pseudo" type="text" class="form-control" name="pseudo" value="{{ old('pseudo') }}" required>

							@if ($errors->has('pseudo'))
								<span class="help-block">
									<strong>{{ $errors->first('pseudo') }}</strong>
								</span>
							@endif
						</div>
					</div>


					<div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
						<label for="telephone" class="col-md-5 control-label">Téléphone <span class="text text-danger">*</span></label>

						<div class="col-md-7">
							<div class="input-group m-b">
							<span class="input-group-addon" id="indicatif">+225</span>
							<input id="telephone" type="text" class="form-control telephone" name="telephone" value="{{ old('telephone') }}" required>
							</div>
							@if ($errors->has('telephone'))
								<span class="help-block">
									<strong>{{ $errors->first('telephone') }}</strong>
								</span>
							@endif
						</div>
					</div>

				</div>

				<div class="col-md-5"> 
					<!--div class="header">Informations du compte</div--> 
						
					<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password" class="col-md-5 control-label">Mot de passe <span class="text text-danger">*</span></label>

						<div class="col-md-7">
							<input id="password" type="password" class="form-control" name="password" required>

							@if ($errors->has('password'))
								<span class="help-block">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group">
						<label for="password-confirm" class="col-md-5 control-label">Confirmer mot de passe <span class="text text-danger">*</span></label>

						<div class="col-md-7">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						</div>
					</div>
					
				</div>
					
				
			</div> 
			
			
			
			<div class="col-md-12"> 
				
				<div class="line line-lg pull-in"></div>
			
				<div class="actions pull-right"> 
					<input type="hidden" name="profil_id" value="2"> 
					<button type="reset" class="btn btn-warning btn-sm">Annuler</button> 
					<button type="submit" class="btn btn-primary btn-sm">ENREGISTRER</button> 
				</div>
			</div>
			
		</form>
		
		 
	
	</div>
	
	
	
	
	
</div>
 
@endsection