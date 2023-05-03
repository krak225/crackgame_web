@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="{{route('home')}}"> Opération</a></li>  
	<li class="active">Retrait</li> 
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
	<h3 class="m-b-none">Faire un retrait</h3> 
</div>


<div class=" panel panel-default wizard" style="padding:5px;">
 
	<div class="col-md-6 panel panel-default wizard"> 

		<div class="wizard-steps clearfix row" id="form-wizard"> 
			<ul class="steps"> 
				<li data-target="#step1" class=" "><span class="badge"><i class="fa fa-edit"></i></span> Formulaire de dépot</li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
			
			<div id="infoBox" class="alert">
			  
			</div>
			
			<form id="formDepot" method="post" class="form-horizontal" action="{{route('SaveRetrait')}}">
				
				{!! csrf_field() !!}
				
				<div class="step-pane active" id="step1">
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Solde disponible:</label> 
						<div class="col-sm-7">
							<label class="form-control" style="font-weight:bold;">{{Auth::user()->money}}</label>
						</div> 
					</div> 
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Montant:</label> 
						<div class="col-sm-7">
							<input type="text" id="montant" name="montant" class="form-control" required > 
						</div> 
					</div> 
					
				</div> 
				
				<div class="line line-lg pull-in"></div>
				
				<div class="actions pull-right"> 
					
					<button type="reset" class="btn btn-info btn-sm">Annuler</button> 
					<button type="submit" class="btn btn-primary btn-sm">Valider le retrait</button> 
					
				</div> 
				
			</form>
				
		</div>
		
		
	</div>

	<div class="col-md-6 panel panel-default wizard pull-right" style="border-left:0px;"> 
		
		<div class="wizard-steps clearfix row"> 
			<ul class="steps"> 
				<li data-target="#step2"><span class="badge"><i class="fa fa-book"></i></span> Informations </li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
			<p>
			Lorsque vous faites une demande de retrait, cette demande est reçu et traité par le Service Financier de crackgame sous 24H.
			</p>
		</div>
		
		
	</div>
	
	<div class="clearfix"></div>

</div>

@endsection