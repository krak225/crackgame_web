@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Recompenses</li> 
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
	<h3 class="m-b-none">Gestion des récompenses</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouvelle récompense</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="{{route('SaveRecompense')}}" class="form-horizontal">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group">
					
					<div class="col-md-12">
						<div class="col-md-3">
							<span> Date <span class="text text-danger">*</span></span>
							<input readonly type="date" class="form-control" name="recompense_date" value="{{ gmdate('Y-m-d') }}" required>
						</div>
						<div class="col-md-3">
							<span> Type de classement <span class="text text-danger">*</span></span>
							<select class="form-control" name="type_classement_id" required>
								<option value="">Choisir</option>
								@foreach($types_classements as $type_classement)
								<option value="{{$type_classement->type_classement_id}}">{{ $type_classement->type_classement_libelle }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-2">
							<span> Rang <span class="text text-danger">*</span></span>
							<select id="rang" class="form-control" name="rang" required>
								<option value="">Choisir</option>
								<option value="1">1er</option>
								<option value="2">2è</option>
								<option value="3">3è</option>
								<option value="4">4è</option>
								<option value="5">5è</option>
							</select>
						</div>
						<div class="col-md-2">
							<span> Montant <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="montant"  value="{{ old('Montant') }}" required>
						</div>
						<div class="col-md-2 ">
							<span> &nbsp;<span class="text text-danger"></span></span>
							<div class="form-control " style="padding:0px;border:none;">
								<button type="submit" class="btn btn-success btn-sm">ENREGISTRER</button> 
							</div>
						</div>
					</div>
					
				</div>

				
			</div> 
			
		</form>
		
		 
	
	</div>
	
	
</div>


<section class="panel panel-default"> 
	<header class="panel-heading"> Liste des récompenses
	</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th style="display:none;" width="">N°</th>
					<th width="">Date</th>
					<th width="">Type classement</th>
					<th width="">Rang</th>
					<th width="">Montant</th>
					<th width="">Statut</th>
					<th width="">Action</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($recompenses as $recompense)
				<tr>
					<td style="display:none;">{{ $recompense->recompense_id}}</td> 
					<td>{{ Stdfn::dateFromDB($recompense->recompense_date) }}</td>
					<td>{{ $recompense->type_classement_libelle }}</td>
					<td>{{ $recompense->recompense_rang }}</td>
					<td>{{ number_format($recompense->recompense_montant, 0, ' ',' ') }}</td>
					<td>{{ $recompense->recompense_statut }}</td>
					<td><span class="btnSupprimerRecompense" data-recompense_id="{{$recompense->recompense_id}}" style="cursor: pointer;"><i class="fa fa-times text-danger" title="Supprimer cette récompense"></i></a></td> 
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection