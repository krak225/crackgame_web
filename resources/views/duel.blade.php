@extends('layouts.app')

@section('content')
<ul class="breadcrumb no-border no-radius b-b b-light pull-in"> 
	<li><a href="{{ route('home') }}"><i class="fa fa-home"></i> Accueil</a></li> 
	<li><a href="{{ route('duels') }}"><i class="fa fa-play"></i> Mes duels</a></li> 
	<li class="active">Duel N° {{$duel_id}}</li> 
</ul> 

<div class="m-b-md"> 
	<h3 class="m-b-none">JEU DE DUEL</h3> 
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


<div class="panel panel-default page_duel" id="PageDuel"> 

	<div class="wizard-steps clearfix" id="form-wizard"> 
		<ul class="steps"> 
			<li data-target="#step3"><span class="badge"></span>DUEL N° {{$duel_id}}</li>
		</ul> 
	</div> 

	<div class="step-content clearfix"> 
		<div id="ESPACEDEJEU">
			
			<div class="col-md-2 text-center" id="boxJoueur2"> 
				
				<div class="col-md-12"> 
					<button id="myScoreBox" type="button" class="btn btn-info btn-sm rounded circle"><span id="score">{{$my_score}}</span> <i class="fa fa-star"></i></button> 
				</div>
				
				<div class="player_photo col-md-12" style="margin-top:3px;">
					<input class="usernameInput" type="hidden" maxlength="14" value="{{ ucfirst(strtolower(Auth::user()->pseudo )) }}"/>
					<input id="my_user_id" type="hidden" value="{{Auth::user()->id}}"/>
					<input id="to_user_id" type="hidden" value="{{$adversaire_id}}"/>
					<input id="to_user_pseudo" type="hidden" value="{{ ucfirst($adversaire->pseudo) }}"/>
		  
					<img class="rounded" src="{{ asset('images/avatars/'. Auth::user()->photo ) }}" alt="" style="width: 75px;" />
					
				</div>
				
				
				<div class="player_name">{{ '@'.Auth::user()->pseudo }}</div>
			
				<div class="line"></div>
			
				<div id="MesQuestionsView" style="display:none;">
				<div class="row" id="boxMesQuestions">
					
					<div class="bloc_name">Questions</div>
					
					<div class="row" >
						@foreach($questions as $question)
						@if($question->statut_selection == 'SELECTED')
						<button 
						@if(!Stdfn::isUsedInDuel($duel_id,$question->id))
							class="question_to_choose btn btn-warning btn-sm"
							data-id="{{$question->id}}" 
							data-question="{{$question->question}}"
							data-propositionA="{{$question->propositionA}}"
							data-propositionB="{{$question->propositionB}}"
							data-propositionC="{{$question->propositionC}}"
							data-question="{{$question->question_fr}}"
						@else
							class="btn btn-gray btn-sm question_used"
						@endif
						title="{{$question->question}}"
						>Q {{$question->id}}</button>
						
						
						@endif
						@endforeach
					</div>
					
					<div class="line"></div>
					
					<div class="col-md-12" style="display:none;">
						<div class="bloc_name">Jockers</div>
						<div id="vies">
							@if($jockers_disponibles == 3)
							<span id="jocker3" class="btn jocker"></span>
							<span id="jocker2" class="btn jocker"></span>
							<span id="jocker1" class="btn jocker"></span>
							@endif
							
							@if($jockers_disponibles == 2)
							<span id="jocker3" class="btn jocker"></span>
							<span id="jocker2" class="btn jocker"></span>
							<span id="jocker1" class="btn jocker elimine"></span>
							@endif
							
							@if($jockers_disponibles == 1)
							<span id="jocker3" class="btn jocker"></span>
							<span id="jocker2" class="btn jocker elimine"></span>
							<span id="jocker1" class="btn jocker elimine"></span>
							@endif
							
							@if($jockers_disponibles == 0)
							<span id="jocker3" class="btn jocker elimine"></span>
							<span id="jocker2" class="btn jocker elimine"></span>
							<span id="jocker1" class="btn jocker elimine"></span>
							@endif
						</div>
					</div>
				</div>
				</div>
				
			</div> 
			
			<div class="col-md-8 text-center"> 
				
				<div id="jeu"> 
				
					<div id="StartView" style="display:none0"> 
						<div style="padding:90px 0px;">
							<h1>DUEL</h1>
							<h2>{{ ucfirst(Auth::user()->pseudo) }} vs {{ ucfirst($adversaire->pseudo) }}</h2>
							<div></div>
						</div> 
					</div>
					
					<div id="PauseView" style="display:none"> 
						<div style="padding:130px 0px;">
							<h1><i class="fa fa-pause"></i> PAUSE</h1>
							<div>Vous avez mis le jeu en pause!</div>
						</div> 
					</div> 
					
					<div id="EndView" style="display:none"> 
						<div style="padding:130px 0px;">
							<h1><i class="fa fa-stop"></i> DUEL TERMINE</h1>
							<div id="texte_fin">Le duel est terminé!</div>
						</div> 
					</div> 
					
					<div id="InfoView" style="display:none"> 
						<div style="padding:130px 30px;">
							<h2 id="infoTexte">
								Welcome on crackgame!
							</h2>
						</div> 
					</div> 
					
					<div id="GameView" style="display:none;"> 
						
						<div class="col-md-12" id="boxQuestion"> 
							
							<table class="table table-striped m-b-none datatable " style="display:none;">
								<tbody class="messages">	
								</tbody>	
							</table>
							
							<div id="questionAuthor"> 
								
							</div>
							
							<input type="hidden" id="duel_id" value="{{$duel_id}}"> 
							<input type="hidden" id="question_id"> 
							<div class="col-md-12" id="questionBox" style="height:70px;"> 
								<div id="boxCptQuestion" style="display:none;height:1px;"> <span id="cptQuestion0"></span>: </div> 
								<div id="question" style="border-top:0px;padding:10px;font-size:18px;"> 
									
								</div>
							</div>
							
						</div>
						
						<div id="boxDetailsQuestion" style="display:none;font-weight:bold;font-size:20px;" >
							Détails d'une question
						</div>
						
						<div id="boxPropositions">
						
							<br style="clear:both;"/>
							
							<div class="line"></div>
							
							<div class="col-md-12 text-left row" style="min-height:155px;border:0px solid red"> 
								<div id="propositionBox"> 
									<form id="formPropositions" method="post"> 
										<input id="question_id" type="hidden" name="question_id">
										<ul class="listePropositions" style="padding:0px;"> 
											<li class="btn btn-gray2 btn-sm btn-proposition" id="btnA" for="checkA"><label><input id="checkA" type="radio" name="reponse" class="reponse" value="A"/> <span id="propositionA" >A</span></label></li>
											<li class="btn btn-gray2 btn-sm btn-proposition" id="btnB" for="checkB"><label><input id="checkB" type="radio" name="reponse" class="reponse" value="B"/> <span id="propositionB" >B</span></label></li>
											<li class="btn btn-gray2 btn-sm btn-proposition" id="btnC" for="checkC"><label><input id="checkC" type="radio" name="reponse" class="reponse" value="C"/> <span id="propositionC" >C</span></label></li>
											<li class="btn btn-gray2 btn-sm " id="btnNA" style="display:none;"><label><input type="radio" name="reponse" class="reponse" value="NA" id="no_answer"><span id="propositionNA" >NA</span></label></li>
										</ul>
									</form>
								</div>
							</div>
								
							<br style="clear:both;"/>
							
						</div> 
						
						<div class="line"></div>
						
						<div id="ActionView" class="actions" style="min-height:35px;">
							<button id="btnConfirmerReponseDuel" style="display:none;" type="button" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> VALIDER LA RÉPONSE</button> 
							<!--button id="btnJePasse_Jocker" style="display:none;" type="button" class="btn btn-warning btn-sm"><i class="fa fa-skyp"></i> JOCKER</button--> 
							<button id="btnAbandonner" type="button" style="display:none;" class="btn btn-danger btn-sm">ABANDONNER</button> 
							<button id="btnConfirmerQuestion" style="display:none;" type="button" class="btn btn-primary btn-sm"><i class="fa fa-send"></i> ENVOYER LA QUESTION</button> 
						</div>
							

					</div> 
					
					<br style="clear:both;"/>
						
				</div> 
				
				
			</div>
			
			<div class="col-md-2 text-center" id="boxJoueur2"> 
						
				<div class="col-md-12"> 
					<button id="AdversaireScoreBox" type="button" class="btn btn-info btn-sm rounded circle"><span id="score_adversaire">{{$score_adversaire}}</span> <i class="fa fa-star"></i></button> 
				</div>
				
				<div class="player_photo col-md-12" style="margin-top:3px;">
				
					<img class="rounded" src="{{ asset('images/avatars/'. $adversaire->photo ) }}" style="width: 75px;"/>
					
				</div>
				
				<div class="player_name col-md-12 ">{{ '@'.$adversaire->pseudo }}</div>
				
			</div>

			<div class="col-md-2 text-center" style="margin-top:10px;"> 
				<div class="label_chrono">Chrono</div>
				<div id="chrono"></div>
				
			</div> 
			
			
		</div>
		
	
	</div>
	
  <link rel="stylesheet" href="{{ URL::asset('css/style_chat.css') }}"/>
  <script src="{{ URL::asset('js/app_kozerie.js') }}"></script>


@endsection