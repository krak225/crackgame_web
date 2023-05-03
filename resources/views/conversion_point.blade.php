@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>  
	<li><a href="{{route('home')}}"> Conversion</a></li>  
	<li class="active">Conversion de point</li> 
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
	<h3 class="m-b-none">Faire une conversion de point</h3> 
</div>


<div class=" panel panel-default wizard" style="padding:5px;">
 
	<div class="col-md-6 panel panel-default wizard"> 

		<div class="wizard-steps clearfix row" id="form-wizard"> 
			<ul class="steps"> 
				<li data-target="#step1" class=" "><span class="badge"><i class="fa fa-edit"></i></span> Formulaire de conversion</li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
			
			<div id="infoBox" class="alert">
			  
			</div>
			
			<form id="formConversionPoint" method="post" class="form-horizontal" action="{{route('ConversionPoint')}}">
				
				{!! csrf_field() !!}
				
				<div class="step-pane active" id="step1">
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Points de test de connaissance disponible:</label> 
						<div class="col-sm-7">
							<input type="text" id="point_actuel" name="point_actuel" class="form-control" value="{{$total_points_test}}" disabled required > 
						</div> 
					</div> 
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Points à convertir:</label> 
						<div class="col-sm-7">
							<input type="number" id="point_a_convertir" name="point_a_convertir" class="form-control" required > 
						</div> 
					</div> 
					
					<div class="form-group">
						<label class="col-sm-5 control-label">Points de duel obtenu</label> 
						<div class="col-sm-7">
							<input type="text" id="montant_obtenu" class="form-control" disabled> 
						</div> 
					</div> 
					
				</div> 
				
				<div class="line line-lg pull-in"></div>
				
				<div class="actions pull-right"> 
					
					<button type="reset" class="btn btn-info btn-sm">Annuler</button> 
					<button type="submit" class="btn btn-primary btn-sm">Convertir</button> 
					
				</div> 
				
			</form>
				
		</div>
		
		
	</div>

	<div class="col-md-6 panel panel-default wizard pull-right" style="border-left:0px;"> 
		
		<div class="wizard-steps clearfix row"> 
			<ul class="steps"> 
				<li data-target="#step2"><span class="badge"><i class="fa fa-book"></i></span> Règles de conversion </li>
			</ul> 
		</div> 

		<div class="step-content clearfix"> 
			<p>
			La conversion de point est une opération qui consiste à convertir vos gains obtenus au cours des Tests de connaissance que vous avez joué, en monaie électronique 	
			</p>
			<p>
			Avant de pouvoir effectuer cette oppération, vous devez avoir "Acitvé" votre souscription du jour. 
			</p>
			<p>
			Le taux de conversion est de 25%
			</p>
		</div>
		
		
	</div>
	
	<div class="clearfix"></div>

</div>

@endsection