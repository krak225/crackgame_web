<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ParametresController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('auth');
    }

	
	
	
	//
	public function addquestion(){
		
		return view('addquestion');
		
	}
	
	
	public function SaveQuestion_OLD(Request $request){
		
		$question = new Question();
		
		$question->user_id 			= Auth::user()->id;
		$question->question_fr 		= $request->question;
		$question->proposition_a_fr = $request->proposition_1;
		$question->proposition_b_fr = $request->proposition_2;
		$question->proposition_c_fr = $request->proposition_3;
		
		$question->reponse 			= $request->proposition_correcte;
		$question->statut 			= 'BROUILLON';
		
		$question->save();
		
		
		return back()
			->with('message', "ENREGISTREMENT EFFECTUÉ AVEC SUCCÈS");

	}
	
	
	public function SaveQuestion(Request $request){
		
		$question = new Question();
		
		$question->user_id 			= Auth::user()->id;
		$question->question_fr 		= $request->question;
		$proposition_correcte 		= $request->proposition_1;
		
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
		
		
		return back()
			->with('message', "ENREGISTREMENT EFFECTUÉ AVEC SUCCÈS");

	}
	
	
	//
	public function questions($selectionner = ''){
		
		if(Auth::user()->profil_id ==1){
			$questions = Question::all();
		}else{
			$questions = Question::whereRaw('user_id='.Auth::user()->id.' AND statut in("BROUILLON","VALIDE")')->get();
		}
		
		return view('questions',['questions'=>$questions,'selectionner'=>$selectionner]);
		
	}
	
	
	//
	public function save_selection_question(Request $request){
		
		$statut = 0;
		$listeIds = $request->liste_selection;
		
		Question::whereRaw(' user_id = "'.Auth::user()->id.'" and id IN ('.$listeIds.'0)')->update(['statut_selection'=>'SELECTED']);
		Question::whereRaw(' user_id = "'.Auth::user()->id.'" and id NOT IN ('.$listeIds.'0)')->update(['statut_selection'=>'NOT SELECTED']);
		
		$statut = 1;
		
		$out = array('statut'=>$statut);
		
		return $out;
		
	}
	
	//
	public function save_selection_question_chap(Request $request){
		
		$statut = 0;
		$listeIds = $request->liste_selection_chap;
		
		Question::whereRaw(' user_id = "'.Auth::user()->id.'" and id IN ('.$listeIds.'0)')->update(['statut_selection_chap'=>'SELECTED']);
		Question::whereRaw(' user_id = "'.Auth::user()->id.'" and id NOT IN ('.$listeIds.'0)')->update(['statut_selection_chap'=>'NOT SELECTED']);
		
		$statut = 1;
		
		$out = array('statut'=>$statut);
		
		return $out;
		
	}
	
	//
	public function modifier_question($question_id){
		
		$question = Question::find($question_id);
		
		
		return view('modifier_question',['question'=>$question]);
		
	}


	//
	public function supprimer_question($question_id){
		
		$question = Question::find($question_id);
		$question->statut  = "SUPPRIME";
		$question->exists  = true;
		$question->save();

		return redirect()->back();
		
	}
	
	
	public function UpdateQuestion(Request $request){
		// dd($request);
		$question = Question::find($request->question_id);
		
		$question->question_fr 		= $request->question;
		$proposition_correcte 		= $request->proposition_1;
		
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
		$question->exists 			= true;
		
		$question->save();
		
		
		return back()
			->with('message', "MODIFICATION EFFECTUÉ AVEC SUCCÈS");

	}
	
	
	
	//
	public function valider_question($question_id){
		
		$question = Question::find($question_id);
		
		
		
		// return view('valider_question',['question'=>$question]);
		
	}
	
	
	
	
}
