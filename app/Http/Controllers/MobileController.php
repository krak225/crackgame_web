<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Question;
use App\Categorie;
use App\Abonnement;
use App\Entrainement;
use App\Quiz;
use App\Chap;
use App\ChapScore;
use App\ChapQuestion;
use App\Duel;
use App\DuelScore;
use App\DuelJocker;
use App\Depot;
use App\Retrait;
use App\Souscription;
use App\JockerQuestion;
use App\AbonnementChap;
use App\Defi;
use App\Gain;
use Stdfn;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class MobileController extends Controller
{
  
    public function __construct()
    {
        // $this->middleware('auth');
    }


	//
	public function userinfos(Request $request){
		
		$user_id = $request->user_id;

		$user = User::find($user_id);
		$parrain = User::find($user->user_id_parrain);
		
		$listeUtilisateurs = array();

		$listeUtilisateurs[] = 
        	array(
        		'utilisateurId' =>$user->id,
				'utilisateurToken' =>$user->api_token,
				'utilisateurLogin' =>$user->email,
				'utilisateurNom' =>$user->nom,
				'utilisateurPrenoms' =>$user->prenoms,
				'utilisateurSexe' =>$user->sexe,
				'utilisateurTelephone' =>$user->telephone,
				'utilisateurEmail' =>$user->adresse_email,
				'utilisateurPhoto' =>"http://cracgame.com/public/images/avatars/".$user->photo,
				'utilisateurLangueCode' =>$user->lang_code,
				'utilisateurDevise' =>$user->devise,
				'utilisateurTotalPoint' =>number_format($user->total_points, 0, ',', ' '),
				'utilisateurTotalPointTest' =>number_format($user->total_points_test, 0, ',', ' '),
				'utilisateurTotalPointDuel' =>number_format($user->total_points_duel, 0, ',', ' '),
				'utilisateurScoreGeneral' =>number_format($user->score_general, 0, ',', ' '),
				'utilisateurJockerDuel' =>$user->jocker_duel,
				'utilisateurSouscription' =>$user->souscription,
				'utilisateurMoney' =>number_format($user->money, 0, ',', ' '),
				'utilisateurStatutAbonnement' =>$user->statut_abonnement,
				'utilisateurPaysOrigine' =>$user->pays_origine_id,
				'utilisateurPaysResidence' =>$user->pays_residence_id,
				'utilisateurVille' =>$user->ville,
				'utilisateurAdresse' =>$user->adresse,
				'utilisateurParrain' =>$parrain ? $parrain->pseudo : "",

			);

		
		echo json_encode(array('listeUtilisateurs'=>$listeUtilisateurs), JSON_INVALID_UTF8_SUBSTITUTE);

	}
	

	//
	public function dataforofflineuse(){
		
		// DB::select('INSERT INTO `question` (type_jeu_id,user_id,question_fr,question_en,proposition_a_fr,proposition_a_en,proposition_b_fr,proposition_b_en,proposition_c_fr,proposition_c_en,reponse,categorie_id,statut_selection,statut_selection_chap,statut) VALUES ("1","1","Quelle est la moitié de 180 ?","","Bouaké","","Atèngué","","90 ","","C","8","NOT SELECTED","NOT SELECTED","BROUILLON")');
		
		$categories = Categorie::all();
		
		$listeCategories = array();

		foreach($categories as $categorie){
				 	 
			$listeCategories[] = 
					array(
						'categorieId' =>$categorie->categorie_id,
						'categorieNom' =>stripslashes($categorie->categorie_libelle),
						'categorieDescription' =>stripslashes($categorie->categorie_description),
						'categorieStatut' =>$categorie->categorie_statut,
					);

		}
		
		
		$questions = Question::all();
		
		$listeQuestions = array();

		foreach($questions as $question){
			
			if($question->reponse=="A"){$question->reponse = $question->proposition_a_fr;}else if($question->reponse=="B"){$question->reponse = $question->proposition_b_fr;}else{$question->reponse = $question->proposition_c_fr;}

			$listeQuestions[] = 
                	array(
                		'ID' =>$question->id,
						'QUESTION' =>stripslashes($question->question_fr),
						'OPTA' =>stripslashes($question->proposition_a_fr),
						'OPTB' =>stripslashes($question->proposition_b_fr),
						'OPTC' =>stripslashes($question->proposition_c_fr),
						'ANSWER' =>$question->reponse,
						'CATEGORY'=>$question->categorie_id,
						'userID'=>$question->user_id,
						'niveauID'=>$question->niveau_id,
					);

		}
		
		
		$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"LES DONNÉES DU MODE HORS LIGNE ONT ÉTÉ CHARGÉ AVEC SUCCÈS",
					);

		return ['listeOperationResult'=>$listeOperationResult, 'listeCategories'=>$listeCategories, 'listeQuestions'=>$listeQuestions];
		
		//echo json_encode(array('listeOperationResult'=>$listeOperationResult, 'listeCategories'=>$listeCategories, 'listeQuestions'=>$listeQuestions), JSON_INVALID_UTF8_SUBSTITUTE);
		
	}
	
	

	public function categories(Request $request){
		
		//dd($request->api_token);
		//dd(User::where('api_token',$request->api_token)->get());
		//dd(Auth::user());

		$categories = Categorie::where(['categorie_statut'=>'VALIDE'])->orderBy('categorie_id', 'asc')->get();
		
		//$params = array('categories'=>$categories);
		
		$listeOperationResult = array();
		$listeCategories = array();

		if(!empty($categories)){

			foreach($categories as $categorie){
					 
				$listeCategories[] = 
						array(
							'categorieId' =>$categorie->categorie_id,
							'categorieNom' =>stripslashes($categorie->categorie_libelle),
							'categorieDescription' =>stripslashes($categorie->categorie_description),
							'categorieStatut' =>$categorie->categorie_statut,
						);


			}
			
			$listeOperationResult[] = 
	                	array(
	                		'operationStatut' =>1,
							'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES",
						);

		}else{

			$listeOperationResult[] = 
		                	array(
		                		'operationStatut' =>2,
								'operationMessage' =>"AUCUNE CATEGORIE DISPONIBLE",
							);
		}


		echo json_encode(array('listeOperationResult'=>$listeOperationResult,'listeCategories'=>$listeCategories), JSON_INVALID_UTF8_SUBSTITUTE);
		
		
	}


	public function questions_tc(Request $request){
		
		$categorie_id = $request->categorie_id;
		$type_jeu_id = ($request->type_jeu_id == "test") ? 1 : 2 ;

		$questions = Question::where(['categorie_id'=>$categorie_id, 'type_jeu_id'=>$type_jeu_id])->get();
		
		//dd($questions);

		$listeQuestions = array();

		if(!empty($questions)){

			foreach($questions as $question){
				
				//traitement
				if($question->reponse=="A"){$question->reponse = $question->proposition_a_fr;}else if($question->reponse=="B"){$question->reponse = $question->proposition_b_fr;}else{$question->reponse = $question->proposition_c_fr;}

				$listeQuestions[] = 
	                	array(
	                		'ID' =>$question->id,
							'QUESTION' =>stripslashes($question->question_fr),
							'OPTA' =>stripslashes($question->proposition_a_fr),
							'OPTB' =>stripslashes($question->proposition_b_fr),
							'OPTC' =>stripslashes($question->proposition_c_fr),
							'ANSWER' =>$question->reponse,
							'CATEGORY'=>$question->categorie_id,
							'userID'=>$question->user_id,
							'niveauID'=>$question->niveau_id,
						);

			}


			$listeOperationResult[] = 
			                	array(
			                		'operationStatut' =>1,
									'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES !",
								);


		}else{

			$listeOperationResult[] = 
			                	array(
			                		'operationStatut' =>0,
									'operationMessage' =>"Aucune question dans cette catégorie",
								);


		}

        $response = response()->json([
            'listeOperationResult'=>$listeOperationResult,'listeQuestions'=>$listeQuestions
        ]);
    
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'GET');
        $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    
        return $response;
		//echo json_encode(array('listeOperationResult'=>$listeOperationResult,'listeQuestions'=>$listeQuestions), JSON_INVALID_UTF8_SUBSTITUTE);
		
		
	}
	
	public function duelquestions(Request $request){
		
		$duel_id = $request->duel_id;
		$from_user_id = $request->from_user_id;
		$to_user_id = $request->to_user_id;

		$questions = Question::whereRaw('(user_id="'.$from_user_id.'" OR user_id="'.$to_user_id.'") AND statut_selection="SELECTED"')->get();
		
		// dd($questions);

		$listeQuestions = array();

		foreach($questions as $question){
			
			//traitement
			if($question->reponse=="A"){$question->reponse = $question->proposition_a_fr;}else if($question->reponse=="B"){$question->reponse = $question->proposition_b_fr;}else{$question->reponse = $question->proposition_c_fr;}

			$listeQuestions[] = 
                	array(
                		'ID' =>$question->id,
						'QUESTION' =>stripslashes($question->question_fr),
						'OPTA' =>stripslashes($question->proposition_a_fr),
						'OPTB' =>stripslashes($question->proposition_b_fr),
						'OPTC' =>stripslashes($question->proposition_c_fr),
						'ANSWER' =>$question->reponse,
						'CATEGORY'=>$question->categorie_id,
						'userID'=>$question->user_id,
					);

		}
		
	
		echo json_encode(array('listeQuestions'=>$listeQuestions), JSON_INVALID_UTF8_SUBSTITUTE);
		
		
	}
	
	public function chapquestions(Request $request){
		
		$chap_id = $request->chap_id;

		$questions = Question::whereRaw('id in (select question_id from chap_question where chap_id="'.$chap_id.'" and statut="DISPONIBLE") ')->get();//pr l'instant on liste tout
		
		// dd($questions);

		$listeQuestions = array();

		foreach($questions as $question){
			
			//traitement
			if($question->reponse=="A"){$question->reponse = $question->proposition_a_fr;}else if($question->reponse=="B"){$question->reponse = $question->proposition_b_fr;}else{$question->reponse = $question->proposition_c_fr;}

			$listeQuestions[] = 
                	array(
                		'ID' =>$question->id,
						'QUESTION' =>stripslashes($question->question_fr),
						'OPTA' =>stripslashes($question->proposition_a_fr),
						'OPTB' =>stripslashes($question->proposition_b_fr),
						'OPTC' =>stripslashes($question->proposition_c_fr),
						'ANSWER' =>$question->reponse,
						'CATEGORY'=>$question->categorie_id,
						'userID'=>$question->user_id,
					);

		}
		
	
		echo json_encode(array('listeQuestions'=>$listeQuestions), JSON_INVALID_UTF8_SUBSTITUTE);
		
		
	}
	
	public function mesquestions(Request $request){
		
		$user_id = intval($request->session_id);

		$questions = Question::where('user_id',$user_id)->get();
		
		//dd($questions);

		$listeQuestions = array();

		foreach($questions as $question){
			
			//traitement
			if($question->reponse=="A"){$question->reponse = $question->proposition_a_fr;}else if($question->reponse=="B"){$question->reponse = $question->proposition_b_fr;}else{$question->reponse = $question->proposition_c_fr;}

			$listeQuestions[] = 
                	array(
                		'ID' =>$question->id,
						'QUESTION' =>stripslashes($question->question_fr),
						'OPTA' =>stripslashes($question->proposition_a_fr),
						'OPTB' =>stripslashes($question->proposition_b_fr),
						'OPTC' =>stripslashes($question->proposition_c_fr),
						'ANSWER' =>$question->reponse,
						'CATEGORY'=>$question->categorie_id,
						'userID'=>$question->user_id,
						'statutDuel'=>$question->statut_selection,
						'statutChap'=>$question->statut_selection_chap,
					);

		}


		$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES",
					);
		
	
		echo json_encode(array('listeOperationResult'=>$listeOperationResult, 'listeQuestions'=>$listeQuestions), JSON_INVALID_UTF8_SUBSTITUTE);
		

		
	}
	
	public function sendselectedquestions(Request $request){
		
		$user_id = intval($request->session_id);
		$type_jeu = $request->type_jeu;
		$q1 = intval($request->q1);
		$q2 = intval($request->q2);
		$q3 = intval($request->q3);
		$q4 = intval($request->q4);
		$q5 = intval($request->q5);
		$q6 = intval($request->q6);
		$q7 = intval($request->q7);

		$questions = array($q1,$q2,$q3,$q4,$q5,$q6,$q7);

		foreach ($questions as $q) {
			
			$question = Question::find($q);

			if(!empty($question)){

				$question->statut_selection = 'SELECTED';
				$question->exists = true;
				$question->save();

			}

		}


		if($type_jeu == "duel"){

			DB::table('question')->whereRaw('user_id="'.$user_id.'"')->update(['statut_selection'=>'NOT SELECTED']);
			DB::table('question')->whereRaw('user_id="'.$user_id.'" AND id in ('.$q1.','.$q2.','.$q3.','.$q4.','.$q5.','.$q6.','.$q7.')')->update(['statut_selection'=>'SELECTED']);
		
		}else{

			DB::table('question')->whereRaw('user_id="'.$user_id.'"')->update(['statut_selection_chap'=>'NOT SELECTED']);
			DB::table('question')->whereRaw('user_id="'.$user_id.'" AND id in ('.$q1.','.$q2.','.$q3.','.$q4.','.$q5.')')->update(['statut_selection_chap'=>'SELECTED']);
		
		}

		$listeOperationResult = array();

		$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES",
					);
		
	
		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		

		
	}
	


	public function submitquestion(Request $request){
		
		$user_id = intval($request->session_id);
		
		$question = new Question();
		
		$question->user_id 			= $user_id;
		$question->question_fr 		= $request->question;
		$proposition_correcte 		= $request->bonne_reponse;
		
		$question->proposition_a_fr = null;
		
		//choisir un emplacement au hasard pour la bonne proposition
		$numero_bonnne_proposition = mt_rand(1,3);
		
		if($numero_bonnne_proposition == 1){
			
			$question->reponse 			= 'A';
			$question->proposition_a_fr = $proposition_correcte;
			$question->proposition_b_fr = $request->proposition_2;
			$question->proposition_c_fr = $request->proposition_3;
			
		}elseif($numero_bonnne_proposition == 2){
			
			$question->reponse 			= 'B';
			$question->proposition_a_fr = $request->proposition_2;
			$question->proposition_b_fr = $proposition_correcte;
			$question->proposition_c_fr = $request->proposition_3;
						
		}else{
			
			$question->reponse 			= 'C';
			$question->proposition_a_fr = $request->proposition_2;
			$question->proposition_b_fr = $request->proposition_3;
			$question->proposition_c_fr = $proposition_correcte;
						
		}
		
		
		$question->statut 			= 'BROUILLON';
		
		$question->save();
		
		

		$listeOperationResult = array();

		$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES",
					);
		
	
		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		

		
	}

	public function modifierquestion(Request $request){
		

		$listeOperationResult = array();

		$user_id = intval($request->session_id);
		$question_id = intval($request->question_id);
		
		$question = Question::find($question_id);
		
		if(!empty($question)){

			$question->user_id 			= $user_id;
			$question->question_fr 		= $request->question;
			$proposition_correcte 		= $request->bonne_reponse;
			
			$question->proposition_a_fr = null;
			
			//choisir un emplacement au hasard pour la bonne proposition
			$numero_bonnne_proposition = mt_rand(1,3);
			
			if($numero_bonnne_proposition == 1){
				
				$question->reponse 			= 'A';
				$question->proposition_a_fr = $proposition_correcte;
				$question->proposition_b_fr = $request->proposition_2;
				$question->proposition_c_fr = $request->proposition_3;
				
			}elseif($numero_bonnne_proposition == 2){
				
				$question->reponse 			= 'B';
				$question->proposition_a_fr = $request->proposition_2;
				$question->proposition_b_fr = $proposition_correcte;
				$question->proposition_c_fr = $request->proposition_3;
							
			}else{
				
				$question->reponse 			= 'C';
				$question->proposition_a_fr = $request->proposition_2;
				$question->proposition_b_fr = $request->proposition_3;
				$question->proposition_c_fr = $proposition_correcte;
							
			}
			
			
			$question->statut 			= 'BROUILLON';
			
			$question->exists = true;
			$question->save();
			
			
			$listeOperationResult[] = 
	                	array(
	                		'operationStatut' =>1,
							'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES",
						);

		}else{


			$listeOperationResult[] = 
	                	array(
	                		'operationStatut' =>0,
							'operationMessage' =>"QUESTION INTROUVABLE !",
						);
			

		}
	
		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		

		
	}


	public function savescore_tc(Request $request){
		
		$type_jeu 				= $request->type_jeu;
		$objectif_financier		= $request->objectif_financier;
		$categorie_id 			= $request->categorie_id;
		$user_id 				= $request->session_id;
		$score 					= $request->score;
		$cpt_question_pose 		= $request->cpt_question_pose;
		$entrainement_code 		= $request->entrainement_code;

		$entrainement_existant 	= Entrainement::whereRaw('entrainement_code="'.$entrainement_code.'" and user_id="'.$user_id.'"')->first();
		
		
		if(!empty($entrainement_existant) ){
			

			$entrainement_existant->entrainement_score 				= $score;
			$entrainement_existant->entrainement_compteur_question 	= $cpt_question_pose;
			$entrainement_existant->entrainement_date 				= gmdate('Y-m-d H:i:s');
			$entrainement_existant->exists = true;
			$entrainement_existant->save();
			
			//dd($entrainement_existant);

		}else{

			//Créer le nouveau test
			$entrainement = new Entrainement();
			$entrainement->user_id 							= $user_id;
			$entrainement->type_jeu 						= $type_jeu;
			$entrainement->objectif_financier 				= $objectif_financier;
			$entrainement->categorie_id 					= $categorie_id;
			$entrainement->entrainement_score 				= $score;
			$entrainement->entrainement_compteur_question 	= $cpt_question_pose;
			$entrainement->entrainement_statut 				= 'EN COURS';
			$entrainement->entrainement_date 				= gmdate('Y-m-d H:i:s');
			$entrainement->entrainement_code 				= $entrainement_code;

			$entrainement->save();

		}

		
				
		//mise jour total_points dans utilisateur

		//$user = User::find($user_id);
		
		//$user->total_points_test = $user->total_points_test + $score;
		//$user->exists = true;
		//$user->save();
		
		
		$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES",
					);

		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
		
	}


	public function saveofflinetc(Request $request){
		
		//si le code du test existe deja, il ne l'enregistrera plus (entrainement_code UNIQUE DANS LA BASE)
		
		$user_id = $request->session_id;
		$score = $request->score;
		$cpt_question_pose = $request->cpt_question_pose;
		$categorie_id = $request->categorie_id;
		$entrainement_code = $request->entrainement_code;

		
		//Added on 03062022: vérifier si le code n'existe pas avant d'enregistrer -- a bien voir
		$entrainement_existant = Entrainement::where(['entrainement_code'=>$entrainement_code])->first();
		
		if(empty($entrainement_existant)){
				
			//Créer le nouveau test
			$entrainement = new Entrainement();
			$entrainement->user_id 							= $user_id;
			$entrainement->categorie_id 					= $categorie_id;
			$entrainement->entrainement_score 				= $score;
			$entrainement->entrainement_compteur_question 	= $cpt_question_pose;
			$entrainement->entrainement_statut 				= 'TERMINE';
			$entrainement->entrainement_date 				= gmdate('Y-m-d H:i:s');
			$entrainement->entrainement_code 				= $entrainement_code;
			$entrainement->save();
			
				
			//mise jour total_points dans utilisateur
			$user = User::find($user_id);
			if(!empty($user)){
				$user->total_points_test = $user->total_points_test + $score;
				$user->exists = true;
				$user->save();
			}
			
		}else{
		
			//Mettre le statut a terminé
			$entrainement_existant->entrainement_statut 				= 'TERMINE';
			$entrainement_existant->save();
			
		}
		

		$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES",
					);

		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
		
		
	}


	public function updatecore_tc(Request $request){
		
		$user_id = $request->session_id;
		$score = $request->score;
		$cpt_question_pose = $request->cpt_question_pose;
		$entrainement_id = $request->entrainement_id;

		//Créer le nouveau test
		$entrainement = Entrainement::find($entrainement_id);
		$entrainement->entrainement_score 				= $score;
		$entrainement->entrainement_compteur_question 	= $cpt_question_pose;
		$entrainement->exists = true;
		$entrainement->save();
		
				
		//mise jour total_points dans utilisateur
		$user = User::find($user_id);
		$user->total_points_test = $user->total_points_test + $score;
		$user->exists = true;
		$user->save();
		
		
		$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"OPERATION EFFECTUEE AVEC SUCCES",
					);

		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
		
	}


	public function souscrireduel(Request $request){
		
		$session_id = $request->session_id;

		$user = User::find($session_id);
		if($user->souscription > 0){
			
			//Activer une souscription
			$abonnement = new Abonnement();
			$abonnement->user_id = $session_id;
			$abonnement->type_jeu = 'DUEL';
			$abonnement->abonnement_date = gmdate('Y-m-d H:i:s');
			$abonnement->save();
			
			
			$user->statut_abonnement = 'ACTIVE';
			$user->souscription = $user->souscription - 1;
			$user->jocker_duel  = 3;
			$user->exists = true;
			$user->save();
			
			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"SOUSCRIPTION EFFECTUEE AVEC SUCCES",
					);
			
		}else{
			
			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>2,
						'operationMessage' =>"VOUS N'AVEZ PAS DE SOUSCRIPTIONS",
					);

		}


		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
	}
	
	
	public function achetersouscription(Request $request){
		
		$request->pour_qui = 'moi';

		$session_id = $request->session_id;
		$quantite = $request->quantite;

		$AuthUser = User::find($session_id);



        $this->frais_souscription_duel = Stdfn::getFraisAbonnementDuel($AuthUser->devise);
        $this->frais_souscription_chap = Stdfn::getFraisAbonnementChap($AuthUser->devise);

        $frais_total = $this->frais_souscription_duel * $request->quantite;

        if($AuthUser->money >= $frais_total ){

			$pour_qui = $request->pour_qui;
			$pseudo_ami = $request->pseudo_ami;
			
			$souscription = new Souscription();
			$souscription->user_id = $AuthUser->id;
				
			if($pour_qui == 'moi'){
				
				
				$souscription->beneficiaire_user_id = $AuthUser->id;
				
				$user = User::find($AuthUser->id);
				$user->souscription = $user->souscription + $request->quantite;
				$user->money = $user->money - $this->frais_souscription_duel * $request->quantite;
				$user->exists = true;
				$user->save();
				
			}else {
				
				$beneficiaire_user = current(User::where('pseudo',$pseudo_ami)->get());
				
				if(!empty($beneficiaire_user)){
					$beneficiaire_user = $beneficiaire_user[0];
					$beneficiaire_user_id = $beneficiaire_user->id;
				
					$souscription->beneficiaire_user_id = $AuthUser->id;
					
					$user = User::find($beneficiaire_user_id);
					$user->souscription = $user->souscription + $request->quantite;
					$user->exists = true;
					$user->save();
					
					
					$user = User::find($AuthUser->id);
					$user->money = $user->money - $this->frais_souscription_duel * $request->quantite;
					$user->exists = true;
					$user->save();
					
					
				}else{

					$listeOperationResult[] = 
		                	array(
		                		'operationStatut' =>3,
								'operationMessage' =>"Veuillez entrer un pseudo valide",
							);
					
				}
			}
			
			$souscription->souscription_quantite = $request->quantite;
			$souscription->souscription_montant = $request->montant;
			$souscription->souscription_date = gmdate('Y-m-d H:i:s');
			$souscription->save();
			

			//Ajout des bonnus en fonction des souscriptions
			$quantite = $request->quantite;

			$jockerquestion = new JockerQuestion();
			$jockerquestion->user_id = $AuthUser->id;
			$jockerquestion->beneficiaire_user_id = $AuthUser->id;

			$bonus = 0;

			if($quantite > 1 && $quantite < 5) {
				$bonus = 5;
			}elseif($quantite > 5 && $quantite < 10){
				$bonus = 10;
			}elseif($quantite > 10 && $quantite < 20){
				$bonus = 20;
			}elseif($quantite > 20 && $quantite < 30){
				$bonus = 30;
			}elseif($quantite > 30 && $quantite < 40){
				$bonus = 40;
			}elseif($quantite > 40 && $quantite < 50){
				$bonus = 50;
			}elseif($quantite > 50 && $quantite < 60){
				$bonus = 60;
			}

			if($bonus > 0){

				$jockerquestion->jockerquestion_quantite = $bonus;
				$jockerquestion->save();
				//dd($jockerquestion);


				$user->jocker_question = $user->jocker_question + $bonus;
				$user->save();

			}

			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"ACHAT DE SOUSCRIPTION EFFECTUEE AVEC SUCCES",
					);

		}else{

			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>2,
						'operationMessage' =>"FONDS INSUFFISANT (".$AuthUser->money."/".$frais_total."), VEUILLEZ FAIRE UN DEPOT AVANT D'ACHETER DES SOUSCRIPTONS.",
					);
		}


		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
	}


	public function faireundepot(Request $request){
		
		$session_id = $request->session_id;
		$numero_mobilemoney = $request->numero_mobilemoney;
		$montant = $request->montant;

		$AuthUser = User::find($session_id);

		if($montant >= 100 && strlen($numero_mobilemoney) == 10 ){

			//SAUVEGARDE EN BDD
			$depot = new Depot();
			$depot->user_id = $AuthUser->id;
			$depot->depot_montant = $montant;
			$depot->depot_date = gmdate('Y-m-d H:i:s');
			$depot->save();
			
			
			//MISE A JOUR DU SOLDE DE L'UTILISATEUR
			$user = $AuthUser;
			$user->money = $user->money + $montant;
			$user->exists = true;
			$user->save();

			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"DEPOT EFFECTUE AVEC SUCCES",
					);

		}else{

			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>2,
						'operationMessage' =>"VEUILLEZ SAISIR LE MONTANT ET LE NUMERO MOBILE MONEY",
					);
		}


		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
	}

	
	public function faireunretrait(Request $request){
		
		$session_id = $request->session_id;
		// $numero_mobilemoney = $request->numero_mobilemoney;
		$montant = $request->montant;

		$AuthUser = User::find($session_id);

		if($montant >= 100 ){

			//SAUVEGARDE EN BDD
			$depot = new Retrait();
			$depot->user_id = $AuthUser->id;
			$depot->retrait_montant 	 = $montant;
			$depot->retrait_date_demande = gmdate('Y-m-d H:i:s');
			$depot->save();
			
			
			//MISE A JOUR DU SOLDE DE L'UTILISATEUR
			$user = $AuthUser;
			$user->money = $user->money - $montant;
			$user->exists = true;
			$user->save();

			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"DEMANDE DE RETRAIT ENREGISTREE AVEC SUCCES",
					);

		}else{

			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>2,
						'operationMessage' =>"VEUILLEZ SAISIR LE MONTANT",
					);
		}


		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
	}

	
	//équivalent de sabonner_chap
	public function payerabonnementchap(Request $request){
		
		$session_id = $request->session_id;

		$AuthUser = User::find($session_id);

		if(!empty($AuthUser) ){

			//vérifier si il y a un chap en cours
			$chapencours = Chap::whereRaw(' chap_statut="EN COURS" and  DATE (chap_date_debut)="'.date('Y-m-d').'"')->first();

			if(!empty($chapencours)){

				$chapencours_id = $chapencours->chap_id;

				$frais_abonnement_chap = Stdfn::getFraisAbonnementChap($AuthUser->devise);
				//dd($frais_abonnement_chap);
				if($AuthUser->money > $frais_abonnement_chap){
					
					
					//Activer une souscription
					$abonnement = new Abonnement();
					$abonnement->user_id = $AuthUser->id;
					$abonnement->type_jeu = 'CHAP';
					$abonnement->abonnement_date = gmdate('Y-m-d H:i:s');
					$abonnement->save();

					//s'abonner au chap en cours
					$abonnement = new AbonnementChap();
					$abonnement->user_id = $AuthUser->id;
					$abonnement->chap_id = $chapencours_id;
					$abonnement->abonnement_chap_date = gmdate('Y-m-d H:i:s');
					$abonnement->save();
					

					
					$user = $AuthUser;
					$user->statut_abonnement = 'ACTIVE';
					$user->statut_abonnement_chap = 'ACTIVE';
					$user->money = $user->money - $frais_abonnement_chap;
					$user->exists = true;
					$user->save();
					
					
					$listeOperationResult[] = 
						array(
							'operationStatut' =>1,
							'operationMessage' =>"SOUSCRIPTION CHAP ACTIVÉ AVEC SUCCÈS!",
						);	
					
				}else{
					
					$listeOperationResult[] = 
						array(
							'operationStatut' =>2,
							'operationMessage' =>"VOUS SOLDE EST INSUFFISANT. VEUILLEZ FAIRE UN DÉPOT AVANT DE SOUSCRIRE!",
						);
				}


			}else{
				
				$listeOperationResult[] = 
						array(
							'operationStatut' =>3,
							'operationMessage' =>"AUCUN CHAP EN COURS, VEUILLEZ PATIENTER SVP !",
						);
						
			}
		
		}else{
			
			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>4,
						'operationMessage' =>"UTILISATEUR NON RECONNU",
					);
					
		}	

		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
	}
	
	
	
	//mettre fin a un quiz
	public function endquiz(Request $request){
		
		$defi_id							= $request->defi_id;
		$entrainement_code 					= $request->entrainement_id;
		$user_id 							= $request->session_id;
		
		$entrainement 						= Entrainement::whereRaw('entrainement_code="'.$entrainement_code.'" and user_id="'.$user_id.'"')->first();
		$entrainement->entrainement_statut 	= 'TERMINE';
		
		
		
		if($entrainement->entrainement_score >= $entrainement->objectif_financier){
			
			$entrainement->entrainement_issue 	= 'GAGNE';
			
            //enregistrer le gain
            $gain = new Gain();
            $gain->user_id = $user_id;
            $gain->entrainement_id = $entrainement->entrainement_id;
            $gain->gain_montant = $entrainement->objectif_financier;
            $gain->gain_date_creation = gmdate('Y-m-d H:i:s');
            $gain->save();
			
			
			$user 								= User::find($user_id);
			$user->money 						= $user->money + $entrainement->objectif_financier;
			$user->total_points_test 			= $user->total_points_test + $entrainement->objectif_financier;
			$user->exists 						= true;
			$user->save();

			//dd($user);
			
			$defi = Defi::find($defi_id);
			if($defi){
    			$defi->defi_statut = "CLOTURE";
    			$defi->exists = true;
    			$defi->save();
			}

		}else{
			
			$entrainement->entrainement_issue 	= 'PERDU';
			
		}
		
		$entrainement->exists 				= true;
		$entrainement->save();
	
		echo "FIN DE LA PARTIE";
		
	}
	
	
	
	public function souscrirequiz(Request $request){
		// dd($request);
		$session_id = $request->session_id;

		$AuthUser = User::find($session_id);

		if(!empty($AuthUser) ){

			//vérifier si il y a un quiz en cours
			$quizencours = Quiz::whereRaw(' quiz_statut="EN COURS" and  DATE (quiz_date)="'.gmdate('Y-m-d').'"')->first();

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
					
					
					$listeOperationResult[] = 
						array(
							'operationStatut' =>1,
							'operationMessage' =>"SOUSCRIPTION QUIZ ACTIVÉ AVEC SUCCÈS!",
						);	
					
				}else{
					
					$listeOperationResult[] = 
						array(
							'operationStatut' =>2,
							'operationMessage' =>"VOUS SOLDE EST INSUFFISANT. VEUILLEZ FAIRE UN DÉPOT AVANT DE SOUSCRIRE!",
						);
				}


			}else{
				
				$listeOperationResult[] = 
						array(
							'operationStatut' =>1,
							'operationMessage' =>"QUIZ DEJA ACTIVÉ !",
						);
						
			}
		
		}else{
			
			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>4,
						'operationMessage' =>"UTILISATEUR NON RECONNU",
					);
					
		}	

		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
	}
	

	public function chapencours(Request $request){
		
		$user_id = $request->user_id;
		$AuthUser = User::find($user_id);
		
		//vérifier si abonnement activé
		if($AuthUser->statut_abonnement_chap == 'ACTIVE'){
			
			//Vérifier si la selection de question est prete
			$maSelectionQuestion = Question::where(['user_id'=>$AuthUser->id,'statut_selection_chap'=>'SELECTED'])->get();
			$cpt_ma_selection = count($maSelectionQuestion);
			
			if($cpt_ma_selection >= 5){
				

				$chap = Chap::where('chap_statut','EN COURS')->first();

				if(!empty($chap)){

					$chap_id = $chap->chap_id;

					//si nouvel utilisateur
					$verif = ChapScore::where(['chap_id'=>$chap_id,'user_id'=>$AuthUser->id])->first();
					if(empty($verif)){
						
						//enregistrer sa selection de question dans le panier du chap
						foreach($maSelectionQuestion as $question){
							
							$chap_question 				= new ChapQuestion();
							$chap_question->user_id 	= $AuthUser->id;
							$chap_question->chap_id 	= $chap_id;
							$chap_question->question_id = $question->id;
							$chap_question->save();
							
						}
						

						
						//
						$chapscore = new ChapScore();
						$chapscore->chap_id = $chap_id;
						$chapscore->user_id = $AuthUser->id;
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
					

				$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>$chap_id,
					);

			}else{

				$listeOperationResult[] = 
	                	array(
	                		'operationStatut' =>2,
							'operationMessage' =>"AUCUN CHAP EN COURS",
						);
			}


		}else{
							
			$listeOperationResult[] = 
			                	array(
			                		'operationStatut' =>3,
									'operationMessage' =>"VEUILLEZ SELECTIONNER VOS 5 QUESTIONS DE CHAP AVANT DE COMMENCER À JOUER",
								);

			}
			
		}else{

			$listeOperationResult[] = 
				                	array(
				                		'operationStatut' =>4,
										'operationMessage' =>"VEUILLEZ ACTIVER UNE SOUSCRIPTION AVANT DE JOUER UN CHAP",
									);

		}
		
	

		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		

	}




	//
	public function duelistes(Request $request){
		
		$session_id = $request->session_id;
		
		$users = Abonnement::getDuelistesAbonnes($session_id);
		
		$listeUtilisateurs = array();

		foreach($users as $user){
			
			$listeUtilisateurs[] = 
            	array(
            		'utilisateurId' =>$user->id,
					'utilisateurToken' =>$user->api_token,
					'utilisateurLogin' =>$user->email,
					'utilisateurNom' =>$user->nom,
					'utilisateurPrenoms' =>$user->prenoms,
					'utilisateurPhoto' =>"http://cracgame.com/public/images/avatars/".$user->photo,
					'utilisateurLangueCode' =>$user->lang_code,
					'utilisateurDevise' =>$user->devise,
					'utilisateurTotalPoint' =>$user->total_points,
					'utilisateurTotalPointTest' =>$user->total_points_test,
					'utilisateurTotalPointDuel' =>'Total points aux duels: '.$user->total_points_duel,
					'utilisateurScoreGeneral' =>$user->score_general,
					'utilisateurJockerDuel' =>$user->jocker_duel,
					'utilisateurSouscription' =>$user->souscription,
					'utilisateurMoney' =>$user->money,
					'utilisateurStatutAbonnement' =>$user->statut_abonnement,

				);

		}
		
		
		echo json_encode(array('listeUtilisateurs'=>$listeUtilisateurs), JSON_INVALID_UTF8_SUBSTITUTE);

	}

	
	public function classements(Request $request){
		
		$session_id 		= $request->session_id;
		$type 				= $request->type_classement;
		$recherche_date 	= !empty($request->recherche_date) ? Stdfn::dateToDB($request->recherche_date) : '';

		if($type == 1){
			
			$users_duels_gagnes = Duel::getClassementByDuelsGagnes();
			
			$listeClassements = array();
			
			$rang = 0;
			foreach($users_duels_gagnes as $user){
				$rang++;
				$rang_libelle = ($rang==1)? 'er' : 'ème';

				$listeClassements[] = 
					array(
						'classementRang' =>$rang.$rang_libelle,
						'classementPseudo' =>ucfirst($user->pseudo),
						'classementPhoto' =>"http://cracgame.com/public/images/avatars/".$user->photo,
						'classementNote' =>$user->duels_gagnes . ' duels gagnés',
						'classementDate' =>"",
					);

			}
			
		}elseif($type == 2){
			
			$users_duels_points = Duel::getClassementByPointsDuel();		
			
			$listeClassements = array();

			$rang = 0;
			foreach($users_duels_points as $user){
				$rang++;
				$rang_libelle = ($rang==1)? 'er' : 'ème';
				
				$listeClassements[] = 
					array(
						'classementRang' =>$rang.$rang_libelle,
						'classementPseudo' =>ucfirst($user->pseudo),
						'classementPhoto' =>"http://cracgame.com/public/images/avatars/".$user->photo,
						'classementNote' =>number_format($user->total_points_duel, 0, ',', ' ') . ' points obtenus',
						'classementDate' =>"",
					);

			}
			
		}elseif($type == 3){
		
			$users_duels_joues 	= Duel::getClassementByDuelsJoues();
			
			$listeClassements = array();
			
			$rang = 0;
			foreach($users_duels_joues as $user){
				$rang++;
				$rang_libelle = ($rang==1)? 'er' : 'ème';
				
				$listeClassements[] = 
					array(
						'classementRang' =>$rang.$rang_libelle,
						'classementPseudo' =>ucfirst($user->pseudo),
						'classementPhoto' =>"http://cracgame.com/public/images/avatars/".$user->photo,
						'classementNote' =>$user->duels_joues . ' duels joués',
						'classementDate' =>"",
					);

			} 
		
		}elseif($type == 4){
		
			$entrainements 	= Entrainement::join('users','id','user_id')
								->selectRaw('entrainement.*, pseudo, photo')
								->where(['user_id'=>$session_id, 'type_jeu'=>'test'])
								->get()
								->sortByDesc('entrainement_id');

			//dd($entrainements);
			$listeClassements = array();
			
			$rang = 0;
			foreach($entrainements as $entrainement){
				$rang++;
				$rang_libelle = ($rang==1)? 'er' : 'ème';
				
				$listeClassements[] = 
					array(
						'classementRang' =>Stdfn::dateTimeFromDB($entrainement->entrainement_date),
						'classementPseudo' =>number_format($entrainement->entrainement_score, 0, ',', ' ') . ' points ',
						'classementPhoto' =>"http://cracgame.com/public/images/avatars/".$entrainement->photo,
						'classementNote' =>'',
						'classementDate' =>"",
					);

			}
		
		}elseif($type == 5){
		
			$entrainements 	= Entrainement::join('users','id','user_id')
								->selectRaw('entrainement.*, pseudo, photo')
								->where(['user_id'=>$session_id, 'type_jeu'=>'quiz'])
								->get()
								->sortByDesc('entrainement_score');

			//dd($entrainements);
			$listeClassements = array();
			
			$rang = 0;
			foreach($entrainements as $entrainement){
				$rang++;
				$rang_libelle = ($rang==1)? 'er' : 'ème';
				
				$listeClassements[] = 
					array(
						'classementRang' =>Stdfn::dateTimeFromDB($entrainement->entrainement_date),
						'classementPseudo' =>'Mise: '.number_format($entrainement->objectif_financier, 0, ',', ' ') . 'F - Score: '. number_format($entrainement->entrainement_score, 0, ',', ' ') . ' pts - '. $entrainement->entrainement_issue,
						'classementPhoto' =>"http://cracgame.com/public/images/avatars/".$entrainement->photo,
						'classementNote' =>'',
						'classementDate' =>"",
					);

			}
		
		}elseif($type == 6){
			
			//pour le classement test general, prendre en compte les quiz //(type_jeu="test" or type_jeu="quiz") 
			//ancienne requete pour date du jour uniquemet
			// $sql = 'select sum(entrainement_score) as entrainement_score, pseudo, photo from entrainement inner join users on id = user_id where DATE(entrainement_date) = "'.gmdate('Y-m-d').'" group by user_id order by entrainement_score desc ';
			
			//avec recherche par date
			$sql = 'select sum(entrainement_score) as entrainement_score, DATE(entrainement_date) as entrainement_date, users.id as utilisateur_id, pseudo, photo from entrainement inner join users on id = user_id 
			where 1 ';
			
			$sql .= !empty($recherche_date) ? ' AND DATE(entrainement_date) = "'.$recherche_date.'" ': '';
			
			$sql .= ' group by user_id, DATE(entrainement_date) 
			order by DATE(entrainement_date) desc, entrainement_score desc ';
			
			 //die($sql);
			
			$entrainements 	= DB::select($sql);					
								
			//dd($entrainements);
			$listeClassements = array();
			
			$rang = 0;$tab_dates = [];
			foreach($entrainements as $entrainement){
				
				//l'entête qui affiche la date
				if(!in_array($entrainement->entrainement_date, $tab_dates)){
					$rang = 0;
					$tab_dates[] = $entrainement->entrainement_date;
					
					$listeClassements[] = 
					array(
						'classementRang' =>"",
						'classementPseudo' =>"",
						'classementPhoto' =>"http://cracgame.com/public/images/avatars/".$entrainement->photo,
						'classementNote' =>0,
						'classementDate' =>Stdfn::dateFromDB($entrainement->entrainement_date),
					);
				
				}
				
				$rang++;
				
				$rang_libelle = ($rang==1)? 'er' : 'ème';
				
				//afficher les 20 permiers et moi
				if($rang <2 || $entrainement->utilisateur_id == $session_id){
    				$listeClassements[] = 
    					array(
    						'classementRang' =>$rang.$rang_libelle,
    						'classementPseudo' =>ucfirst($entrainement->pseudo),
    						'classementPhoto' =>"http://cracgame.com/public/images/avatars/".$entrainement->photo,
    						'classementNote' =>number_format($entrainement->entrainement_score, 0, ',', ' ') . ' points',
    						'classementDate' =>"",
    					);
				}else{
				    //print_r($entrainement);
				}
			}
		
		
		}elseif($type == 7){
			
			//meilleur score de chaque jour
			//prendre en compte les quiz //(type_jeu="test" or type_jeu="quiz") 
			
			$sql = 'select t.* from (
			select DATE(entrainement_date) as entrainement_date , sum(entrainement_score) as entrainement_score, pseudo, photo 
			from entrainement inner join users on id = user_id
			group by user_id, DATE(entrainement_date)
			order by entrainement_score desc 
			) as t group by t.entrainement_date 
			order by t.entrainement_date desc ';
			
			// die($sql);
			
			$entrainements 	= DB::select($sql)
								;					
								
			//dd($entrainements);
			$listeClassements = array();
			
			$rang = 0;
			foreach($entrainements as $entrainement){
				$rang++;
				// $rang_libelle = ($rang==1)? 'er' : 'ème';
				
				$listeClassements[] = 
					array(
						'classementRang' =>Stdfn::dateFromDB($entrainement->entrainement_date),
						'classementPseudo' =>ucfirst($entrainement->pseudo),
						'classementPhoto' =>"http://cracgame.com/public/images/avatars/".$entrainement->photo,
						'classementNote' =>number_format($entrainement->entrainement_score, 0, ',', ' ') . ' points',
						'classementDate' =>"",
					);

			}
		
		
		}elseif($type == 8){
			
			//historique des quiz gagnés
			
			$entrainements 	= Entrainement::join('users','id','user_id')
								->selectRaw('entrainement.*, pseudo, photo')
								->where(['entrainement_issue'=>"GAGNE", 'type_jeu'=>'quiz'])
								->get()
								->sortByDesc('entrainement_date');

			//dd($entrainements);
			$listeClassements = array();
			
			$rang = 0;
			foreach($entrainements as $entrainement){
				$rang++;
				$rang_libelle = ($rang==1)? 'er' : 'ème';
				
				$listeClassements[] = 
					array(
						'classementRang' =>Stdfn::dateTimeFromDB($entrainement->entrainement_date),
						'classementPseudo' =>'Mise: '.number_format($entrainement->objectif_financier, 0, ',', ' ') . 'F - Score: '. number_format($entrainement->entrainement_score, 0, ',', ' ') . ' pts - '. $entrainement->entrainement_issue . ' par ' . $entrainement->pseudo,
						'classementPhoto' =>"http://cracgame.com/public/images/avatars/".$entrainement->photo,
						'classementNote' =>'',
						'classementDate' =>"",
					);

			}
		
		}
		
		
		
		
		
		echo json_encode(array(
			'listeClassements'=>$listeClassements,
		), JSON_INVALID_UTF8_SUBSTITUTE);

	}
	
	
	//
	public function transactions(Request $request){
		
		$session_id = $request->session_id;
		$type 		= $request->type_transaction;

		if($type == 1){
		
			$transactions 	= Depot::join('users','id','user_id')
								->selectRaw('depot.*, pseudo, photo')
								->where(['user_id'=>$session_id])
								->get()
								->sortByDesc('depot_id');

			
			$listeTransactions = array();
			
			foreach($transactions as $transaction){
				
				$listeTransactions[] = 
					array(
						'transactionDate' =>' le '.$transaction->depot_date,
						'transactionPseudo' =>' par '.$transaction->pseudo,
						'transactionPhoto' =>"http://cracgame.com/public/images/avatars/".$transaction->photo,
						'transactionMontant' =>number_format($transaction->depot_montant, 0, ',', ' ').' F',
					);

			}
			
		
		}elseif($type == 2){
			
			$transactions 	= Retrait::join('users','id','user_id')
								->selectRaw('retrait.*, pseudo, photo')
								->where(['user_id'=>$session_id])
								->get()
								->sortByDesc('retrait_id');

			
			$listeTransactions = array();
			
			foreach($transactions as $transaction){
				
				$listeTransactions[] = 
					array(
						'transactionDate' =>' le '.$transaction->retrait_date_demande,
						'transactionPseudo' =>' '.$transaction->retrait_statut,
						'transactionPhoto' =>"http://cracgame.com/public/images/avatars/".$transaction->photo,
						'transactionMontant' =>number_format($transaction->retrait_montant, 0, ',', ' ').' F',
					);
					
			}
			
		
		}elseif($type == 3){
		
			$transactions 	= Depot::join('users','id','user_id')
								->selectRaw('depot.*, pseudo, photo')
								->where(['user_id'=>$session_id])
								->get()
								->sortByDesc('depot_id');

			
			$listeTransactions = array();
			
			foreach($transactions as $transaction){
				
				$listeTransactions[] = 
					array(
						'transactionDate' =>' le '.$transaction->depot_date,
						'transactionPseudo' =>' par '.$transaction->pseudo,
						'transactionPhoto' =>"http://cracgame.com/public/images/avatars/".$transaction->photo,
						'transactionMontant' =>number_format($transaction->depot_montant, 0, ',', ' ').' F',
					);

			}
			
		
		}elseif($type == 4){
		
			$transactions 	= Depot::join('users','id','user_id')
								->selectRaw('depot.*, pseudo, photo')
								->where(['user_id'=>$session_id])
								->get()
								->sortByDesc('depot_id');

			
			$listeTransactions = array();
			
			foreach($transactions as $transaction){
				
				$listeTransactions[] = 
					array(
						'transactionDate' =>' le '.$transaction->depot_date,
						'transactionPseudo' =>' par '.$transaction->pseudo,
						'transactionPhoto' =>"http://cracgame.com/public/images/avatars/".$transaction->photo,
						'transactionMontant' =>number_format($transaction->depot_montant, 0, ',', ' ').' F',
					);

			}
			
		
		}elseif($type == 5){
		    //MES GAINS
			$transactions 	= Gain::join('users','users.id','gain.user_id')->where(['user_id'=>$session_id])->get();

			
			$listeTransactions = array();
			
			foreach($transactions as $transaction){
				
				$listeTransactions[] = 
					array(
						'transactionDate' =>' le '.$transaction->gain_date_creation,
						'transactionPseudo' =>' par '.$transaction->pseudo,
						'transactionPhoto' =>"http://cracgame.com/public/images/avatars/".$transaction->photo,
						'transactionMontant' =>number_format($transaction->gain_montant, 0, ',', ' ').' F',
					);

			}
			
		
		}elseif($type == 6){
		    
		    //gains de mes fieuls
            $sql = 'select *, DATE(gain_date_creation) as gain_date from gain 
            inner join users on users.id = gain.user_id 
            where user_id_parrain ="'.$session_id.'" 
            and DATE(gain_date_creation) in (select DATE(abonnement_date) from abonnement where user_id="'.$session_id.'" ) ';
            
			$transactions 	= DB::select($sql);
			
			$listeTransactions = array();
			
			$tab_mois = [];
			foreach($transactions as $transaction){

				//l'entête qui affiche la mois
				$month = sprintf("%02d", date_parse($transaction->gain_date)['month']);

				if(!in_array($month, $tab_mois)){
					$rang = 0;
					$tab_mois[] = $month;
					
					$listeTransactions[] = 
						array(
							'classementRang' =>"",
							'classementPseudo' =>"",
							'classementPhoto' =>"",
							'classementNote' =>0,
							'classementDate' =>$month. ' ème mois',
						);
				
				}
				
				$rang++;
				
				$listeTransactions[] = 
					array(
						'transactionDate' =>' le '.$transaction->gain_date_creation,
						'transactionPseudo' =>' par '.$transaction->pseudo,
						'transactionPhoto' =>"http://cracgame.com/public/images/avatars/".$transaction->photo,
						'transactionMontant' =>number_format($transaction->gain_montant, 0, ',', ' ').' F  - Commission : '.number_format($transaction->gain_montant*0.1, 0, ',', ' ').' F',
					);

			}
			
		
		}else{
		    
		    $transactions 	= Retrait::join('users','id','user_id')
								->selectRaw('retrait.*, pseudo, photo')
								->where(['user_id'=>$session_id])
								->get()
								->sortByDesc('retrait_id');

			
			$listeTransactions = array();
			
			foreach($transactions as $transaction){
				
				$listeTransactions[] = 
					array(
						'transactionDate' =>' le '.$transaction->retrait_date_demande,
						'transactionPseudo' =>' '.$transaction->retrait_statut,
						'transactionPhoto' =>"http://cracgame.com/public/images/avatars/".$transaction->photo,
						'transactionMontant' =>number_format($transaction->retrait_montant, 0, ',', ' ').' F',
					);
					
			}
			
		}
		
		
		
		echo json_encode(array(
			'listeTransactions'=>$listeTransactions,
		), JSON_INVALID_UTF8_SUBSTITUTE);

	}
	

	//
	public function defis(Request $request){
		
		$session_id = $request->session_id;
		
		$defis = Defi::where(['defi_statut'=>'VALIDE','defi_date'=>gmdate('Y-m-d')])->get();
		
		$listeDefis = array();

		foreach($defis as $defi){
			
			$listeDefis[] = 
            	array(
            		'defiId' =>$defi->defi_id,
					'defiMontant' =>number_format($defi->defi_montant, 0, ',', ' '),
					'defiDate' =>$defi->defi_date,

				);

		}
		
		
		echo json_encode(array('listeDefis'=>$listeDefis), JSON_INVALID_UTF8_SUBSTITUTE);

	}


	
	public function updateuserinfos(Request $request){
		
		$session_id = $request->session_id;

		$user = User::find($session_id);
		
		if(!empty($user) ){
	
			$user->nom = $request->nom;
			$user->prenoms = $request->prenoms;
			$user->sexe = $request->sexe;
			$user->telephone = $request->telephone;
			$user->adresse_email = $request->adresse_email;
			$user->adresse = $request->adresse;
			$user->ville = $request->ville;
			
			// $user->utilisateurPhoto = "http://cracgame.com/images/".$request->photo;

			$user->exists = true;
			$user->save();
			
			// dd($user);
			
			$listeOperationResult[] = 
				array(
					'operationStatut' =>1,
					'operationMessage' =>"INFORMATIONS MODIFIÉES AVEC SUCCÈS!",
				);	
			
		
		}else{
			
			$listeOperationResult[] = 
                	array(
                		'operationStatut' =>0,
						'operationMessage' =>"UTILISATEUR NON RECONNU",
					);
					
		}	

		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);
		
	}
	
	//
	
	public function avatars(){
		
		// $avatars = Avatar::all();
		$avatars = array();
		
		$avatarDir = "images/avatars";
		
		
		if (is_dir($avatarDir)) {
			
			// Si oui, on l'ouvre
			if ($dh = opendir($avatarDir)) {  
			
				// On liste les dossiers et fichiers de $avatarDir
				while (($file = readdir($dh)) !== false) {
					
					if(!is_dir($avatarDir.$file)){
						$avatars[]= $file;     
					}
				
				}
		 
				// On ferme $avatarDir
				closedir($dh);
				
			}
		 
		}
		
		// dd($avatars);
	  
		foreach($avatars as $avatar){
			
			if($avatar!="." && $avatar !=".."){
				
				$listeAvatars[] = 
					array(
						'avatarName' =>$avatar,
						'avatarPhoto' =>"http://cracgame.com/public/images/avatars/".$avatar,
					);
					
			}
			
		}
		
		
		echo json_encode(array(
			'listeAvatars'=>$listeAvatars,
		), JSON_INVALID_UTF8_SUBSTITUTE);
		
	}
	
	
	public function UpdateAvatar(Request $request){
		
		$avatar_name = $request->avatar_name;
		$user_id = $request->session_id;

		$user = User::find($user_id);
		
		// $user = User::find(Auth::user()->id);
		
		$user->photo = $avatar_name;
		$user->exists = true;
		$user->save();
		
		$listeOperationResult[] = 
                	array(
                		'operationStatut' =>1,
						'operationMessage' =>"AVATAR ENREGISTRE AVEC SUCCES",
					);

		echo json_encode(array('listeOperationResult'=>$listeOperationResult), JSON_INVALID_UTF8_SUBSTITUTE);

	}
	

}
