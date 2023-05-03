<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Abonnement;
use App\Question;
use App\Categorie;
use App\Entrainement;
use App\EntrainementQuestion;
use App\Chap;
use App\ChapScore;
use App\ChapQuestion;
use App\Duel;
use App\DuelScore;
use App\DuelJocker;
use App\Defi;
use Stdfn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class GameController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }

	
	//
	public function classements(){
		
		$users_duels_points = Duel::getClassementByPointsDuel();
		$users_duels_joues 	= Duel::getClassementByDuelsJoues();
		$users_duels_gagnes = Duel::getClassementByDuelsGagnes();
		
		$params = array(
			'users_duels_points'=>$users_duels_points,
			'users_duels_joues'=>$users_duels_joues,
			'users_duels_gagnes'=>$users_duels_gagnes
		);
		
		return view('classements',$params);
		
	}
	
	
	//ESPACE DE JEU MODE ENTRAINEMENT //
	public function categorie_test(){
		
		$categories = Categorie::where("categorie_statut","VALIDE")->get();
		$params = array('categories'=>$categories);
		return view('categorie_test',$params);
		
	}
	
	
	public function chaps(){
		
		$chaps = Chap::all();
		
		$params = array('chaps'=>$chaps);
				
		return view('chaps',$params);
		
	}
	

	public function chapencours(){
		
		$chap = Chap::where('chap_statut','EN COURS')->first();
		
		if(!empty($chap)){
		
			$chap_id = $chap->chap_id;

			return $this->chap($chap_id);

		}else{

			return back()->with('warning','AUCUN QUIZ CHAP EN COURS');

		}

	}


	public function chap($chap_id){
		
		//vérifier l'étape du chap
		if(Chap::AutorisePlayChap($chap_id)){

			//vérifier si abonnement activé
			if(Auth::user()->statut_abonnement_chap == 'ACTIVE'){
				
				//Vérifier si la selection de question est prete
				$maSelectionQuestion = Question::where(['user_id'=>Auth::user()->id,'statut_selection_chap'=>'SELECTED'])->get();
				$cpt_ma_selection = count($maSelectionQuestion);
				
				if($cpt_ma_selection >= 5){
					
					$chap = Chap::find($chap_id);
					
					if(!empty($chap)){
						
						//si nouvel utilisateur
						$verif = ChapScore::where(['chap_id'=>$chap_id,'user_id'=>Auth::user()->id])->first();
						if(empty($verif)){
							
							//enregistrer sa selection de question dans le panier du chap
							foreach($maSelectionQuestion as $question){
								
								$chap_question 				= new ChapQuestion();
								$chap_question->user_id 	= Auth::user()->id;
								$chap_question->chap_id 	= $chap_id;
								$chap_question->question_id = $question->id;
								$chap_question->save();
								
							}
							

							
							//
							$chapscore = new ChapScore();
							$chapscore->chap_id = $chap_id;
							$chapscore->user_id = Auth::user()->id;
							$chapscore->score   = 0;
							$chapscore->save();

							//incrémenter le nombre de participant
							/*$chap1 = Chap::find($chap_id);
							$nbre_participants = $chap1->chap_participants + 1;
							$chap1->chap_participants = $nbre_participants;
							$chap1->exists = true;
							$chap1->save();
							*/
							//dd($chap1);
							Chap::IncrementParticipant($chap_id);

						}
						
						
						$my_chap_info = ChapScore::where(['chap_id'=>$chap_id,'user_id'=>Auth::user()->id])->first();
						
						$my_chap_score = $my_chap_info->score;
						$my_chap_statut = $my_chap_info->statut;
						
						
								
						$questions = Question::getQuestionChap($chap_id);
						
						foreach($questions as $question){
							if(Auth::user()->lang_code == 'en'){
								
								$question->question 	= $question->question_en;
								$question->propositionA = $question->proposition_a_en;
								$question->propositionB = $question->proposition_b_en;
								$question->propositionC = $question->proposition_c_en;
								
							}else{
								
								$question->question 	= $question->question_fr;
								$question->propositionA = $question->proposition_a_fr;
								$question->propositionB = $question->proposition_b_fr;
								$question->propositionC = $question->proposition_c_fr;
								
							}
						}
						
						
						$params = array('chap'=>$chap,'questions'=>$questions,'my_chap_score'=>$my_chap_score,'my_chap_statut'=>$my_chap_statut);
						
								
						return view('chap',$params);
					
				
					}else{
						
						return back()
								->with('warning', "VEUILLEZ SELECTIONNER UN CHAP");
						
					}
					
				}else{
					
					return back()
						->with('warning', "VEUILLEZ SELECTIONNER VOS 5 QUESTIONS DE CHAP AVANT DE COMMENCER À JOUER");

				}
				
			}else{
				
				return back()
					->with('warning', "VEUILLEZ ACTIVER UNE SOUSCRIPTION AVANT DE JOUER UN CHAP");

			}
			
		}else{
			//return \Redirect::route('chaps')->with('warning',"VOUS N'ETES PAS AUTORISE A JOUER A CETTE ETAPE DU JEU.");
			return \Redirect::route('chaps')->with('warning',"VOUS N'ETES PAS AUTORISE A JOUER .");
		}
		
	}
	
	
	public function resultatschap($chap_id){
		
		$chap = Chap::find($chap_id);
		
		$questions = Question::getQuestionChap($chap_id);
		$resultatschap = Chap::getScoresChap($chap_id);
		// dd($resultatschap);
		foreach($questions as $question){
			if(Auth::user()->lang_code == 'en'){
				
				$question->question 	= $question->question_en;
				$question->propositionA = $question->proposition_a_en;
				$question->propositionB = $question->proposition_b_en;
				$question->propositionC = $question->proposition_c_en;
				
			}else{
				
				$question->question 	= $question->question_fr;
				$question->propositionA = $question->proposition_a_fr;
				$question->propositionB = $question->proposition_b_fr;
				$question->propositionC = $question->proposition_c_fr;
				
			}
		}
		
		// dd($questions);
		$params = array('resultatschap'=>$resultatschap,'questions'=>$questions);
		
		// dd($questions);		
		return view('resultatschap',$params);
		
	}
	
	
	public function entrainement($categorie_id){
		// dd($categorie_id);
		$categorie = Categorie::find($categorie_id);
		// dd($categorie);
		$utilisateurs = User::all();
		$user_id = Auth::user()->id;
		$lang = Auth::user()->lang_code;
		
		$TXT_JE_PASSE 				= ($lang == 'en')? 'SKIP' : 'JE PASSE';
		$TXT_CONFIRMER_MA_REPONSE 	= ($lang == 'en')? 'CONFIRM MY ANSWER' : 'CONFIRMER MA REPONSE';
		
		$params = array('categorie'=>$categorie,'utilisateurs'=>$utilisateurs,'TXT_JE_PASSE'=>$TXT_JE_PASSE,'TXT_CONFIRMER_MA_REPONSE'=>$TXT_CONFIRMER_MA_REPONSE);
		
		
		
		return view('entrainement',$params);
		
		
	}
	
	public function SaveTestConnaissance(Request $request){
		
		//Mettre les autres test à terminé
		$updateData = array('entrainement_statut'=>'TERMINE');
		Entrainement::where(['user_id'=>Auth::user()->id,'entrainement_statut'=>'EN COURS'])->update($updateData);
		
		//Créer le nouveau test
		$entrainement = new Entrainement();
		$entrainement->user_id 							= Auth::user()->id;
		$entrainement->categorie_id 					= $request->categorie_id;
		$entrainement->entrainement_score 				= 0;
		$entrainement->entrainement_compteur_question 	= 1;
		$entrainement->type_jeu 						= $request->type_jeu;
		$entrainement->objectif_financier 				= $request->objectif_financier;
		$entrainement->entrainement_statut 				= 'EN COURS';
		$entrainement->entrainement_date 				= date('Y-m-d H:i:s');
		$entrainement->save();
		
		
		$out = array('statut'=>1,'entrainement_id'=>$entrainement->entrainement_id);
		
		
		echo json_encode($out);
		
	}
	
	
	//
	public function aide(){
		
		return view('aide');
		
	}
	
	//comment jouer un duel
	public function comment_jouer(){
		
		return view('comment_jouer');
		
	}
	
	public function records(){
		
		$records = Entrainement::getRecords(Auth::user()->id);
		
		// dd($records);
		
		$params = array('records'=>$records);
		
		return view('records',$params);
		
	}
	
	
	// ESPACE DE JEU MODE DUEL //
	public function duels($statut = 'all'){
		
		//vérifier qu'il a une active
		
		$duels = Duel::getDuels(Auth::user()->id,$statut);
		
		$params = array('duels'=>$duels);
		
		return view('duels',$params);
		
	
	}
	
	public function CreerDuel($adversaire_id){
		
		//vérifier si abonnement activé
		if(Auth::user()->statut_abonnement == 'ACTIVE'){
			
			//verifier si pas duel entre les deux
			
			$duel_existant = Duel::getDuelExistantJour(Auth::user()->id,$adversaire_id);
			// dd($duel_existant);
			
			if(!isset($duel_existant->duel_id)){
				
				//Créer un duel
				$duel 						= new Duel();
				$duel->user_id 				= Auth::user()->id;
				$duel->adversaire_id 		= $adversaire_id;
				$duel->current_player_id 	= Auth::user()->id;
				$duel->compteur_question 	= 0;
				$duel->connected_users 		= 0;
				$duel->readystate 			= "NOT READY";
				$duel->duel_date_creation 	= date('Y-m-d H:i:s');
				$duel->save();
				
				
				//Créer les lignes de score
				$duel_score  = new DuelScore();
				$duel_score->duel_id = $duel->duel_id;
				$duel_score->user_id = $duel->user_id;
				$duel_score->score 	 = 0;
				$duel_score->save();
				
				$duel_score  = new DuelScore();
				$duel_score->duel_id = $duel->duel_id;
				$duel_score->user_id = $duel->adversaire_id;
				$duel_score->score 	 = 0;
				$duel_score->save();
				
				//Créer les lignes de jockers du duel
				$duel_score  				= new DuelJocker();
				$duel_score->duel_id 		= $duel->duel_id;
				$duel_score->user_id 		= $duel->user_id;
				$duel_score->jocker_utilise = 0;
				$duel_score->save();
				
				$duel_score  				= new DuelJocker();
				$duel_score->duel_id 		= $duel->duel_id;
				$duel_score->user_id 		= $duel->adversaire_id;
				$duel_score->jocker_utilise = 0;
				$duel_score->save();
				
				
				return \Redirect::route('duels')
					->with(['message'=> "INVITATION ENVOYÉE AVEC SUCCÈS",'invitation-envoye'=>'1']);

				
			}else{
				
				return back()
					->with('warning', "VOUS AVEZ DEJA UN DUEL AVEC CET DUELISTE");

			}
			
			
		}else{
			
			return \Redirect::route('duels')
				->with('warning', "VEUILLEZ ACTIVER UNE SOUSCRIPTION AVANT D'INVITER UN DUELISTE");

		}
		
		
		
	}
	
	
	public function RejoindreDuel($duel_id){
		
		//vérifier si abonnement activé
		if(Auth::user()->statut_abonnement == 'ACTIVE'){
				
			$duel = Duel::find($duel_id);
			// dd($duel);
			
			if(isset($duel->duel_id)){
				
				$duel_id = $duel->duel_id;
				
				//valider le jeu 
				$duel->duel_statut = 'VALIDE';
				$duel->duel_date_validation = date('Y-m-d H:i:s');
				$duel->save();
				
			}
			
			return back()
					->with('message', 'DUEL VALIDÉE AVEC SUCCÈS, VOUS POUVEZ JOUER MAINTENANT');
		
		
		}else{
			
			return back()
				->with('warning', "VEUILLEZ ACTIVER UNE SOUSCRIPTION AVANT D'ACCEPTER LE DUEL");

		}
		
	}
	
	
	public function JouerDuel($duel_id,$adversaire_id){
		
		//vérifier si abonnement activé
		if(Auth::user()->statut_abonnement == 'ACTIVE'){
			
			//Vérifier si la selection de question est prete
			$maSelectionQuestion = Question::where(['user_id'=>Auth::user()->id,'statut_selection'=>'SELECTED'])->get();
			$cpt_ma_selection = count($maSelectionQuestion);
			
			if($cpt_ma_selection >= 7){
					
				$duel = Duel::find($duel_id);
				
				$adversaire = User::find($adversaire_id);
				
				if(!empty($duel) && !empty($adversaire)){
					
					$questions = Question::getQuestionsDuel($duel_id);
					$jockers_disponibles = Duel::getJockersDisponibles($duel_id);
					
					foreach($questions as $question){
						if($adversaire->lang_code == 'en'){
							
							$question->question 	= $question->question_en;
							$question->propositionA = $question->proposition_a_en;
							$question->propositionB = $question->proposition_b_en;
							$question->propositionC = $question->proposition_c_en;
							
						}else{
							
							$question->question 	= $question->question_fr;
							$question->propositionA = $question->proposition_a_fr;
							$question->propositionB = $question->proposition_b_fr;
							$question->propositionC = $question->proposition_c_fr;
							
						}
					}
					
					
					$my_score = DuelScore::getScore($duel_id,Auth::user()->id);
					$score_adversaire = DuelScore::getScore($duel_id,$adversaire_id);
					
					$params = array('duel'=>$duel,'duel_id'=>$duel_id,'adversaire'=>$adversaire,'adversaire_id'=>$adversaire_id,'my_score'=>$my_score,'score_adversaire'=>$score_adversaire,'questions'=>$questions,'jockers_disponibles'=>$jockers_disponibles);
					
					return view('duel',$params);
					
					
				}else{
						
					return \Redirect::route('duels')
						->with('warning', "VEUILLEZ CHOISIR UN DUEL");
						
				}
			
			}else{
				
				return back()
					->with('warning', "VEUILLEZ SELECTIONNER VOS 7 QUESTIONS DE DUEL AVANT DE COMMENCER À JOUER");

			}
			
		}else{
			
			return back()
				->with('warning', "VEUILLEZ ACTIVER UNE SOUSCRIPTION AVANT DE JOUER UN DUEL");

		}
		
		
	}
	
	public function NextRandom($categorie_id)
    {
		
		$question = Question::getQuestionRandom($categorie_id);
		
		if(!empty($question)){

			$question = $question[0];
			
			if(Auth::user()->lang_code == 'en'){
				
				$question->question 	= $question->question_en;
				$question->propositionA = $question->proposition_a_en;
				$question->propositionB = $question->proposition_b_en;
				$question->propositionC = $question->proposition_c_en;
				
			}else{
				
				$question->question 	= $question->question_fr;
				$question->propositionA = $question->proposition_a_fr;
				$question->propositionB = $question->proposition_b_fr;
				$question->propositionC = $question->proposition_c_fr;
				
			}
			
			$question->reponse = "Tu croyais vraiment que j'allais afficher la réponse ?";

			//
			$cpt = Entrainement::getCompteurQuestion(Auth::user()->id);
			$question->cptQuestion 	= $cpt;

			//
			$entrainement = Entrainement::where('user_id',Auth::user()->id)->first();
			
			$entrainement_id = $entrainement->entrainement_id;

			$eq = new EntrainementQuestion();
			$eq->entrainement_id = $entrainement_id;
			$eq->question_id 	 = $question->id;
			$eq->user_id 		 = Auth::user()->id;
			$eq->save();
			

		}else{

			$question = new Question();

		}

		
		return json_encode($question);
		
	}
	
	
	public function SendReponse(Request $request)
    {
		
		$entrainement_score = 0;
		$entrainement_id 	= $request->entrainement_id;
		$question_id 		= $request->question_id;
		$user_reponse 		= $request->reponse;
		
		$question 			= Question::getQuestion($question_id);
		
		$entrainement = Entrainement::where(['entrainement_statut'=>'EN COURS', 'entrainement_id'=>$entrainement_id, 'user_id'=>Auth::user()->id])->get();
			
		$ent = Entrainement::find($entrainement[0]->entrainement_id);
			
		$entrainement_score = $ent->entrainement_score;
		
		if($question->reponse == $user_reponse){
			
			$ent->entrainement_score = $ent->entrainement_score + 100;
			$ent->exists = true;
			$ent->save();
			
			//le nouveau score après incrémentation
			$entrainement_score = $ent->entrainement_score;
			
			//mise jour total_points dans utilisateur
			$user =Auth::user();
			$user->total_points_test = $user->total_points_test + $entrainement_score;
			$user->exists = true;
			$user->save();
			
			$out = array('statut'=>1);
			
		}else{
			
			$out = array('statut'=>0);
			
		}
		
		
		
		$out['score'] = $entrainement_score;
		$out['reponse'] = $question->reponse;
		
		
		$nbre_question_objectif_financier = $ent->objectif_financier /100;
		$entrainement_compteur_question = $ent->entrainement_compteur_question;
		
		$out['statut_fin_quiz'] = ($nbre_question_objectif_financier < $entrainement_compteur_question)? 0 : 1;
			
		
		return json_encode($out);

		
	}
	
	
	
	public function SendReponseDuel(Request $request)
    {
		
		$question_id = $request->question_id;
		$user_reponse = $request->reponse;
		
		$question = Question::getQuestion($question_id);
		
		$score = Entrainement::getScore(Auth::user()->id);
		// $score = session('score');
		
		if($question->reponse == $user_reponse){
			
			$score += 100;
			$out = array('statut'=>1,'score'=>$score);
			
		}else{
			
			$out = array('statut'=>0,'score'=>$score);
			
		}
		
		$entrainement = Entrainement::where('user_id',Auth::user()->id)->get();
		
		$ent = Entrainement::find($entrainement[0]->entrainement_id);
		
		$ent->entrainement_score = $score;
		$ent->exists = true;
		$ent->save();
		
		// session('score',$score);
		
		$out['score'] = $score;
		$out['reponse'] = $question->reponse;
			
		
		return json_encode($out);

		
	}
	
	
	
	public function ShowScore()
    {
		
		$score = Entrainement::getScore(Auth::user()->id);
		
		return $score;
		
	}
	
	
	//équivalent de sabonner_quiz
	public function souscrirequiz(){
		
		$params = array('type_jeu'=>'quiz');
				
		return view('souscrirequiz',$params);
				
	}
	
	public function SaveSouscriptionQuiz(Request $request){
		
		$AuthUser = Auth::user();
	
		//vérifier si il y a un quiz en cours
		$quizencours = Entrainement::whereRaw(' type_jeu="QUIZ" and entrainement_statut="EN COURS" AND user_id="'.Auth::user()->id.'" and  DATE (entrainement_date)="'.gmdate('Y-m-d').'"')->first();

		if(empty($quizencours)){

			$frais_abonnement_quiz = Stdfn::getFraisAbonnementQuiz($AuthUser->devise);
			//dd($frais_abonnement_quiz);
			if($AuthUser->money > $frais_abonnement_quiz){
				
				
				//Activer une souscription
				$abonnement = new Abonnement();
				$abonnement->user_id = $AuthUser->id;
				$abonnement->type_jeu = 'QUIZ';
				$abonnement->abonnement_date = gmdate('Y-m-d H:i:s');
				$abonnement->save();

				
				$user = $AuthUser;
				//$user->statut_abonnement = 'ACTIVE';
				//$user->statut_abonnement_quiz = 'ACTIVE';
				$user->money = $user->money - $frais_abonnement_quiz;
				$user->exists = true;
				$user->save();
				
				
				//
				// $entrainement 						= new Entrainement();
				// $entrainement->user_id 				= $AuthUser->id;
				// $entrainement->categorie_id 		= .0;
				// $entrainement->type_jeu 			= 'QUIZ';
				// $entrainement->objectif_financier 	= intval($request->objectif_financier);
				// $entrainement->entrainement_date	= gmdate('Y-m-d H:i:s');
				// $entrainement->save();

				// $entrainement_id = $entrainement->entrainement_id;
				$objectif_financier = $request->objectif_financier;
				
				$categories = Categorie::where("categorie_statut","VALIDE")->get();
				$params = array('categories'=>$categories,'type_jeu'=>'quiz','objectif_financier'=>$objectif_financier);
				
				return view('categorie_quiz',$params);
				
				
				
			}else{
				
				return back()->with('warning','VOTRE SOLDE EST INSUFISANT, VEUILLEZ FAIRE UN DEPOT');
				
			}


		}else{
			
			return back()->with('warning','QUIZ DEJA EN COURS');
					
		}
	

	}
	
	
	public function quizs(){
		
		$quizs = Entrainement::join('categorie','categorie.categorie_id','entrainement.categorie_id')
								->where(['user_id'=>Auth::user()->id, 'type_jeu'=>'QUIZ'])
								->get();
		
		// dd($quizs);
		
		$params = array('quizs'=>$quizs);
				
		return view('quizs',$params);
		
	}
	
	public function quiz($categorie_id,$objectif_financier){
		
		$categorie = Categorie::find($categorie_id);
		
		$utilisateurs = User::all();
		$user_id = Auth::user()->id;
		$lang = Auth::user()->lang_code;
		
		$TXT_JE_PASSE 				= ($lang == 'en')? 'SKIP' : 'JE PASSE';
		$TXT_CONFIRMER_MA_REPONSE 	= ($lang == 'en')? 'CONFIRM MY ANSWER' : 'CONFIRMER MA REPONSE';
		
		$params = array('categorie'=>$categorie,'objectif_financier'=>$objectif_financier,'utilisateurs'=>$utilisateurs,'TXT_JE_PASSE'=>$TXT_JE_PASSE,'TXT_CONFIRMER_MA_REPONSE'=>$TXT_CONFIRMER_MA_REPONSE);
		
		
		
		return view('quiz',$params);
		
		
	}
	
	public function SaveQuiz(Request $request){
		
		//Mettre les autres test à terminé
		$updateData = array('entrainement_statut'=>'TERMINE');
		Entrainement::where(['user_id'=>Auth::user()->id,'entrainement_statut'=>'EN COURS'])->update($updateData);
		
		//Créer le nouveau test
		$entrainement = new Entrainement();
		$entrainement->user_id 							= Auth::user()->id;
		$entrainement->categorie_id 					= $request->categorie_id;
		$entrainement->entrainement_score 				= 0;
		$entrainement->entrainement_compteur_question 	= 1;
		$entrainement->entrainement_statut 				= 'EN COURS';
		$entrainement->entrainement_date 				= date('Y-m-d H:i:s');
		$entrainement->save();
		
		
		
		$out = array('statut'=>1,'entrainement_id'=>$entrainement->entrainement_id);
		
		
		echo json_encode($out);
		
	}
	
//
	public function defis(Request $request){
		
		$session_id = $request->session_id;
		
		$defis = Defi::where(['defi_date'=>gmdate('Y-m-d')])->get();
		
		$listeDefis = array();

		foreach($defis as $defi){
			
			$listeDefis[] = 
            	array(
            		'defiId' =>$defi->defi_id,
					'defiMontant' =>$defi->defi_montant,
					'defiDate' =>$defi->defi_date,

				);

		}
		
		
		echo json_encode(array('listeDefis'=>$listeDefis));

	}


	
}
