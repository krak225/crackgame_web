@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>   
	<li class="active">Souscription quiz</li> 
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
	<h3 class="m-b-none">Souscription quiz</h3> 
</div>


<div class=" panel panel-default wizard" style="padding:5px;">
 
	<div class="col-md-6 panel panel-default wizard"> 

		<div class="wizard-steps clearfix row" id="form-wizard"> 
			<ul class="steps"> 
				<li data-target="#step1" class=" "><span class="badge"><i class="fa fa-edit"></i></span> Formulaire de souscription</li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
			
			<div id="infoBox" class="alert">
			  
			</div>
			
			<form id="formDepot" method="post" class="form-horizontal" action="{{route('SaveSouscriptionQuiz')}}">
				
				{!! csrf_field() !!}
				
				<div class="step-pane active" id="step1">
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Montant ({{Auth::user()->devise}}):</label> 
						<div class="col-sm-7">
							<select id="objectif_financier" name="objectif_financier" class="form-control" required >
								<option value="500">500 FCFA</option>
								<option value="1000">1000 FCFA</option>
								<option value="2000">2000 FCFA</option>
								<option value="3000">3000 CFA</option>
								<option value="4000">4000 CFA</option>
								<option value="5000">5000 CFA</option>
							</select>
						</div> 
					</div> 
					
				</div> 
				
				<div class="line line-lg pull-in"></div>
				
				<div class="actions pull-right"> 
					
					<button type="reset" class="btn btn-info btn-sm">Annuler</button> 
					<button type="submit" class="btn btn-primary btn-sm">Valider</button> 
					
				</div> 
				
			</form>
				
		</div>
		
		
	</div>

	<div class="col-md-6 panel panel-default wizard pull-right" style="border-left:0px;"> 
		
		<div class="wizard-steps clearfix row"> 
			<ul class="steps"> 
				<li data-target="#step2"><span class="badge"><i class="fa fa-book"></i></span> Consignes </li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
			
		</div>
		
		
	</div>
	
	<div class="clearfix"></div>

</div>

@endsection