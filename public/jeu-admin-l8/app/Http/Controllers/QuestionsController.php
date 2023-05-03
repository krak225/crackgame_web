<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Question;
use App\Models\Categorie;
use App\Models\Niveau;
use Stdfn;
use DB;


class QuestionsController extends Controller
{
  
    //
	public function __construct()
    {

        $this->middleware('auth');
		
    }
	

    public function addquestiontest()
    {
		
    	$categories = Categorie::get();
    	$niveaux 	= Niveau::get();
		
		$type_jeu_id = 1;
		
        return view('question.addquestion',['categories'=>$categories, 'niveaux'=>$niveaux, 'type_jeu_id'=>$type_jeu_id, 'libelle'=>'Questions de test']);
		
    }
	
    public function addquestionquiz()
    {
		
    	$categories = Categorie::get();
    	$niveaux 	= Niveau::get();
		
		$type_jeu_id = 2;
		
        return view('question.addquestion',['categories'=>$categories, 'niveaux'=>$niveaux, 'type_jeu_id'=>$type_jeu_id, 'libelle'=>'Questions de quiz']);
		
    }
	
    public function modifier_question($question_id)
    {
		$question = Question::find($question_id);
		
    	$categories = Categorie::get();
    	$niveaux 	= Niveau::get();
		
		
		if(!empty($question)){
			
			if($question->reponse == 'A'){
				
				$question->bonne_reponse = $question->proposition_a_fr;
				$question->mauvaise_reponse_1 = $question->proposition_b_fr;
				$question->mauvaise_reponse_2 = $question->proposition_c_fr;
				
			}elseif($question->reponse == 'B'){
				
				$question->bonne_reponse = $question->proposition_b_fr;
				$question->mauvaise_reponse_1 = $question->proposition_a_fr;
				$question->mauvaise_reponse_2 = $question->proposition_c_fr;
				
			}else{
				
				$question->bonne_reponse = $question->proposition_c_fr;
				$question->mauvaise_reponse_1 = $question->proposition_a_fr;
				$question->mauvaise_reponse_2 = $question->proposition_b_fr;
							
			}
			
			$type_jeu_id = $question->type_jeu_id;
			
			$libelle = ($type_jeu_id == 1)? 'Questions de test' : 'Questions de quiz';
			$route_back = ($question->type_jeu_id == 1)? 'questionstest' : 'questionsquiz';
			
			return view('question.modifier_question',['categories'=>$categories, 'niveaux'=>$niveaux, 'type_jeu_id'=>$type_jeu_id, 'question'=>$question, 'libelle'=>$libelle, 'route_back'=>$route_back]);
			
		}else{
			
			return back()->with('warning', 'QUESTION INTROUVABLE');
			
		}
		
    }
	
    public function questions(Request $request)
    {
		
		$categorie_id_selected  	= $request->c;
		$niveau_id_selected    	= $request->n;
		
		$categories = Categorie::get();
    	$niveaux 	= Niveau::get();
		
		
    	$questions = Question::join('niveau','niveau.niveau_id','question.niveau_id')
						->LeftJoin('categorie','categorie.categorie_id','question.categorie_id')
						->whereRaw('type_jeu_id="2" AND question.categorie_id <> 11 ')
						->get();
					
		if(!empty($categorie_id_selected)){ $whereRaw.=  ' AND question.categorie_id = "'.$categorie_id_selected.'"'; }
		if(!empty($niveau_id_selected)){ $whereRaw.=  ' AND question.niveau_id = "'.$niveau_id_selected.'"'; }

		
        return view('question.questions',['questions'=>$questions, 'categories'=>$categories, 'niveaux'=>$niveaux, 'categorie_id_selected'=>$categorie_id_selected, 'niveau_id_selected'=>$niveau_id_selected, ]);
		
    }
	

    public function questionstest(Request $request)
    {
		
		$categorie_id_selected  	= $request->c;
		$niveau_id_selected    	= $request->n;
		
		$categories = Categorie::get();
    	$niveaux 	= Niveau::get();
		
		$whereRaw = 'type_jeu_id="1" AND question.categorie_id <> 11 ';
		if(!empty($categorie_id_selected)){ $whereRaw.=  ' AND question.categorie_id = "'.$categorie_id_selected.'"'; }
		if(!empty($niveau_id_selected)){ $whereRaw.=  ' AND question.niveau_id = "'.$niveau_id_selected.'"'; }

		
    	$questions = Question::LeftJoin('niveau','niveau.niveau_id','question.niveau_id')
						->LeftJoin('categorie','categorie.categorie_id','question.categorie_id')
						->whereRaw($whereRaw)
						->get();
		
		$titre = 'questions de test';
		$type_jeu_id = 1;
					
		
        return view('question.questions',['questions'=>$questions, 'type_jeu_id'=>$type_jeu_id, 'titre'=>$titre, 'categories'=>$categories, 'niveaux'=>$niveaux, 'categorie_id_selected'=>$categorie_id_selected, 'niveau_id_selected'=>$niveau_id_selected, ]);
		
    }
	

    public function questionsquiz(Request $request)
    {
		
		$categorie_id_selected  	= $request->c;
		$niveau_id_selected    	= $request->n;
		
		$categories = Categorie::get();
    	$niveaux 	= Niveau::get();
		
		$whereRaw = 'type_jeu_id="2" AND question.categorie_id <> 11  ';
		if(!empty($categorie_id_selected)){ $whereRaw.=  ' AND question.categorie_id = "'.$categorie_id_selected.'"'; }
		if(!empty($niveau_id_selected)){ $whereRaw.=  ' AND question.niveau_id = "'.$niveau_id_selected.'"'; }

		
    	$questions = Question::join('niveau','niveau.niveau_id','question.niveau_id')
						->LeftJoin('categorie','categorie.categorie_id','question.categorie_id')
						->whereRaw($whereRaw)
						->get();
		
		$titre = 'questions de quiz';
		$type_jeu_id = 2;
		
        return view('question.questions',['questions'=>$questions, 'type_jeu_id'=>$type_jeu_id, 'titre'=>$titre, 'categories'=>$categories, 'niveaux'=>$niveaux, 'categorie_id_selected'=>$categorie_id_selected, 'niveau_id_selected'=>$niveau_id_selected, ]);
		
    }
	

    public function DetailsQuestion(Request $request)
    {
		
		$question_id = $request->question_id;
		
		$question = Question::join('niveau','niveau.niveau_id','question.niveau_id')
						->LeftJoin('categorie','categorie.categorie_id','question.categorie_id')
						->where(['id'=>$question_id])
						->first();
								
		// dd($question);
		
		if(!empty($question)){
			
			if($question->reponse == 'A'){
				
				$question->bonne_reponse = $question->proposition_a_fr;
				$question->mauvaise_reponse_1 = $question->proposition_b_fr;
				$question->mauvaise_reponse_2 = $question->proposition_c_fr;
				
			}elseif($question->reponse == 'B'){
				
				$question->bonne_reponse = $question->proposition_b_fr;
				$question->mauvaise_reponse_1 = $question->proposition_a_fr;
				$question->mauvaise_reponse_2 = $question->proposition_c_fr;
				
			}else{
				
				$question->bonne_reponse = $question->proposition_c_fr;
				$question->mauvaise_reponse_1 = $question->proposition_a_fr;
				$question->mauvaise_reponse_2 = $question->proposition_b_fr;
				
			}
			
			$libelle = ($question->type_jeu_id == 1)? 'Questions de test' : 'Questions de quiz';
			$route_back = ($question->type_jeu_id == 1)? 'questionstest' : 'questionsquiz';
			
			return view('question.details_question', ['question'=>$question, 'libelle'=>$libelle, 'route_back'=>$route_back]);
		
		}else{
			
			return Redirect('questions')->with('warning',"LA QUESTION QUE VOUS CHERCHEZ N'A PAS ÉTÉ TROUVÉE");
		}
		
	}
	

    public function SaveQuestion(Request $request)
    {
		
		$question = new Question();
		
		$question->user_id 			= Auth::user()->id;
		$question->type_jeu_id 		= $request->type_jeu_id;
		$question->categorie_id 	= $request->categorie_id;
		$question->niveau_id 		= ($request->type_jeu_id == 2)? $request->niveau_id : 1;
		$question->question_fr 		= trim($request->question);
		$proposition_correcte 		= trim($request->proposition_1);
		
		
		$question->proposition_a_fr = null;
		
		//choisir un emplacement au hasard pour la bonne proposition
		$numero_bonnne_proposition = mt_rand(1,3);
		
		if($numero_bonnne_proposition == 1){
			
			$question->reponse 			= 'A';
			$question->proposition_a_fr = $proposition_correcte;
			$question->proposition_b_fr = trim($request->proposition_2);
			$question->proposition_c_fr = trim($request->proposition_3);
			
		}elseif($numero_bonnne_proposition == 2){
			
			$question->reponse 			= 'B';
			$question->proposition_a_fr = trim($request->proposition_2);
			$question->proposition_b_fr = $proposition_correcte;
			$question->proposition_c_fr = trim($request->proposition_3);
						
		}else{
			
			$question->reponse 			= 'C';
			$question->proposition_a_fr = trim($request->proposition_2);
			$question->proposition_b_fr = trim($request->proposition_3);
			$question->proposition_c_fr = $proposition_correcte;
						
		}
		
		
		$question->question_date_creation = gmdate('Y-m-d H:i:s');
		$question->statut 			= 'VALIDE';
		
		$question->save();
		
		
		return back()->with('message', "ENREGISTREMENT EFFECTUÉ AVEC SUCCÈS");

		
	}


    public function SaveModificationQuestion(Request $request, $question_id)
    {
		
		$question = Question::find($question_id);
		
		$question->user_id 			= Auth::user()->id;
		$question->type_jeu_id 		= $request->type_jeu_id;
		$question->categorie_id 	= $request->categorie_id;
		$question->niveau_id 		= $request->niveau_id;
		$question->question_fr 		= trim($request->question);
		$proposition_correcte 		= trim($request->proposition_1);
		
		$question->proposition_a_fr = null;
		
		//choisir un emplacement au hasard pour la bonne proposition
		// $numero_bonnne_proposition = mt_rand(1,3);
		
		if($question->reponse == 'A'){
			
			// $question->reponse 			= 'A';
			$question->proposition_a_fr = $proposition_correcte;
			$question->proposition_b_fr = trim($request->proposition_2);
			$question->proposition_c_fr = trim($request->proposition_3);
			
		}elseif($question->reponse == 'B'){
			
			// $question->reponse 			= 'B';
			$question->proposition_a_fr = trim($request->proposition_2);
			$question->proposition_b_fr = $proposition_correcte;
			$question->proposition_c_fr = trim($request->proposition_3);
						
		}else{
			
			$question->reponse 			= 'C';
			$question->proposition_a_fr = trim($request->proposition_2);
			$question->proposition_b_fr = trim($request->proposition_3);
			$question->proposition_c_fr = $proposition_correcte;
						
		}
		
		
		$question->statut 			= 'VALIDE';
		
		$question->save();
		
		
		return back()->with('message', "MODIFICATION EFFECTUÉE AVEC SUCCÈS");

		
	}
	
}


