@extends('layouts.app')

@section('content')
@if(!empty($question))
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="{{ route($route_back) }}">{{ $libelle }}</a></li> 
	<li class="active">Question N°{{ Stdfn::truncateN($question->id,5) }}</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Question N°{{ Stdfn::truncateN($question->id,5) }}</h3>
</div>

@if(Session::has('warning'))
	<div class="alert alert-warning">
	  {{Session::get('warning')}}
	</div>
@endif

<style type="text/css">
<!--
.title{
	padding:0px 15px;
}

.dz-preview, .dz-file-preview {
    display: none;
}
#table_justifs{
    border: 1px solid #eee;
	margin-top:0px;
}
#table_justifs th{
    background:#eee;	
}


.select-checkbox option::before {
  content: "\2610";
  width: 1.3em;
  text-align: center;
  display: inline-block;
}
.select-checkbox option:checked::before {
  content: "\2611";
}


ul.no_liste_item li {
  list-style:none;
}

.bold{font-weight:bold;}

-->
</style>

<div class="panel panel-default"> 

		<div class="col-lg-12" style="padding-top:15px;padding-left: 0px;padding-right: 0px;"> 
		<div class="row0"> 
			
			<div class="col-sm-12"> 
				<section class="panel panel-default"> 
					<header class="panel-heading bg-info lt no-border title"> 
						<div class="clearfix"> 
							<div class="clear"> 
							<div class="h3 m-t-xs m-b-xs text-white">
							<small style="color:white;">Informations sur la question</small>
							<i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i> 
							</div>  
							</div> 
						</div> 
					</header> 
					<div class="list-group no-radius alt"> 
						<div class="list-group-item"> 
							<span class="badge bg-light" style="background: none;"><span class="label label-default" style="font-size: 100%;">{{ Stdfn::truncateN($question->id,5) }}</span></span> 
							<i class="fa fa- icon-muted"></i> Numéro 
						</div> 
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $question->question_fr }}</span> 
							<i class="fa fa- icon-muted"></i> Question FR 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $question->bonne_reponse }}</span> 
							<i class="fa fa- icon-muted"></i> Bonne réponse 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $question->mauvaise_reponse_1 }}</span> 
							<i class="fa fa- icon-muted"></i>Mauvaise réponse 1 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $question->mauvaise_reponse_2 }}</span> 
							<i class="fa fa- icon-muted"></i>Mauvaise réponse 2 
						</span>			
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $question->categorie_libelle }}</span> 
							<i class="fa fa- icon-muted"></i>Catégorie 
						</span>			
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ $question->niveau_libelle }}</span> 
							<i class="fa fa- icon-muted"></i>Niveau 
						</span>		
						<span class="list-group-item"> 
							<span class="badge bg-light">{{ Stdfn::dateTimeFromDB($question->question_date_creation) }}</span> 
							<i class="fa fa- icon-muted"></i> Date d'enregistrement
						</span>
						<span class="list-group-item"> 
							<span class="badge " style="background:none;"><span class="label label-{{ strtolower(str_replace(' ', '',$question->statut)) }}">{{ $question->statut }}</span></span> 
							<i class="fa fa- icon-muted"></i> Statut 
						</span>
						
					</div> 
					
				</section>
			</div>
			
			
		</div> 
		</div> 
		
		<br style="clear:both;"/>	
</div>

			<div class="line line-lg pull-in"></div>
				
			
		 
		
		</div>
		
	</div>

		</div>

	</div>


@else

<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="{{ route('questions') }}">Questions</a></li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">Question introuvable</h3> 
</div>

<div class="panel"> 

	<div class="col-lg-12" style="padding:15px;"> 
		La question que vous recherchez n'a pas été trouvé!
	</div> 
	
	<br style="clear:both;"/>
	
</div>	

@endif

@endsection