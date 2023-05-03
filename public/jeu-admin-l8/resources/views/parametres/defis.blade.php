@extends('layouts.app')

@section('content')

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{route('home')}}"><i class="fa fa-home"></i> Accueil</a></li>
	<li class="active">Defis</li> 
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
	<h3 class="m-b-none">Gestion des défis</h3> 
</div>


<div class="panel panel-default"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3" class="active"><span class="badge"><i class="fa fa-plus" ></i></span>Nouveau défi</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<form method="post" action="{{route('SaveDefi')}}" class="form-horizontal">
			
			{!! csrf_field() !!}
			
			<div class="step-pane active" id="step1"> 
			
				<div class="form-group{{ $errors->has('montant') ? ' has-error' : '' }}">
					
					<div class="col-md-12">
						<div class="col-md-4">
							<span> Montant <span class="text text-danger">*</span></span>
							<input placeholder="" type="text" class="form-control" name="montant"  value="{{ old('Montant') }}" required>
						</div>
						<div class="col-md-4">
							<span> Date <span class="text text-danger">*</span></span>
							<input readonly type="date" class="form-control" name="date"  value="{{ gmdate('Y-m-d') }}" required>
						</div>
						<div class="col-md-4 ">
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
	<header class="panel-heading"> Liste des défis
	</header> 
	
	<div class="table-responsive"> 
		<table id="reunions" class="table table-striped m-b-none datatable"> 
			<thead> 
				<tr>
					<th style="display:none;" width="">N°</th>
					<th width="">Montant</th>
					<th width="">Date</th>
					<th width="">Statut</th>
					<th width="">Action</th>
				</tr> 
			</thead> 
			<tbody>
			@foreach($defis as $defi)
				<tr>
					<td style="display:none;">{{ $defi->defi_id}}</td> 
					<td>{{ number_format($defi->defi_montant, 0, ' ',' ') }}</td>
					<td>{{ Stdfn::dateFromDB($defi->defi_date) }}</td>
					<td>{{ $defi->defi_statut }}</td>
					<td><span class="btnSupprimerDefi" data-defi_id="{{$defi->defi_id}}" style="cursor: pointer;"><i class="fa fa-times text-danger" title="Supprimer cette défi"></i></a></td> 
				</tr>	
			@endforeach
			</tbody> 
		</table> 
	</div> 
</section>

@endsection